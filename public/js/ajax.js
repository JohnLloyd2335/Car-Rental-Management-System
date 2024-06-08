$("#logout").click(() => {

    let url = "/logout";
    let token = $("meta[name='csrf-token']").attr('content');

    $.ajax({
        url: url,
        method: "POST",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function () {
            Swal.fire({
                title: "Success",
                text: "Logged out",
                icon: "success"
            });

            window.location.href = "/";
        },
        error: function (error) {
            console.log(error);
            serverErrorAlert();
        }
    });

});

function handleLogin() {
    let loginForm = document.getElementById("loginForm");
    let formData = new FormData(loginForm);
    let url = "login/handleLogin";
    let token = $("meta[name='csrf-token']").attr('content');

    $.ajax({
        url: url,
        method: "POST",
        processData: false,
        contentType: false,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {
            let is_admin = response.is_admin;

            if (is_admin) {
                window.location.href = "admin/dashboard";
            }
            else {
                window.location.href = "/";
            }
        },
        error: function (error) {

            $('#email').css('border', '1px solid #eee8e8');
            $('#password').css('border', '1px solid #eee8e8');
            $('.validation-error-container').hide();
            $('.validation-error-container p').text('');

            let statusCode = error.status;
            let responseMessage = error.responseJSON.message ?? '';
            let validationErrorMessages = error.responseJSON.errors ?? [];

            if (statusCode == 401) {
                Swal.fire({
                    title: "Oops",
                    text: responseMessage,
                    icon: 'warning'
                });
            }
            else if (statusCode == 422) {

                $.each(validationErrorMessages, (key, value) => {
                    $(`#${key}`).css('border', '1px solid red');
                    $(`#${key}`).siblings('.validation-error-container').show();
                    $(`#${key}`).siblings('.validation-error-container').find('p').text(value);
                });
            }
            else if (statusCode == 404) {
                Swal.fire({
                    title: "Oops",
                    text: responseMessage,
                    icon: 'warning'
                });
            }
            else {
                serverErrorAlert();
            }
        }
    });
}

function handleRegistration() {
    let form = document.getElementById("registerForm");
    let formData = new FormData(form);
    let token = $("meta[name='csrf-token']").attr('content');
    let url = 'register';

    $.ajax({
        url: url,
        method: 'POST',
        processData: false,
        contentType: false,
        dataType: false,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {
            let message = response.message;

            Swal.fire({
                title: 'Success',
                text: message,
                icon: 'success'
            });

            let fieldIds = ['name', 'email', 'address', 'mobile_number', 'password', 'password_confirmation'];

            for (let i = 0; i <= fieldIds.length; i++) {
                $(`#${fieldIds[i]}`).val("");
                $(`#${fieldIds[i]}`).closest('.reg-form-group').find('p').empty();
                $(`#${fieldIds[i]}`).closest('.icon-input-group').removeClass("input-error");
            }
        },
        error: function (error) {

            let statusCode = error.status;
            let errors = error.responseJSON.errors ?? [];
            let message = error.responseJSON.message ?? '';

            let fieldIds = ['name', 'email', 'address', 'mobile_number', 'password', 'password_confirmation'];

            for (let i = 0; i <= fieldIds.length; i++) {

                $(`#${fieldIds[i]}`).closest('.reg-form-group').find('p').empty();
                $(`#${fieldIds[i]}`).closest('.icon-input-group').removeClass("input-error");
            }

            if (statusCode == 422) {
                $.each(errors, (key, value) => {
                    $(`#${key}`).closest(".reg-form-group").find("p").text(value[0]);
                    $(`#${key}`).closest('.icon-input-group').addClass("input-error");
                });
            }

            if (statusCode == 500) {
                Swal.fire({
                    title: 'Oops',
                    text: message,
                    icon: 'error'
                });
            }

        }
    });

}

function cancelRental(id) {
    Swal.fire({
        title: 'Are you sure you want to cancel Rental?',
        text: '',
        icon: 'warning',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        html: "<div><textarea style='margin: 5px 10px; resize:none;width : 400px;height: 100px;padding: 2px 5px; font-size:22px;' placeholder='Reason' id='reason'></textarea></div>"
    }).then((result) => {
        if (result.isConfirmed) {

            let url = `rental/pending/${id}/cancel`;
            let token = $("meta[name='csrf-token']").attr('content');
            let reason = $("#reason").val();

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    reason: reason
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success'
                    });

                    window.location.reload();
                },
                error: function (error) {
                    Swal.fire({
                        title: "Server Error",
                        text: error.responseJSON.message,
                        icon: "error"
                    });
                }
            });

        }
    });
}

function addRentalReview(rental_id) {

    let rating = $("#review-count-field").val();
    let comment = $("#comment").val();

    if (rating == 0 || rating == "0") {
        Swal.fire({
            title: 'Warning',
            text: 'Rating is required',
            icon: 'warning'
        });
        return;
    }

    let url = 'store-review';
    let token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: url,
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            rental_id: rental_id,
            stars: rating,
            comment: comment
        },
        success: function (response) {

            Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success'
            });

            window.location.href = "";
        },
        error: function (error) {
            let errorMessage = error.responseJSON.message;
            let statusCode = error.status;


            if (statusCode == 422) {
                Swal.fire({
                    title: 'Server Error',
                    text: errorMessage,
                    icon: 'error'
                });
            }
            else if (statusCode == 500) {
                Swal.fire({
                    title: 'Server Error',
                    text: errorMessage,
                    icon: 'error'
                });
            }



        }
    })

}