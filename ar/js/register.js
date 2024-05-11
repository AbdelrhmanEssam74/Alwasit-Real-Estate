$(document).ready(function () {
  const form = $("#form");
  const inputs = {
    firstName: $("#firstName"),
    lastName: $("#lastName"),
    email: $("#email"),
    password: $("#password"),
    confirmPassword: $("#confirmPassword"),
    phone: $("#phone"),
  };

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
    $errorDisplay.text(message).addClass("show");
    $errorDisplay.text(message).removeClass("hide");
    $input.css("border", "1px solid var(--secondary)");
    $inputIcon.css("color", "var(--secondary)");
    $input.on("click", function () {
      $errorDisplay.text(message).addClass("hide");
    });
  }
  // setInterval(() => {
  //   $(".error_message").addClass("hide");
  // }, 3000);
  function setSuccess($input) {
    const $inputControl = $input.parent();
    const $errorDisplay = $inputControl.find(".error_message");
    const $inputIcon = $inputControl.find("i");
    $errorDisplay.hide();
    $input.css("border", "1px solid var(--success)");
    $inputIcon.css("color", "var(--success)");
  }

  function validateInputs() {
    for (const inputKey in inputs) {
      if (inputs.hasOwnProperty(inputKey)) {
        const $input = inputs[inputKey];
        const value = $input.val().trim();
        if (value === "") {
          let errorMessage = "";
          if (inputKey === "firstName") {
            errorMessage = " أدخل الإسم الأول";
          } else if (inputKey === "lastName") {
            errorMessage = " أدخل الإسم الأخير";
          } else if (inputKey === "email") {
            errorMessage = "أدخل البريد الإلكتروني";
          } else if (inputKey === "phone") {
            errorMessage = "أدخل رقم الهاتف";
          }
          if (errorMessage !== "") {
            setErrors($input, errorMessage);
          }
        } else {
          setSuccess($input);
        }
      }
    }

    const passwordValue = inputs.password.val().trim();
    const confirmPasswordValue = inputs.confirmPassword.val().trim();
    inputs.password.on("input", function () {
      if ($(this).val().length < 8) {
        setErrors(inputs.password, "كلمة السر أقل من 8 حروف");
      } else {
        setSuccess(inputs.password);
      }
    });
    inputs.confirmPassword.on("input", function () {
      if ($(this).val() != inputs.password.val()) {
        setErrors(inputs.confirmPassword, "كلمة السر غير مطابقة");
      } else {
        setSuccess(inputs.confirmPassword);
      }
    });

    if (passwordValue.length < 8) {
      setErrors(inputs.password, " أدخل كلمة السر");
    } else {
      setSuccess(inputs.password);
    }

    if (confirmPasswordValue === "") {
      setErrors(inputs.confirmPassword, "أعد إدخال كلمة السر");
    } else {
      setSuccess(inputs.confirmPassword);
    }
  }

  inputs.phone.on("input", function () {
    const $phone = $(this);
    $phone.val($phone.val().replace(/\D/g, ""));
    if (!/^\d*$/.test($phone.val())) {
      setErrors($phone, "أدخل رقمًا صحيحًا");
    } else {
      setSuccess($phone);
    }
  });

  function isFormValid() {
    return form.find(".error_message:visible").length === 0;
  }
});
//SECTION -  end form validation

//NOTE - show and hide the password
var eyeShowPassword = document.querySelector("#eyeShowPassword");
var eyeHidePassword = document.querySelector("#eyeHidePassword");

var passwordInput = document.querySelector("#password");
var confirm_passwordInput = document.querySelector("#confirmPassword");
eyeShowPassword.addEventListener("click", showPassword);
eyeHidePassword.addEventListener("click", hidePassword);
function showPassword(e) {
  eyeHidePassword.style.display = "block";
  eyeShowPassword.style.display = "none";
  passwordInput.type = "text";
  confirm_passwordInput.type = "text";
}
function hidePassword(e) {
  eyeShowPassword.style.display = "block";
  eyeHidePassword.style.display = "none";
  passwordInput.type = "password";
  confirm_passwordInput.type = "password";
}

//NOTE - toggle_menu
//menu icon
const menuicon = document.querySelector(".toggle_menu");
//menu
const menu = document.getElementById("menu");
menuicon.addEventListener("click", () => {
  menu.classList.toggle("show_menu");
  menuicon.classList.toggle("fouced");
});

setTimeout(() => {
  if (menu.classList.contains("show_menu")) {
    menu.classList.remove("show_menu");
  }
}, 5000);

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
});
