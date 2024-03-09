$(document).ready(function () {
    $('#dt_employee').DataTable({
        responsive: true,
        ordering: false,
        serverSide: true,
        ajax: {
            url: '/employee/datatable',
            method: 'get',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nik', name: 'nik' },
            { data: 'name', name: 'name' },
            { data: 'departement_name', name: 'departement_name' },
            { data: 'gender', name: 'gender' },
            { data: 'phone', name: 'phone' },
            { data: 'status', name: 'status' },
            { data: 'id', name: 'id' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center",
            },
            {
                targets: 6,
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
                targets: 7,
                className: "text-center",
                render: function (data, type, full, meta) {
                    if (full.status_outlet != 'deleted') {
                        return '<a href="javascript:void(0)" class="share bg-tranparan px-2 detailEmployeeModal" id="' + data + '"><i class="bi bi-pencil-square"></i></a>';
                    } else {
                        return '';
                    }
                }
            },
        ]
    });
});

/** Get Detail Data Employee */
$(document).on('click', '.detailEmployeeModal', function () {
    var id = $(this).attr("id");
    $.ajax({
        url: '/employee/detail/' + id,
        method: "get",
        dataType: "JSON",
        cache: false,
        success: function (data) {
            $('#DetailEmployeeModal').modal('show');
            $('#id').val(data.id);
            $('#detail_nik').val(data.nik);
            $('#detail_name').val(data.name);
            $('#detail_phone').val(data.phone);
            $('#detail_gender option[value="' + data.gender + '"]').prop('selected', true);
            $('#detail_status option[value="' + data.status + '"]').prop('selected', true);

            var option = new Option(data.departement_name, data.departement_id, true, true);
            $('#detail_departement').append(option).trigger('change');
        },
    })
});

/** Submit Data Employee */
$(document).on("click", "#btn_submit", function (e) {
    e.preventDefault();
    $('#AddEmployeeModal').modal('hide');
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
            $("#submit_employee").submit();
        } else if (result.isDismissed) {
            $('#AddEmployeeModal').modal('show');
            $("#btn_submit").removeAttr("disabled", "disabled");
        }
    })
});
$("#submit_employee").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/employee/submit',
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
                'formID': 'submit_employee',
                'btnID': 'btn_submit',
                'path': '/employee',
                'modal': 'AddEmployeeModal'
            }
            showResponse(response, data);
        }
    })
});

/** Update Data Employee */
$(document).on("click", "#btn_update", function (e) {
    e.preventDefault();
    $('#DetailEmployeeModal').modal('hide');
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
            $("#update_employee").submit();
        } else if (result.isDismissed) {
            $('#DetailEmployeeModal').modal('show');
            $("#btn_update").removeAttr("disabled", "disabled");
        }
    })
});
$("#update_employee").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/employee/update',
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
                'formID': 'update_employee',
                'btnID': 'btn_update',
                'path': '/employee',
                'modal': 'DetailEmployeeModal'
            }
            showResponse(response, data);
        }
    })
});