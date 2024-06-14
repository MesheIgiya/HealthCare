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
          window.location.href = "../doctor/login.php";
        }
      });
    }
  });
});

$(".approve").click(function () {
  let id = $(this).val();
  console.log(id);
  approve_booking(id, "APPROVE");
});

$(".disapprove").click(function () {
  let id = $(this).val();
  console.log(id);
  approve_booking(id, "DISAPPROVE");
});

function approve_booking(id, action) {
  $.ajax({
    dataType: "json",
    url: "../scripts_doctor/approve_bookings.php",
    data: { id: id, action: action },
    type: "POST",
  }).done(function (result) {
    console.log(result);
    if (result["success"]) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Your work has been saved!",
        showConfirmButton: true,
      }).then(function () {
        location.reload();
      });
    } else {
      alert(result["error"]);
    }
  });
}
