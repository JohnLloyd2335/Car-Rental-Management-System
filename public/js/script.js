$(document).ready(function () {

  // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  $("#cancelProfileEditButton").hide();
  $("#passwordRow").hide();

  //profile dropdown
  $("#dropdown-open").click(function () {
    $(".profile-dropdown-menu").toggleClass("profile-dropdown-menu-open");

    let caretIcon = $(".profile-dropdown-icon");

    if (caretIcon.hasClass("fa-caret-down")) {
      caretIcon.removeClass("fa-caret-down");
      caretIcon.addClass("fa-caret-up");
    } else {
      caretIcon.addClass("fa-caret-down");
      caretIcon.removeClass("fa-caret-up");
    }
  });

  //toggle icon
  $("#toggle-icon").click(function () {
    let navLinks = $(".nav-links");
    navLinks.toggleClass("nav-links-open");

    let toggleIcon = $(".toggle-icon");

    if (toggleIcon.hasClass("fa-bars")) {
      toggleIcon.removeClass("fa-bars");
      toggleIcon.addClass("fa-x");
    } else {
      toggleIcon.removeClass("fa-x");
      toggleIcon.addClass("fa-bars");

      if ($(".profile-dropdown-menu").hasClass("profile-dropdown-menu-open")) {
        $(".profile-dropdown-menu").removeClass("profile-dropdown-menu-open");
      }
    }
  });

  //card mouse enter and mouse leave
  for (let i = 0; i <= 4; i++) {
    //cards mouse enter
    $(`.card-${i}`).mouseenter(function () {
      $(`.card-${i}`)
        .children(`.card-text-container-${i}`)
        .css("display", "block");
      $(`.card-image-container-${i}`).css("display", "none");
      $(`card-title-container-${i}`).css("display", "none");
    });

    //cards mouse leave
    $(`.card-${i}`).mouseleave(function () {
      $(`.card-${i}`)
        .children(`.card-text-container-${i}`)
        .css("display", "none");
      $(`.card-image-container-${i}`).css("display", "block");
      $(`card-title-container-${i}`).css("display", "block");
    });
  }

  //filter price (high and low)
  $("#price-filter").click(function () {
    let filterToggleIcon = $(this).find(".fa-solid");
    let filterText = $(this).find("#price-filter-text");

    if (filterToggleIcon.hasClass("fa-arrow-up")) {
      filterToggleIcon.removeClass("fa-arrow-up");
      filterToggleIcon.addClass("fa-arrow-down");
      filterText.text("Price Low to High");
    } else {
      filterToggleIcon.removeClass("fa-arrow-down");
      filterToggleIcon.addClass("fa-arrow-up");
      filterText.text("Price High to Low");
    }
  });

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

  //carousel
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

  //Rent Car Modal
  $(".rent-car-btn").click(function () {
    $(".rent-car-modal").show();
  });

  $(".rent-car-modal-close").click(function () {
    $(".rent-car-modal").hide();
  });

  $("#mobile_number").on('input', function () {
    let value = $(this).val();

    if (value.length > 10) {
      value = value.slice(0, 10);
      $(this).val(value);
    }
  })
});

//set rent end date max val
function setRentEndDateMaxVal() {
  let startDate = $("#start_date");
  let endDate = $("#end_date");
  let startDateToDate = new Date($("#start_date").val());
  let endDateToDate = new Date($("#end_date").val());
  let daysHTML = $("#days");
  let totalAmountHTML = $("#total_amount");

  daysHTML.val("0");
  totalAmountHTML.val("₱ 0.00");
  if (endDateToDate > startDateToDate) {
    endDate.val("");
  }

  endDate.attr('disabled', false);
  endDate.attr('min', startDate.val());
}

