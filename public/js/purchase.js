let dataset = [];
$(document).ready(function () {
    $('#dt_purchase').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/purchase/datatable',
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'purchase_no', name: 'purchase_no' },
            { data: 'purchase_date', name: 'purchase_date' },
            { data: 'suplier', name: 'suplier' },
            { data: 'status', name: 'status' },
            { data: 'purchase_no', name: 'purchase_no' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            },
            {
                targets: 4,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (data == 'done') {
                        return '<span class="badge bg-success">' + data + '</span>';
                    } else {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    }
                }
            },
            {
                targets: 5,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (full.status != 'deleted') {
                        return '<a href="purchase/detail/' + data + '" class="share bg-tranparan px-2"><i class="bi bi-pencil-square"></i></a>';
                    } else {
                        return '';
                    }
                }
            },
        ]
    });

    $('#dt_purchase_product').DataTable({
        serverSide: true,
        ordering: false,
        paging: false,
        searching: false,
        responsive: true,
        info: false,
        ajax: function (data, callback, setting) {
            callback({
                data: dataset
            })
        },
        columns: [
            {
                data: "sku",
                name: "sku",
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "lokasi",
                name: "lokasi"
            },
            {
                data: "quantity",
                name: "quantity"
            },
            {
                data: "product_id",
                name: "product_id"
            },
        ],
        data: dataset,
        columnDefs: [
            {
                targets: 3,
                className: "text-center",
            }, {
                targets: 4,
                className: "text-center",
                render: function (data, type, full, meta) {
                    var dt = data;
                    return '<a href="javascript:void(0)" data-content="' + window.btoa(JSON.stringify(dt)) + '" class="btn btn-danger btn-sm removeProduct"> <i class="bi bi-trash"></i> </a>';
                }
            }

        ]
    });

    let purchase_no = $('#purchase_number').val();
    $('#dt_detail_purchase_product').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/purchase/datatable/detail/product/' + purchase_no,
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'sku', name: 'sku' },
            { data: 'name', name: 'name' },
            { data: 'lokasi', name: 'lokasi' },
            { data: 'quantity', name: 'quantity' },
        ],
    });

    $("#searchProduct").select2({
        dropdownParent: $('#AddProductModal'),
        theme: 'bootstrap-5',
        minimumInputLength: 1,
        placeholder: 'Search sku or name..',
        ajax: {
            url: '/product/search',
            metgot: 'get',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.sku + ' - ' + item.name,
                            id: item.product_id,
                            sku: item.sku,
                            name: item.name,
                            lokasi: item.lokasi,
                        }
                    })
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        $('#product_id').val(e.params.data.id);
        $('#sku').val(e.params.data.sku);
        $('#name').val(e.params.data.name);
        $('#lokasi').val(e.params.data.lokasi);
        $('#quantity').focus();
    });

    $(document).on("click", "#btn_add", function () {
        let $inputs = $('#submit_product :input');

        var values = {};
        $inputs.each(function () {
            values[this.name] = $(this).val();
        });

        for (let i = 0; i < dataset.length; i++) {
            if (dataset[i]["product_id"] == values.product_id) {
                $('#AddProductModal').modal('hide');
                Swal.fire({
                    text: "Data Already Exists!",
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#AddProductModal').modal('show');
                    }
                });

                return Error;
            }
        }

        if (values.quantity == '') {
            $('#AddProductModal').modal('hide');
            Swal.fire({
                text: "The quantity field is required!",
                icon: "error",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#AddProductModal').modal('show');
                }
            });
            return false;
        }

        dataset.push(values);
        Object.assign(dataset);
        $('#dt_purchase_product').DataTable().ajax.reload();
        $('#submit_product')[0].reset();
        $('#AddProductModal').modal('hide');
        $('#searchProduct').val(null).trigger('change');
    });

    $(document).on('click', '.removeProduct', function () {
        var item = $(this).attr('data-content');
        var itemList = JSON.parse(window.atob(item));

        for (let i = 0; i < dataset.length; i++) {
            if (dataset[i]["product_id"] == itemList) {
                dataset.splice([i], [1]);
            }
        }
        $('#dt_purchase_product').DataTable().ajax.reload();
    });

    /** Submit All Data Purchase */
    $(document).on("click", "#btn_submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#submit_purchase").submit();
            } else if (result.isDismissed) {
                $('#AddProductModal').modal('show');
            }
        })
    });
    $("#submit_purchase").on("submit", function (e) {
        e.preventDefault();
        let token = $('meta[name="csrf-token"]').attr('content');

        form = new FormData(this);
        form.append('detail', JSON.stringify(dataset));

        $.ajax({
            url: '/purchase/submit',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': token
            },
            async: true,
            data: form,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (response) {
                data = {
                    'formID': 'submit_purchase',
                    'btnID': 'btn_submit',
                    'path': '/purchase',
                }
                showResponse(response, data);
            }
        })
    });
});