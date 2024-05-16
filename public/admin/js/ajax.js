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

function approveRental(id) {

    Swal.fire({
        title: 'Warning',
        text: 'Are you sure you want to approve this rental?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {

            let url = `pending/${id}/setActive`;
            let token = $("meta[name='csrf-token']").attr('content');
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
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
                    console.log(error)
                    Swal.fire({
                        title: 'Error',
                        text: error.responseJSON.message,
                        icon: 'error'
                    });
                }
            });

        }
    });

}

$('#markAsDoneButton').click(function () {
});