//compute total amount
function computeTotalAmount(pricePerDay) {
  let startDateToDate = new Date($("#start_date").val());
  let endDateToDate = new Date($("#end_date").val());
  let daysHTML = $("#days");
  let totalAmountHTML = $("#total_amount");
  let days = 0;
  let totalAmount = 0;

  if (startDateToDate == null || endDateToDate == null) {
    totalAmount = 0;
    daysHTML.val("0");
  }
  else if ($("#start_date").val() == $("#end_date").val()) {
    days = 1;
    totalAmount = parseFloat(pricePerDay) * parseFloat(days);
  }
  else {
    let timeDifference = endDateToDate.getTime() - startDateToDate.getTime();
    days = Math.ceil(timeDifference / (1000 * 3600 * 24));
    totalAmount = parseFloat(pricePerDay) * parseFloat(days);
  }
  daysHTML.val(days);
  totalAmountHTML.val("₱ " + parseFloat(totalAmount).toFixed(2))
}

function showAccountSettingsInput() {

  let name = $("#name");
  let email = $("#email");
  let mobileNumber = $("#mobile_number");
  let address = $("#address");
  let password = $("#password");
  let confirmPassword = $("#confirmPassword");
  let cancelProfileEditButton = $("#cancelProfileEditButton");
  let editUpdateProfileButton = $("#editUpdateProfileButton");
  let passwordRow = $("#passwordRow");

  let inputKeys = ['name', 'email', 'mobile_number', 'address', 'password', 'confirmPassword'];

  inputKeys.forEach((element) => {
    $(`#${element}`).attr('disabled', false);
  });

  cancelProfileEditButton.show();
  editUpdateProfileButton.text("Update");
  passwordRow.show();

}

function cancelEditProfile() {
  let cancelProfileEditButton = $("#cancelProfileEditButton");
  let editUpdateProfileButton = $("#editUpdateProfileButton");
  let passwordRow = $("#passwordRow");
  let inputKeys = ['name', 'email', 'mobile_number', 'address', 'password', 'confirmPassword'];

  inputKeys.forEach((element, index) => {
    $(`#${element}`).attr('disabled', true);
  });

  cancelProfileEditButton.hide();
  editUpdateProfileButton.text("Edit");
  passwordRow.hide();
  //set profile details to logged in user
}

function cancelRental() {

  Swal.fire({
    title: "Warning",
    text: "Are you sure you want to cancel rental?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes"
  }).then((result) => {
    if (result.isConfirmed) {
      console.log("confirmed")
    }
    else {
      console.log("cancelled");
    }
  });

}

function serverErrorAlert() {
  Swal.fire({
    title: "Server Error",
    text: "Oops, There was an error",
    icon: "error"
  });
}

function clearRentalModalField() {
  let startDate = $("#start_date");
  let endDate = $("#end_date");
  let days = $("#days");
  let total_amount = $("#total_amount")

  startDate.val("");
  endDate.val("");
  endDate.attr('disabled', true);
  days.val("0");
  total_amount.val("₱ 0.00");
}

function rentCar(carId) {

  let startDate = $('#start_date');
  let endDate = $('#end_date');
  let totalAmount = $("#total_amount").val();
  totalAmount = parseFloat(totalAmount.slice(2));

  startDate.hasClass('input-error') ? $('#start_date').removeClass('input-error') : '';

  if (totalAmount <= 0) {
    Swal.fire({
      title: 'Warning',
      text: 'Please Complete All Details',
      icon: 'warning'
    });

    return;
  }
  console.log(carId, startDate.val(), endDate.val(), totalAmount);
  $.ajax({
    url: 'rent',
    method: 'GET',
    contentType: 'application/json',
    dataType: 'JSON',
    data: {
      car_id: carId,
      start_date: startDate.val(),
      end_date: endDate.val(),
      total_amount: totalAmount
    },
    headers: {
      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
    },

    success: function (response) {
      Swal.fire({
        title: 'Success',
        text: response.message,
        icon: 'success'
      });

      clearRentalModalField();


      $(".rent-car-modal").hide();

    },
    error: function (error) {
      console.log(error);

      let responseMessage = error.responseJSON.message;

      if (error.status == 422) {
        let errors = error.responseJSON.errors;

        let inputKeys = [
          'start_date', 'end_date'
        ];

        $.each(errors, (key, value) => {
          if (inputKeys.includes(key)) {
            $(`#${key}`).addClass('input-error');
          }
        });

        Swal.fire({
          title: 'Error',
          text: responseMessage,
          icon: 'error'
        });

      }


    }
  });

}


