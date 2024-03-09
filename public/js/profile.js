$(document).on("click", "#btn_submit_password", function (e) {
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
            $("#btn_submit_password").attr("disabled", "disabled");
            $("#form_new_password").submit();
        }
    })
});
$("#form_new_password").on("submit", function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/my-profile/change-password',
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token
        },
        async: true,
        data: new FormData(this),
        processData: false,
        dataType: 'json',
        cache: false,
        contentType: false,
        success: function (response) {
            data = {
                'formID': 'form_new_password',
                'btnID': 'btn_submit_password',
                'path': '/my-profile',
            }
            showResponse(response, data);
        }
    });
});