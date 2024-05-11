

$(document).ready(function () {

    //Toggle Icon
    let toggleIcon = $("#toggleIcon");
    let sideBarContainer = $(".sidebar-container");
    let brandName = $(".brand-name");
    let textLink = $(".text-link");

    toggleIcon.click(function () {
        sideBarContainer.toggleClass("sidebar-container-close");
        brandName.toggleClass("brand-name-hide");
        textLink.toggleClass("text-link-hide");
        $(this).toggleClass("fa-bars-staggered");

    });

    //User Dropdown
    let userDropdown = $("#user-dropdown");
    let userDropdownItems = $(".user-dropdown-items");

    userDropdown.click(function () {
        userDropdownItems.toggleClass("user-dropdown-show");
    });

    //Toggle Icon Small Device
    $("#toggleIconSmallDev").click(function () {
        let sideBarContainer = $(".sidebar-container");
        let mainContainer = $("main");

        sideBarContainer.css('display', 'inline-block');
        sideBarContainer.css('max-width', '100%');
        mainContainer.css('display', 'none');
    })

    //Close Sidebar on Mobile Device
    $("#closeSideBarMob").click(function () {
        let sideBarContainer = $(".sidebar-container");
        let mainContainer = $("main");

        sideBarContainer.css('display', 'none');
        mainContainer.css('display', 'inline-block');
    });

    //Close session message
    $(".session-message-container").on('click', '#closeSessionMessage', function () {
        let sessionMessageContainer = $('.session-message-container');

        sessionMessageContainer.toggleClass('show-session-message');
    });

    //Carousel Container
    $('#carousel-button-next').click(function () {
        let curImg = $(".active-carousel-car-image");
        let nextImg = curImg.next();

        if (nextImg.length) {
            $(this).css('cursor', 'pointer');
            curImg.removeClass("active-carousel-car-image");
            nextImg.addClass("active-carousel-car-image");
        }
    });

    $('#carousel-button-prev').click(function () {
        let curImg = $(".active-carousel-car-image");
        let prevImg = curImg.prev();

        if (prevImg.length) {
            $(this).css('cursor', 'pointer');
            curImg.removeClass("active-carousel-car-image");
            prevImg.addClass("active-carousel-car-image");
        }
    });


    //view car tabs

    //car tabs
    $("#car-accessories-header").click(function () {
        $(this).addClass("tab-item-header-active");
        $("#car-description-header").removeClass("tab-item-header-active");
        $("#car-description-content").hide();
        $("#car-accessories-content").show();
    });

    $("#car-description-header").click(function () {
        $(this).addClass("tab-item-header-active");
        $("#car-accessories-header").removeClass("tab-item-header-active");
        $("#car-accessories-content").hide();
        $("#car-description-content").show();
    });

    //report start date change - set min date of end date
    $("#reportFilterStartDate").change(() => {
        let reportFilterEndDate = $("#reportFilterEndDate");
        reportFilterEndDate.val('');
        reportFilterEndDate.attr('readonly', false);
        let endDateMinDate = $("#reportFilterStartDate").val();
        reportFilterEndDate.attr('min', endDateMinDate);
    });

    let rentalReportSelectField = $("#rentalReportSelectField");

    for (let i = 2000; i <= 2099; i++) {
        rentalReportSelectField.append(`<option value='${i}'>${i}</option>`);
    }


    var table = $('#categoryDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "category",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cars_count', name: 'cars_count' },
            { data: 'date_added', name: 'date_added' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

});



function setCarUnavail(id) {

    Swal.fire({
        title: "Warning!",
        text: "Are you sure you want to set Unavailable?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("confirmed");
        }
        else {
            console.log("cancelled");
        }
    });

}

function approveCarRental(id) {

    Swal.fire({
        title: "Warning!",
        text: "Are you sure you want to Approve?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("confirmed");
        }
        else {
            console.log("cancelled");
        }
    });

}

function cancelCarRental(id) {
    Swal.fire({
        title: "Are you sure you want to cancel?",
        text: "Are you sure you want to Cancel?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Yes",
        html: "<textarea id='cancel-reason' placeholder='Reason' style='width: 100%; height: 100px;resize:none;padding-left: 10px; padding-top:5px;font-size:18px; margin-top: 30px'></textarea>"
    }).then((result) => {
        if (result.isConfirmed) {
            let cancelReason = $("#cancel-reason").val();
            console.log(cancelReason);
            console.log("confirmed");
        }
        else {
            console.log("cancelled");
        }
    });
}

function markAsCompletedRental(id) {
    Swal.fire({
        title: "Warning",
        text: "Are you sure you want to mark as completed?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {

        if (result.isConfirmed) {
            console.log("completed")
        }
        else {
            console.log("cancelled")
        }

    });
}

function editPenalty(id) {
    Swal.fire({
        title: "Edit Penalty",
        text: "",
        icon: "warning",
        html: "<input type='number' placeholder='Penalty' style='width: 100%; height: 40px;resize:none;padding-left: 10px; padding-top:5px;font-size:18px; margin-top: 30px'/>",
        confirmButtonText: "Save",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("confirmed")
        }
        else {
            console.log("cancelled")
        }
    });
}

function markAsPaid(id) {
    Swal.fire({
        title: "Warning",
        text: "Are you sure you want to mark as paid?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("confirmed");
        }
        else {
            console.log("cancelled");
        }
    });
}

function clearRevenueData() {

    let revenueStartDate = $("#reportFilterStartDate");
    let revenueEndDate = $("#reportFilterEndDate");
    let revenueAmount = $("#revenueAmount");
    let revenuePenaltyAmount = $("#revenuePenaltyAmount");
    let revenueTotalAmount = $("#revenueTotalAmount");
    let rentalPDF = $(".rentalPDF");

    if (rentalPDF.attr('disabled', false)) {
        rentalPDF.attr('disabled', true);
    }

    revenueStartDate.val("");
    revenueEndDate.val("");
    revenueAmount.val("0.00");
    revenuePenaltyAmount.val("0.00");
    revenueTotalAmount.val("0.00");

    //remove data table data
}

function clearRentalReportData() {
    let rentalReportSelectField = $("#rentalReportSelectField");
    let totalRentalsReport = $("#totalRentalsReport");
    let rentalPDF = $(".rentalPDF");

    rentalReportSelectField.val("--SELECT YEAR--");
    totalRentalsReport.val("0");

    if (rentalPDF.attr('disabled', false)) {
        rentalPDF.attr('disabled', true);
    }

    //remove data table data
}

function blockUser(id) {
    Swal.fire({
        title: "Warning",
        text: "Are you sure you want to block user?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("confirmed");
        }
        else {
            console.log("cancelled");
        }
    });
}

