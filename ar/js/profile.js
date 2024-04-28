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
  let header = $("header .container");
  let login_box = $(".login_box");
  $(window).resize(function () {
    if ($(window).width() >= 767) {
      login_box.remove(); // Remove .login_box
    } else {
      header.append(login_box); // Append .login_box
    }
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
  // close alert modal
  $(".alert_close, .overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".overlay").css("display", "none");
  });
  // copy owner profile page url to clipboard
  $(".share-btn").on("click", function () {
    let url = window.location.href;
    navigator.clipboard.writeText(url); // Write the text to the clipboard
    alert("تم النسخ الي الحافظة");
  });
  // add proparty to favorate
  $(".favorite-box").on("click", function () {
    // send request to DB to check if the user is login or not
    let element = $(this);
    $.ajax({
      method: "POST",
      url: "checklogin.php",
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 0) {
          $(".modal-container-2").css("display", "flex");
          $(".modal-container-2  h2").text("للمتابعة يجب تسجيل الدخول اولاً");
          $(".modal-container-2 .login").text("تسجيل الدخول");
          $(".report-property").removeClass("active");
          $(".modal-container-2 .login").on("click", function () {
            location.href = "login.php";
          });
        } else if (data == 1) {
          // if user is logged in
          let property_id = element.attr("data-PID");
          let owner_id = element.attr("data-OID");
          let user_id = element.attr("data-UID");
          let is_fav = element.attr("data-fav");
          let formData = new FormData();
          formData.append("is_fav", is_fav);
          formData.append("property_id", property_id);
          formData.append("owner_id", owner_id);
          formData.append("user_id", user_id);
          if (is_fav == 0) {
            // send the data to the server
            $.ajax({
              method: "POST",
              url: "add_favorite.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                if (data == 1) {
                  element.attr("data-fav", 1);
                  // increase the number of favorites when user remove the favorite item
                  let saved_num = $(".favorite_page a").attr("data-saved");
                  $(".favorite_page a").attr("data-saved", ++saved_num);
                  element.addClass("favorated");
                  $(".success-message")
                    .addClass("show-success")
                    .text("تم حفظ العقار بنجاح")
                    .on("click", function () {
                      $(this).removeClass("show-success");
                    });
                  setTimeout(function () {
                    $(".success-message").removeClass("show-success");
                  }, 3000);
                }
              },
              error: function (xhr, status, error) {
                console.error(xhr);
              },
            });
          } else {
            $.ajax({
              method: "POST",
              url: "add_favorite.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                if (data == 1) {
                  element.attr("data-fav", 0);
                  // decrese the number of favorites when user remove the favorite item
                  let saved_num = $(".favorite_page a").attr("data-saved");
                  if (saved_num == 1) {
                    $(".favorite_page a").attr("data-saved", "");
                  } else {
                    $(".favorite_page a").attr("data-saved", --saved_num);
                  }
                  element.removeClass("favorated");
                  $(".success-message")
                    .addClass("show-success")
                    .text("العقار غير محفوظ")
                    .on("click", function () {
                      $(this).removeClass("show-success");
                    });
                  setTimeout(function () {
                    $(".success-message").removeClass("show-success");
                  }, 3000);
                }
              },
              error: function (xhr, status, error) {
                console.error(xhr);
              },
            });
          }
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // display red heart for each favorite item
  $(".favorite-box").each(function () {
    if ($(this).attr("data-fav") == "1") {
      $(this).addClass("favorated");
    }
  });
  // close alert modal
  $(".alert_close, .modal-overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".modal-overlay").css("display", "none");
  });
  // display the number of favorite items
  let user_id = $(".favorite_page a").attr("data-uid");
  $.ajax({
    url: "get_saved_num.php",
    method: "POST",
    data: { user_id: user_id },
    success: function (data) {
      if (data == 0) {
        $(".favorite_page a").attr("data-saved", "");
      } else {
        $(".favorite_page a").attr("data-saved", data);
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});
//SECTION -  Animate property body
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY);

  const propertyBodies = document.querySelectorAll(".property-body");
  const windowHeight = window.innerHeight;
  const windowWidth = window.innerWidth;

  if (windowWidth > 730) {
    propertyBodies.forEach(function (body) {
      const bodyTop = body.getBoundingClientRect().top;

      if (bodyTop < windowHeight) {
        body.classList.add("show");
        body.classList.remove("hide");
      } else {
        body.classList.remove("show");
        body.classList.add("hide");
      }
    });
  }
});
