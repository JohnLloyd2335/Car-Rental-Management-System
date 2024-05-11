$("#logout").click(() => {

    let url = "logout";
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