function togglePasswordVisibility() {
  var x = document.getElementById("myInput");
  var eyeIcon = document.getElementById("eyeIcon");

  if (x.type === "password") {
    x.type = "text";
    eyeIcon.classList.remove("far", "fa-eye");
    eyeIcon.classList.add("fas", "fa-eye-slash");
  } else {
    x.type = "password";
    eyeIcon.classList.remove("fas", "fa-eye-slash");
    eyeIcon.classList.add("far", "fa-eye");
  }
}
