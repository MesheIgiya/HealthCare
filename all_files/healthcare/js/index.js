$(function () {});

$("#logout").click(function () {
  Swal.fire({
    title: "Log out?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        dataType: "json",
        url: "../scripts/logout_user.php",
        type: "POST",
      }).done(function (result) {
        if (result) {
          window.location.href = "../patient/login.php";
        }
      });
    }
  });
});

$("#booking_form").on("submit", function (e) {
  e.preventDefault();
});

$("#submit_appointment").click(function () {
  if ($("#booking_form").valid()) {
    submit_booking($("#booking_form").serialize());
  } else {
    alert("Please input all fields!");
  }
});

function submit_booking($formData) {
  $.ajax({
    dataType: "json",
    url: "../scripts/booking.php",
    data: $formData,
    type: "POST",
  }).done(function (result) {
    console.log(result);
    if (result["success"]) {
      $("#booking_form input").val("");
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Your booking has been successfully saved!",
        showConfirmButton: true,
      }).then(function () {
        location.reload();
      });
    } else {
      alert(result["error"]);
    }
  });
}
