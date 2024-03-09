function showValidationError(fileld, message) {
    if (!message) {
        $('#' + fileld).addClass('is-valid').removeClass('is-invalid').siblings('.invalid-feedback').text('');
    } else {
        $('#' + fileld).addClass('is-invalid').removeClass('is-valid').siblings('.invalid-feedback').text(message);
    }
}

function removeValidationClassed(form) {
    $(form).each(function () {
        $(form).find(':input').removeClass('is-valid is-invallid');
    });
}

function showMessage(type, message) {
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        <strong>${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
}

function showResponse(response, data) {
    switch (response.code) {
        case 200:
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location = data.path;
            })
            break
        case 400:
            $('#' + data.btnID).removeAttr("disabled", "disabled");
            if (data.modal) {
                $('#' + data.modal).modal('show');
            }
            let formID = document.getElementById(data.formID);
            for (var i = 0; i < formID.elements.length - 1; i++) {
                console.log(formID.elements[i].name)
                if (formID.elements[i].name) {
                    showValidationError(formID.elements[i].name, response.message[formID.elements[i].name]);
                }
            }
            break
        default:
            Swal.fire({
                position: 'center',
                icon: 'error',
                text: response.message,
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + data.btnID).removeAttr("disabled", "disabled");
                    if (data.modal) {
                        $('#' + data.modal).modal('show');
                    }
                }
            })
    }
}

