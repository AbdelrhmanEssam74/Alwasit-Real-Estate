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
    
    // Form submission event listener
    form.on("submit", function (e) {
      validateInputs();
      if (isFormValid()) {
        form.submit();
      } else {
        e.preventDefault(); // Prevent form submission by default
      }
    });
    
    // Function to set error messages and styles for inputs
    function setErrors($input, message) {
      const $inputControl = $input.parent();
      const $errorDisplay = $inputControl.find(".error_message");
      const $inputIcon = $inputControl.find("i");
      $errorDisplay.text(message).addClass("show");
      $errorDisplay.text(message).removeClass("hide");
      $input.css("border", "1px solid var(--secondary)");
      $inputIcon.css("color", "var(--secondary)");
      $input.on("click", function () {
        $errorDisplay.text(message).addClass("hide");
      });
    }
    
    // Function to set success styles for inputs
    function setSuccess($input) {
      const $inputControl = $input.parent();
      const $errorDisplay = $inputControl.find(".error_message");
      const $inputIcon = $inputControl.find("i");
      $errorDisplay.hide();
      $input.css("border", "1px solid var(--success)");
      $inputIcon.css("color", "var(--success)");
    }
    
    // Function to validate inputs
    function validateInputs() {
      const emailValue = email.val().trim();
      const passwordValue = password.val().trim();
    
      // Validate email input
      if (emailValue === "") {
        setErrors(email, "ادخل بريدك الالكتروني");
      } else {
        setSuccess(email);
      }
    
      // Validate password input
      if (passwordValue === "") {
        setErrors(password, "ادخل كلمة السر");
      } else {
        setSuccess(password);
      }
    }
    
    // Function to check if the form is valid (no visible error messages)
    function isFormValid() {
      const errors = form.find(".error_message:visible");
      return errors.length === 0;
    }

  $(".logout").on("click", function () {
    let user_id = $(".logout").attr("data-uid");
    $.ajax({
      url: "http://localhost/Alwasit/auth/logout.php",
      type: "POST",
      data: {
        logout_user_id: user_id,
      },
      success: function (response) {
        $(".logout_message").addClass("show");
        // window.location.href = "login.php";
      },
    });
  });
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
