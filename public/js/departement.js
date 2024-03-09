$(document).ready(function () {
    $('#dt_departement').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: '/departement/datatable',
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'employee_count', name: 'employee_count' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'id', name: 'id' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            },
            {
                targets: 2,
                className: "text-center",
            },
            {
                targets: 3,
                className: "text-center",
            },
            {
                targets: 4,
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
                targets: 5,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (full.status != 'deleted') {
                        return '<a href="javascript:void(0)" class="bg-tranparan px-2 detailDepartementModal" id="' + data + '"><i class="bi bi-pencil-square"></i></a>';
                    } else {
                        return '';
                    }
                }
            },
        ]
    });
});

/** Get Detail Data Departement */
$(document).on('click', '.detailDepartementModal', function () {
    var id = $(this).attr("id");
    $.ajax({
        url: '/departement/detail/' + id,
        method: "get",
        dataType: "JSON",
        cache: false,
        success: function (data) {
            $('#DetailDepartementModal').modal('show');
            $('#id').val(data.id);
            $('#detail_name').val(data.name);
            $('.StatusDepartement option[value="' + data.status + '"]').prop('selected', true);
        },
    })
});

/** Submit Data Departement */
$(document).on("click", "#btn_submit", function (e) {
    e.preventDefault();
    $('#AddDepartementModal').modal('hide');
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
            $("#submit_departement").submit();
        } else if (result.isDismissed) {
            $('#AddDepartementModal').modal('show');
            $("#btn_submit").removeAttr("disabled", "disabled");
        }
    })
});
$("#submit_departement").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/departement/submit',
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
                'formID': 'submit_departement',
                'btnID': 'btn_submit',
                'path': '/departement',
                'modal': 'AddDepartementModal'
            }
            showResponse(response, data);
        }
    })
});

/** Update Data Departement */
$(document).on("click", "#btn_update", function (e) {
    e.preventDefault();
    $('#DetailDepartementModal').modal('hide');
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
            $("#update_departement").submit();
        } else if (result.isDismissed) {
            $('#DetailDepartementModal').modal('show');
            $("#btn_update").removeAttr("disabled", "disabled");
        }
    })
});
$("#update_departement").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/departement/update',
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
                'formID': 'update_departement',
                'btnID': 'btn_update',
                'path': '/departement',
                'modal': 'DetailDepartementModal'
            }
            showResponse(response, data);
        }
    })
});
