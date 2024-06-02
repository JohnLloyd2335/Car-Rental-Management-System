

$(document).ready(function () {


    $("#cancelProfileEditButton").hide();
    $("#passwordRow").hide();
    $("#updateProfileButton").hide();

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

    $("#year").on('input', function () {
        let value = $(this).val();

        if (value.length > 4) {
            value = value.slice(0, 4);
            $(this).val(value);
        }
    })

    $("#accessories").select2();


});

// document.addEventListener('livewire:init', function () {
//     $("#toggleCarAvailabilityButton").click(() => {
//         Swal.fire({
//             title: "Warning!",
//             text: "Are you sure you want to set Unavailable?",
//             icon: "info",
//             showCancelButton: true,
//             confirmButtonText: "Yes"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 let id = $("#toggleCarAvailabilityButton").data('id');

//                 Livewire.dispatch('updateCarAvailability', id);
//             }
//         });
//     });
// });





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

function showAccountSettingsInput() {

    let name = $("#name");
    let email = $("#email");
    let mobileNumber = $("#mobile_number");
    let address = $("#address");
    let password = $("#password");
    let confirmPassword = $("#confirmPassword");
    let cancelProfileEditButton = $("#cancelProfileEditButton");
    let editProfileButton = $("#editProfileButton");
    let updateProfileButton = $("#updateProfileButton");
    let passwordRow = $("#passwordRow");

    let inputKeys = ['name', 'email', 'mobile_number', 'address', 'password', 'confirmPassword'];

    inputKeys.forEach((element) => {
        $(`#${element}`).attr('disabled', false);
    });

    updateProfileButton.show();
    cancelProfileEditButton.show();
    editProfileButton.hide();



    passwordRow.show();

}

function cancelEditProfile() {
    let cancelProfileEditButton = $("#cancelProfileEditButton");
    let editProfileButton = $("#editProfileButton");
    let updateProfileButton = $("#updateProfileButton");
    let passwordRow = $("#passwordRow");
    let inputKeys = ['name', 'email', 'mobile_number', 'address', 'password', 'confirmPassword'];

    inputKeys.forEach((element, index) => {
        $(`#${element}`).attr('disabled', true);
    });

    cancelProfileEditButton.hide();
    updateProfileButton.hide();
    editProfileButton.show();


    passwordRow.hide();
    //set profile details to logged in user
}


