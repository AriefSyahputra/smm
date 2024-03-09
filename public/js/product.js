$(document).ready(function () {
    $('#dt_product').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/product/datatable',
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'sku', name: 'sku' },
            { data: 'name', name: 'name' },
            { data: 'lokasi', name: 'lokasi' },
            { data: 'stock', name: 'stock' },
            { data: 'status', name: 'status' },
            { data: 'sku', name: 'sku' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            },
            {
                targets: 4,
                className: "text-center",
            },
            {
                targets: 5,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (data == 'active') {
                        return '<span class="badge bg-success">' + data + '</span>';
                    } else if (data == 'inactive') {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    } else {
                        return '<span class="badge bg-dark">' + data + '</span>';
                    }
                }
            },
            {
                targets: 6,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (full.status_outlet != 'deleted') {
                        return '<a href="product/detail/' + data + '" class="share bg-tranparan px-2 detailProductModal"><i class="bi bi-pencil-square"></i></a>';
                    } else {
                        return '';
                    }
                }
            },
        ]
    });

    let sku = $('#sku').val();
    $('#dt_history_purchase').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/product/datatable/history-purchase/' + sku,
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'purchase_no', name: 'purchase_no' },
            { data: 'purchase_date', name: 'purchase_date' },
            { data: 'suplier', name: 'suplier' },
            { data: 'quantity', name: 'quantity' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            }, {
                targets: 4,
                className: "text-center",
            }

        ]
    });

    $('#dt_history_order').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/product/datatable/history-order/' + sku,
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'order_no', name: 'order_no' },
            { data: 'order_date', name: 'order_date' },
            { data: 'employee', name: 'employee' },
            { data: 'quantity', name: 'quantity' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            }, {
                targets: 4,
                className: "text-center",
            }

        ]
    });
});

/** Get Detail Data Employee */
$(document).on('click', '.detailProductModal', function () {
    var sku = $(this).attr("sku");
    $.ajax({
        url: '/product/detail/' + sku,
        method: "get",
        dataType: "JSON",
        cache: false,
        success: function (data) {
            $('#DetailProductModal').modal('show');
            $('.sku').val(data.sku);
            $('#detail_sku').val(data.sku);
            $('#detail_name').val(data.name);
            $('#detail_lokasi').val(data.lokasi);
            $('#detail_stock').val(data.stock);
            $('#detail_satuan option[value="' + data.satuan + '"]').prop('selected', true);
            $('#detail_status option[value="' + data.status + '"]').prop('selected', true);
        },
    })
});

/** Submit Data Product */
$(document).on("click", "#btn_submit", function (e) {
    e.preventDefault();
    $('#AddProductModal').modal('hide');
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Submit'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#btn_submit").attr("disabled", "disabled");
            $("#submit_product").submit();
        } else if (result.isDismissed) {
            $('#AddProductModal').modal('show');
            $("#btn_submit").removeAttr("disabled", "disabled");
        }
    })
});
$("#submit_product").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/product/submit',
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token
        },
        async: true,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        success: function (response) {
            data = {
                'formID': 'submit_product',
                'btnID': 'btn_submit',
                'path': '/product',
                'modal': 'AddProductModal'
            }
            showResponse(response, data);
        }
    })
});

/** Update Data Employee */
$(document).on("click", "#btn_update", function (e) {
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
            $("#btn_update").attr("disabled", "disabled");
            $("#update_product").submit();
        } else if (result.isDismissed) {
            $("#btn_update").removeAttr("disabled", "disabled");
        }
    })
});
$("#update_product").on("submit", function (e) {
    e.preventDefault();
    let token = $('meta[name="csrf-token"]').attr('content');
    let sku = $('.sku').val();

    $.ajax({
        url: '/product/update',
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token
        },
        async: true,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        success: function (response) {
            data = {
                'formID': 'update_product',
                'btnID': 'btn_update',
                'path': '/product/detail/' + sku,
            }
            showResponse(response, data);
        }
    })
});