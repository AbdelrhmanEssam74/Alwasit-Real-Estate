// Get all navigation items

const navItems = document.querySelectorAll(".sidebar__list-item");

// Add a click event listener to each item
navItems.forEach((item) => {
  item.addEventListener("click", function () {
    // Remove the "active" class from all items
    navItems.forEach((navItem) => {
      navItem.classList.remove("is_active");
    });
    // Add the "active" class to the clicked item
    this.classList.add("is_active");
  });
});

$(function () {
  "use strict";
  //NOTE - Hide Placeholder On Form focus

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
  $("[placeholder]")
    .focus(function () {
      $($(this).attr("data-text", $(this).attr("placeholder")));
      $(this).attr("placeholder", " ");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });
  // Add Asterisk On Required Field
  $("input").each(function () {
    if ($(this).attr("required") === "required") {
      $(this).after('<span class="asterisk">*</span>');
    }
  });
  // update the user personal info in the DB
  $(".personal_info_save_btn").on("click", function () {
    let user_id = $(".personal_info_save_btn").attr("data-UID");
    let oldImg = $(".oldimg").attr("value").split("/").pop();
    let newImg = $("#newProfileImage").prop("files")[0]?.name || null;
    let formData = new FormData();
    // Iterate through all input fields with the class 'dynamic-input'
    $(".dynamic-input").each(function () {
      let inputId = $(this).attr("id");
      let inputValue = $(this).val();
      formData.append(inputId, inputValue);
    });
    // Append common form data
    formData.append("submit", "personal_info");
    formData.append("id", user_id);
    formData.append("oldImg", oldImg);
    if (newImg) {
      formData.append("newImg", newImg);
    }
    let success_message = $(".success-message");
    $.ajax({
      method: "POST",
      url: "update.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data === "1") {
          success_message.addClass("show-success").text("Saved Successfully");
          setTimeout(function () {
            success_message.removeClass("show-success");
          }, 5000);
        } else {
          success_message.addClass("show-failed").text("Save Failed");
          setTimeout(function () {
            success_message.removeClass("show-failed");
          }, 5000);
        }

        $(
          ".invalid-username-value, .invalid-fName-value, .invalid-lName-value"
        ).css("display", "none");

        if (data === "nameEmpty") {
          $(".invalid-username-value").css("display", "block");
        }
        if (data === "fNameEmpty") {
          $(".invalid-fName-value").css("display", "block");
        }
        if (data === "lNameEmpty") {
          $(".invalid-lName-value").css("display", "block");
        }

        success_message.click(function () {
          $(this).removeClass("show-failed show-success");
        });
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // update the user contact info in the DB
  $(".contact_info_save_btn").on("click", function () {
    let user_id = $(".contact_info_save_btn").attr("data-UID");
    let phoneInput = $("#phone_num");
    let phoneValue = phoneInput.val();
    let formData = new FormData();
    // Append common form data
    formData.append("phone", phoneValue);
    formData.append("submit", "contact_info");
    formData.append("id", user_id);
    let success_message = $(".success-message");
    $.ajax({
      method: "POST",
      url: "update.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data === "1") {
          success_message.addClass("show-success").text("Saved Successfully");
          setTimeout(function () {
            success_message.removeClass("show-success");
          }, 5000);
        } else {
          success_message.addClass("show-failed").text("Save Failed");
          setTimeout(function () {
            success_message.removeClass("show-failed");
          }, 5000);
        }
        $(".invalid-num-value").css("display", "none");

        if (data === "Cant Be Empty") {
          $(".invalid-num-value").css("display", "block").text(data);
        }
        if (data === "Invalid Phone Number") {
          $(".invalid-num-value").css("display", "block").text(data);
        }

        success_message.click(function () {
          $(this).removeClass("show-failed show-success");
        });
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // update the user password info in the DB
  // if the user enter a dont enter new password disapled the save button and enabled it when he enters something
  let newpass = document.getElementById("newpassword");
  if (newpass) {
    if (newpass.value.length < 8) {
      $(".pass_info_save_btn")
        .attr("disabled", "disabled")
        .addClass("disabled");
      newpass.addEventListener("input", function () {
        if (newpass.value.length < 8) {
          $(".pass_info_save_btn").attr("disabled", "disabled");
        } else {
          $(".pass_info_save_btn")
            .removeAttr("disabled")
            .removeClass("disabled");
        }
      });
    }
  }
  $(".pass_info_save_btn").on("click", function () {
    let user_id = $(this).attr("data-UID");
    let oldPass = $("#oldpassword").val();
    let currentpass = $("#currentpass").val();
    let newpass = $("#newpassword").val();
    if (newpass.length < 8) {
      $(".invalid-newpass-value")
        .css("display", "block")
        .text("Password must be at least 8 characters");
    }
    let formData = new FormData();
    // Append common form data
    formData.append("submit", "Password-info");
    formData.append("id", user_id);
    formData.append("oldpass", oldPass);
    formData.append("pass_old_input", currentpass);
    formData.append("newpass", newpass);
    let success_message = $(".success-message");
    $.ajax({
      method: "POST",
      url: "update.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data === "Cant Be Empty") {
          $(".invalid-pass-value").css("display", "block").text(data);
        }
        if (data === "Wrong Password") {
          $(".invalid-pass-value").css("display", "block").text(data);
        }
        if (data === "New Password Cant be empty") {
          $(".invalid-newpass-value").css("display", "block").text(data);
        }
        if (data === "You Use This Password Before! Try Another One.") {
          $(".invalid-newpass-value").css("display", "block").text(data);
        }
        $(".invalid-pass-value, .invalid-newpass-value").css("display", "none");
        if (data === "1") {
          success_message.addClass("show-success").text("Saved Successfully");
          setTimeout(function () {
            success_message.removeClass("show-success");
            window.location.reload();
          }, 5000);
        } else {
          success_message.addClass("show-failed").text("Save Failed");
          setTimeout(function () {
            success_message.removeClass("show-failed");
          }, 5000);
        }
        success_message.click(function () {
          $(this).removeClass("show-failed show-success");
        });
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });

  // send ajax request to owner index file to check if the user has permission or not
  $(".checkOwner").on("click", function () {
    $.ajax({
      method: "POST",
      url: "../owner/index.php",
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
      url: "../owner/index.php",
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

  // close alert modal
  $(".alert_close, .overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".overlay").css("display", "none");
  });
});
