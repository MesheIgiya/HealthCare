$(function () {});

$("#login_form").on("submit", function (e) {
  e.preventDefault();
});

$("#submit_login").click(function () {
  if ($("#login_form").valid()) {
    submit_login($("#login_form").serialize());
  } else {
    alert("Please input all fields!");
  }
});

function submit_login($formData) {
  $.ajax({
    dataType: "json",
    url: "../scripts_doctor/login.php",
    data: $formData,
    type: "POST",
  }).done(function (result) {
    console.log(result);
    if (result["success"]) {
      window.location.href = "../doctor/dashboard.php";
    } else {
      alert(result["error"]);
    }
  });
}
