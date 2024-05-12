// // animate navbar
// window.addEventListener("scroll", function () {
//   let header = document.querySelector("header");
//   header.classList.toggle("sticky", window.scrollY);
// });

$(document).ready(function () {
  "use strict";

  $(".toggle_menu").click(function () {
    $("#menu").toggleClass("show_menu");
    $(this).toggleClass("active");
  });
  if ($("#menu").hasClass("show_menu")) {
    $("body").on("click", function () {
      $("#menu").css("display", "none");
    });
  }
  if (!$("#menu").hasClass("show_menu")) {
    $(".toggle_menu").remove("active");
  }
  // toggle menu for user
  let droptn = $(".dropbtn img");
  let dropDown_list = $(".dropMenuContainer");
  droptn.click(function () {
    if (dropDown_list.hasClass("show")) {
      dropDown_list.removeClass("show");
    } else {
      dropDown_list.addClass("show");
    }
  });
  $(".dropMenuContainer").click(function () {
    if (dropDown_list.hasClass("show")) {
      dropDown_list.removeClass("show");
    }
  });
  // send ajax request to owner index file to check if the user has permission or not
  $(".checkOwner").on("click", function () {
    $.ajax({
      method: "POST",
      url: "owner/index.php",
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 2) {
          $(".modal-container").css("display", "flex");
          $(".modal-container h2")
            .text("طلب إذن الوصول للوحة التحكم")
            .css("color", "var(--head-line)");
          $(".modal-container p").text("لقد أرسلت طلب إذن الوصل من قبل");
          $(".modal-content-btn").remove();
          var close = $("<button>").addClass("modal-content-btn").text("حسنًا");
          close.appendTo(".modal-content");
        } else if (data == 0) {
          $(".modal-container").css("display", "flex");
          $(".modal-container h2")
            .text("غير مصرح لك بالوصول للوحة التحكم")
            .css("color", "var(--card-highlitght)");
          $(".modal-container p").text(
            " أرسل طلب إذن الوصول ويتم التواصل معك في اقرب وقت"
          );
          $(".modal-content-btn").text("إرسال");
        } else {
          var jsonData = $.parseJSON(data);
          if (jsonData.length > 1 && jsonData[0] == 1) {
            let url = jsonData[1];
            window.location.replace(url);
          }
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // if user clicked on this button send request to server to set user as owner
  $(".send-access-permission").on("click", function () {
    let formData = new FormData();
    formData.append("owner-request", 1);
    $.ajax({
      method: "POST",
      url: "owner/index.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 3) {
          $(".modal-container").css("display", "flex");
          $(".modal-container h2")
            .text("تم إرسال طلب إذن الوصول بنجاح")
            .css("color", "var(--success)");
          $(".modal-container p").text(
            " سيتم التواصل معك في اقرب وقت شكرا لإستخدامك موقع الوسيط"
          );
          $(".modal-content-btn").remove();
          var close = $("<button>").addClass("modal-content-btn").text("حسنًا");
          close.appendTo(".modal-content");
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // send message to the customer service
  let fullName = $("#fullName");
  let email = $("#email");
  let message = $("#message");

  function validateInputs() {
    let isValid = true;

    if (fullName.val() === "") {
      fullName.css("border", "1px solid red");
      fullName.after('<span class="error-message">من فضلك أدخل الأسم</span>');
      isValid = false;
    } else {
      fullName.css("border", "none");
      fullName.next(".error-message").remove();
    }

    if (email.val() === "") {
      email.css("border", "1px solid red");
      email.after(
        '<span class="error-message">من فضلك أدخل البريد الإلكتروني</span>'
      );
      isValid = false;
    } else {
      email.css("border", "none");
      email.next(".error-message").remove();
    }

    if (message.val() === "") {
      message.css("border", "1px solid red");
      message.after(
        '<span class="error-message m">من فضلك أدخل الرسالة</span>'
      );
      isValid = false;
    } else {
      message.css("border", "none");
      message.next(".error-message").remove();
    }

    return isValid;
  }
  $(".send-message").on("click", function () {
    // check if the user is logged in or not
    $.ajax({
      method: "POST",
      url: "checklogin.php",
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 0) {
          $(".modal-container-2").css("display", "flex");
          $(".modal-container-2 h2").text("للمتابعة يجب تسجيل الدخول اولاً");
          $(".modal-container-2 .login").text("تسجيل الدخول");
          $(".report-property").removeClass("active");
          $(".modal-container-2 .login").on("click", function () {
            location.href = "login.php";
          });
        } else {
          if (validateInputs()) {
            // Proceed with submitting the form or performing other actions
            let fullName = $("#fullName").val();
            let email = $("#email").val();
            let message = $("#message").val();
            let formData = new FormData();
            formData.append("fullName", fullName);
            formData.append("email", email);
            formData.append("message", message);

            $.ajax({
              method: "POST",
              url: "contactusBackend.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                console.log(data);
                showUpdateMessage(
                  "  تم الإرسال بنجاح , سيتم التواصل معك في اقرب وقت "
                );
              },
              error: function (xhr, status, error) {
                console.error(xhr);
              },
            });
          }
        }
      },
    });
  });
  // close alert modal
  $(".alert_close, .overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".overlay").css("display", "none");
  });
  $(".alert_close, .modal-overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".modal-overlay").css("display", "none");
  });
  function showUpdateMessage(message) {
    let updateMessage = $(".update-message");
    updateMessage.text(message).addClass("show").removeClass("hide");

    updateMessage.on("click", function () {
      $(this).removeClass("show").addClass("hide");
    });

    setTimeout(function () {
      updateMessage.addClass("hide").removeClass("show");
    }, 3000);
  }
});
