$(document).ready(function () {
  "user strike";
  $("[placeholder]")
    .focus(function () {
      $($(this).attr("data-text", $(this).attr("placeholder")));
      $(this).attr("placeholder", " ");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });

  const form = $("#form");
  const email = $("#email");
  const password = $("#password");

  form.on("submit", function (e) {
    validateInputs();
    if (isFormValid()) {
      form.submit();
    } else {
      e.preventDefault(); // Prevent form submission by default
    }
  });

  function setErrors($input, message) {
    const $inputControl = $input.parent();
    const $errorDisplay = $inputControl.find(".error_message");
    const $inputIcon = $inputControl.find("i");
    $errorDisplay.text(message).show();
    $input.css("border", "1px solid var(--danger)");
    $inputIcon.css("color", "var(--danger)");
  }

  function setSuccess($input) {
    const $inputControl = $input.parent();
    const $errorDisplay = $inputControl.find(".error_message");
    const $inputIcon = $inputControl.find("i");
    $errorDisplay.hide();
    $input.css("border", "1px solid var(--success)");
    $inputIcon.css("color", "var(--success)");
  }

  function validateInputs() {
    const emailValue = email.val().trim();
    const passwordValue = password.val().trim();

    if (emailValue === "") {
      setErrors(email, "ادخل بريدك الالكتروني");
    } else {
      setSuccess(email);
    }

    if (passwordValue === "") {
      setErrors(password, "ادخل كلمة السر");
    } else {
      setSuccess(password);
    }
  }

  function isFormValid() {
    const errors = form.find(".error_message:visible");
    return errors.length === 0;
  }

  // $('.logout').on('click', function() {
  //   console.log("logout");
  // })
});
//SECTION -  end form validation

//NOTE - show and hide the password
var eyeShowPassword = document.querySelector("#eyeShowPassword");
var eyeHidePassword = document.querySelector("#eyeHidePassword");

var passwordInput = document.querySelector("#password");
eyeShowPassword.addEventListener("click", showPassword);
eyeHidePassword.addEventListener("click", hidePassword);
function showPassword(e) {
  eyeHidePassword.style.display = "block";
  eyeShowPassword.style.display = "none";
  passwordInput.type = "text";
}
function hidePassword(e) {
  eyeShowPassword.style.display = "block";
  eyeHidePassword.style.display = "none";
  passwordInput.type = "password";
}

//NOTE - toggle_menu
//menu icon
const menuicon = document.querySelector(".toggle_menu");
//menu
const menu = document.getElementById("menu");
menuicon.addEventListener("click", () => {
  menu.classList.toggle("show_menu");
});

setTimeout(() => {
  if (menu.classList.contains("show_menu")) {
    menu.classList.remove("show_menu");
  }
}, 5000);
