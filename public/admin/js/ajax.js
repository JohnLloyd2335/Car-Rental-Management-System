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