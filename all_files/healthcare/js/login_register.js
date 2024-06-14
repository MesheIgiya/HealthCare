$(function () {
  $("#register").addClass("hidden");
});

$("#registration_form").on("submit", function (e) {
  e.preventDefault();
});

$("#login_form").on("submit", function (e) {
  e.preventDefault();
});

$("#register_btn").click(function () {
  $("#register").removeClass("hidden");
  $("#login").addClass("hidden");
});

$("#login_btn").click(function () {
  $("#register").addClass("hidden");
  $("#login").removeClass("hidden");
});

$("#submit_register").click(function () {
  if ($("#registration_form").valid()) {
    console.log($("#registration_form").serialize());
    submit_registration($("#registration_form").serialize());
  } else {
    alert("Please input all fields!");
  }
});

function submit_registration($formData) {
  $.ajax({
    dataType: "json",
    url: "../scripts/registration.php",
    data: $formData,
    type: "POST",
  }).done(function (result) {
    console.log(result);
    if (result["success"]) {
      location.reload();
    } else {
      alert(result["error"]);
    }
  });
}

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
    url: "../scripts/login.php",
    data: $formData,
    type: "POST",
  }).done(function (result) {
    console.log(result);
    if (result["success"]) {
      window.location.href = "../patient/dashboard.php";
    } else {
      alert(result["error"]);
    }
  });
}
