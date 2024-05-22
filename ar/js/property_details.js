$(document).ready(function () {
  "use strict";
  $("[placeholder]")
    .focus(function () {
      $($(this).attr("data-text", $(this).attr("placeholder")));
      $(this).attr("placeholder", " ");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });
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
  $(".show-more").on("click", function () {
    const fullDescription = $(this).attr("data-full-desc");
    const descriptionDiv = $(this).parent().find("p");

    if (descriptionDiv.hasClass("full")) {
      // Already showing full description, toggle to truncated
      const truncatedDescription = "..." + fullDescription.substr(0, 18);
      const strippedDescription = truncatedDescription.replace(
        /<br\s?\/?>/gi,
        ""
      );
      descriptionDiv.html(strippedDescription);
      descriptionDiv.removeClass("full");
      $(this).text("عرض المزيد");
    } else {
      // Show full description
      descriptionDiv.html(fullDescription);
      descriptionDiv.addClass("full");
      $(this).text("عرض أقل");
    }
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
  $(".alert_close, .modal-overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".modal-overlay").css("display", "none");
  });
  // before send any comment message to the owner check if the user already login or not
  // check if any input if empty and disabled the button
  function initializeCommentForm(inputs, sendBtn) {
    let btn = $(sendBtn);
    btn.prop("disabled", true).addClass("disabled");
    function checkInputs() {
      let allInputsFilled = true;
      for (let input of inputs) {
        if (input.element.val().length < input.minLength) {
          allInputsFilled = false;
          input.element.parent().attr("data-warning", "الرجاء ملء هذا الحقل");
          input.element.css("border", "1px solid red");
        } else {
          input.element.parent().removeAttr("data-warning");
          input.element.css("border", "");
        }
      }
      btn.prop("disabled", !allInputsFilled);
      btn.toggleClass("disabled", !allInputsFilled);
      btn.toggleClass("enable", allInputsFilled);
    }

    for (let input of inputs) {
      input.element.on("input", checkInputs);
    }
  }

  // Example usage:
  let inputs = [
    {
      element: $("#comment-form #comment-content"),
      minLength: 20,
    },
  ];

  let send_comment_btn = $(".send-comment");

  // Call the function to initialize the comment form
  initializeCommentForm(inputs, send_comment_btn);
  //NOTE - Send comment to server
  $(".send-comment").on("click", function () {
    // send request to DB to check if the user is login or not
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
          $(".modal-container-2 .login").on("click", function () {
            location.href = "login.php";
          });
        } else if (data == 1) {
          // if user is logged in
          let comment = $("#comment-form #comment-content").val();
          let send_comment_btn = $(".send-comment");
          let formData = new FormData();
          formData.append("comment", comment);
          formData.append("user_id", send_comment_btn.attr("data-userID"));
          formData.append("owner_id", send_comment_btn.attr("data-ownerID"));
          formData.append(
            "property_id",
            send_comment_btn.attr("data-propertyID")
          );
          // send the data to the server
          $.ajax({
            method: "POST",
            url: "send_comment.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              if (data == 1) {
                showUpdateMessage("تم ارسال التعليق بنجاح");
                setInterval(() => {
                  location.reload();
                }, 1500);
              }
            },
            error: function (xhr, status, error) {
              console.error(xhr);
            },
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  //NOTE - Send offer about spacific property to the owner
  let send_offer_btn = $(".send-offer");
  send_offer_btn.prop("disabled", true).addClass("disabled");
  // Example usage:
  let inputs2 = [
    {
      element: $(".connection-with-owner #offer-content"),
      minLength: 20,
    },
  ];

  initializeCommentForm(inputs2, send_offer_btn);
  $(".send-offer").on("click", function () {
    // send request to DB to check if the user is login or not
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
          $(".modal-container-2 .login").on("click", function () {
            location.href = "login.php";
          });
        } else if (data == 1) {
          // if user is logged in
          let offer = $(".connection-with-owner #offer-content").val();
          let send_offer_btn = $(".send-offer");
          let formData = new FormData();
          formData.append("offer", offer);
          formData.append("user_id", send_offer_btn.attr("data-userID"));
          formData.append("owner_id", send_offer_btn.attr("data-ownerID"));
          formData.append(
            "property_id",
            send_offer_btn.attr("data-propertyID")
          );
          // send the data to the server
          $.ajax({
            method: "POST",
            url: "send_offer.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              if (data == 1) {
                showUpdateMessage("تم ارسال  العرض  بنجاح");
              }
            },
            error: function (xhr, status, error) {
              console.error(xhr);
            },
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  //////////////////////////////////////
  let formData = new FormData();
  formData.append("property_id", send_comment_btn.attr("data-propertyID"));
  //NOTE - Get the comments from the server and display them in the DOM
  $.ajax({
    method: "POST",
    url: "get_comments.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
      var parsedData = $.parseJSON(data);
      if ($.isArray(parsedData)) {
        if (Object.keys(parsedData).length === 0) {
          $(".comments .content").append(
            $("<h5>").text("لا يوجد تعليقات").css("color", "#868686")
          );
        } else {
          $.each(parsedData, function (index, obj) {
            var comment = createCommentElement(obj);
            $(".comments .content").append(comment);
          });
        }
      }
    },
  });

  function getTimestampString(timestamp) {
    var currentTime = new Date();
    var previousTime = new Date(timestamp);
    var timeDifference = currentTime - previousTime;

    // Convert to Europe/Sofia time zone
    var desiredTimeZone = "Europe/Sofia";
    var convertedPreviousTime = new Date(
      previousTime.toLocaleString("en-US", { timeZone: desiredTimeZone })
    );

    var minutes = Math.floor(timeDifference / 60000);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);
    var months = Math.floor(days / 30);

    if (months > 0) {
      return months + " month(s) ago";
    } else if (days > 0) {
      return days + " day(s) ago";
    } else if (hours > 0) {
      return hours + " hour(s) ago";
    } else if (minutes > 0) {
      return minutes + " minute(s) ago";
    } else {
      // Check if the previous time is in the future
      if (convertedPreviousTime > currentTime) {
        return "In the future";
      } else {
        // Format the current time in 12-hour format
        var currentHours = currentTime.getHours();
        var suffix = currentHours >= 12 ? "PM" : "AM";
        var formattedHours = currentHours % 12 || 12;
        var minutes = currentTime.getMinutes();
        var currentTimeFormatted =
          formattedHours + ":" + ("0" + minutes).slice(-2) + " " + suffix;

        return "Just now at " + currentTimeFormatted;
      }
    }
  }
  // Function to create comment element based on JSON object input
  function createCommentElement(commentData) {
    var comment = $("<div>")
      .addClass("comment")
      .attr("commentID", commentData.comment_id)
      .attr("uID", commentData[1])
      .attr("pID", commentData.property_id);
    var deleteButton = $("<button>")
      .attr("title", "حذف التعليق")
      .addClass("delete-comment")
      .html("<i class='fa-solid fa-trash-can'></i>");
    // check if the user is login or not and display the delete button
    if ($(".comments .content").attr("data-loID") == commentData[1]) {
      deleteButton.appendTo(comment);
    }
    var image = $("<div>").addClass("image");
    var imgSrc = $(".comments  .content").attr("data-img-src");
    $("<img>")
      .attr("src", imgSrc + commentData.profile_img)
      .appendTo(image);
    var details = $("<div>").addClass("details");
    $("<h4>").text(commentData.FullName).appendTo(details);
    $("<p>").text(commentData.content).appendTo(details);
    var timestamp = getTimestampString(commentData.timestamp);
    $("<span>").text(timestamp).appendTo(details);
    image.appendTo(comment);
    details.appendTo(comment);
    // Add event listener to delete button
    deleteButton.on("click", function () {
      var commentID = comment.attr("commentID");
      var uID = comment.attr("uID");
      var PID = comment.attr("pid");
      deleteComment(commentID, uID, PID);
    });
    return comment;
  }

  // Update the timestamp every minute
  setInterval(function () {
    $(".comments .comment").each(function () {
      var timestamp = $(this).find("span").data("timestamp");
      var timestampSpan = $(this).find("span");
      updateTimestamp(timestamp, timestampSpan);
    });
  }, 60000);
  // Scroll to the top of the page and Reload the page
  function scrollToTopAndReload() {
    $(window).scrollTop(0);
    location.reload();
  }
  setTimeout(scrollToTopAndReload, 600000); // Scroll to top and reload after 10 minutes (600,000 milliseconds)
  // Function to to delete the comment from the comment list
  function deleteComment(commentID, uID, PID) {
    $.ajax({
      method: "POST",
      url: "delete_comment.php",
      data: {
        commentID: commentID,
        uID: uID,
        PID: PID,
      },
      success: function (response) {
        // Optionally, you can remove the comment element from the DOM
        $(".comments .comment[commentID='" + commentID + "']").remove();
      },
      error: function (error) {
        console.error("Failed to delete comment:", error);
      },
    });
  }
  // report property
  $(".report-links").on("click", function () {
    $(".report-property").addClass("active");
    $(".report-property .overlay ").on("click", function () {
      $(".report-property").removeClass("active");
    });
    $(".report-property .cancel-report").on("click", function () {
      $(".report-property").removeClass("active");
    });
    // send report to server
    let send_report_btn = $(".report-property .submit-report");
    send_report_btn.on("click", function () {
      // send request to DB to check if the user is login or not
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
            let report_reason = $(".select-dropdown__item select").val();
            if (report_reason == "") {
              // check if the reason is empty or not
              $(".input__message").addClass("input__message--invalid");
            } else {
              // if reason not empty get the value and send it to the server
              let report_reason = $(".select-dropdown__item select").val();
              let additional_reason = $("#additional_reason").val();
              let formData = new FormData();
              formData.append("report_reason", report_reason);
              formData.append("additional_reason", additional_reason);
              formData.append("user_id", send_report_btn.attr("data-userID"));
              formData.append("owner_id", send_report_btn.attr("data-ownerID"));
              formData.append(
                "property_id",
                send_report_btn.attr("data-propertyID")
              );
              // // send the data to the server
              $.ajax({
                method: "POST",
                url: "send_report.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                  if (data == 1) {
                    $(".report-property").removeClass("active");
                    showUpdateMessage("تم إرسال التقرير  بنجاح");
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
  });
  // display red heart for each favorite item
  if ($(".add_to_fav").attr("data-fav") === "1") {
    $(".add_to_fav").addClass("favorated");
  }
  // display the number of favorite items
  let user_id = $(".add_to_fav").attr("data-uid");
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
  // Copy the URL of the property to the clipboard
  $(".share").on("click", function () {
    let url = window.location.href;
    navigator.clipboard
      .writeText(url) // Write the text to the clipboard
      .then(function () {
        showUpdateMessage("تم نسخ العنوان إلى الحافظة");
      })
      .catch(function (err) {
        console.error("Failed to copy text: ", err); // Show an error message (you can customize this)
      });
  });
  function showUpdateMessage(message) {
    let updateMessage = $(".update-message2");
    updateMessage.text(message).addClass("show").removeClass("hide");

    updateMessage.on("click", function () {
      $(this).removeClass("show").addClass("hide");
    });

    setTimeout(function () {
      updateMessage.addClass("hide").removeClass("show");
    }, 3000);
  }
});

// Get Slider items
let images = Array.from(
  document.querySelectorAll(".image-gallery .container img")
);
let sizeOfArr = images.length;
let currentSlide = 0;

// Previous and Next Button
let nextButton = document.querySelector(".next");
let prevButton = document.querySelector(".prev");

// Handle click on prev and next button
if (nextButton) {
  nextButton.onclick = NextSlide;
}
if (prevButton) {
  prevButton.onclick = PrevSlide;
}
// Show current slide
function ShowSlide() {
  let popupImg = document.querySelector(".popup-img img");
  popupImg.src = images[currentSlide].getAttribute("src");
}
// Next slide function
function NextSlide() {
  currentSlide++;
  if (currentSlide >= sizeOfArr) {
    currentSlide = 0;
  }
  ShowSlide();
}

// Previous slide function
function PrevSlide() {
  currentSlide--;
  if (currentSlide < 0) {
    currentSlide = sizeOfArr - 1;
  }
  ShowSlide();
}

images.forEach(function (image, index) {
  image.addEventListener("click", () => {
    currentSlide = index;
    ShowSlide();
    document.querySelector(".popup-img").style.display = "block";
  });
});

document.querySelector(".popup-img .close-popupImg").onclick = () => {
  document.querySelector(".popup-img").style.display = "none";
};
document.querySelector(".popup-img .overlay-close").onclick = () => {
  document.querySelector(".popup-img").style.display = "none";
};

// Keyboard navigation
document.addEventListener("keydown", function (event) {
  if (event.key === "ArrowRight") {
    NextSlide();
  } else if (event.key === "ArrowLeft") {
    PrevSlide();
  } else if (event.key === "Escape") {
    document.querySelector(".popup-img").style.display = "none";
  }
});

// fixed navbar
window.addEventListener("scroll", function () {
  let header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY);
});

// send whatsApp message
function send_handle() {
  const whatsAppBtn = document.querySelector(".button-whatsapp");
  const num = whatsAppBtn.dataset.phone;
  const link = whatsAppBtn.getAttribute("data-propertyLink");
  const message_model = `
    مرحباً
    أود الحصول على المزيد من المعلومات 
    حول هذا العقار المنشور على موقع 
    alwasite.eg
    نوع العقار: فيلا
    السعر: 3,721,600 جنيه
    الموقع: المدينة
    الرابط: ${link}
    `;
  const win = window.open(
    `https://wa.me/${num}?text=${message_model}`,
    "_blank"
  );
}
const phone_btn = document.querySelector(".phone-link");
const num = phone_btn.dataset.phone;
phone_btn.addEventListener("click", () => {
  phone_btn.textContent = num;
});

$(document).ready(function () {
  "use strict";
});

//SECTION - google map api
function initMap() {
  var location = document.querySelector(".property-location");
  // map options
  var options = {
    zoom: 19,
    center: {
      lat: Number(location.dataset.lat),
      lng: Number(location.dataset.lang),
    },
  };
  // new map
  var map = new google.maps.Map(document.getElementById("map"), options);
  // add marker
  var marker = new google.maps.Marker({
    position: {
      lat: Number(location.dataset.lat),
      lng: Number(location.dataset.lang),
    },
    map: map,
  });

  // function to add marker dynamice
  function addMarker(pos) {
    var marker = new google.maps.Marker({
      position: pos.coords,
      map: map,
    });
    var infoWindow = new google.maps.InfoWindow({
      content: pos.content,
    });
    marker.addListener("click", function () {
      infoWindow.open(map, marker);
    });
  }

  addMarker({
    coords: {
      lat: Number(location.dataset.lat),
      lng: Number(location.dataset.lang),
    },
  });
}
