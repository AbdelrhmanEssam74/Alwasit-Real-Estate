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
    const descriptionDiv = $(this).parent().find("p").text(fullDescription);
    console.log(fullDescription);
    if (descriptionDiv.hasClass("full")) {
      // Already showing full description, toggle to truncated
      const truncatedDescription = "..." + fullDescription.substr(0, 50);
      descriptionDiv.text(truncatedDescription);
      descriptionDiv.removeClass("full");
      $(this).text("عرض المزيد");
    } else {
      // Show full description
      descriptionDiv.text(fullDescription);
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
  $(".alert_close, .overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".overlay").css("display", "none");
  });
  // before send any comment message to the owner check if the user already login or not
  // check if any input if empty and disabled the button
  let inputs = [
    {
      element: $("#comment-form #comment-content"),
      minLength: 20,
    },
  ];
  let submitButton = $(".send-comment");
  submitButton.prop("disabled", true).addClass("disabled");
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
    submitButton.prop("disabled", !allInputsFilled);
    submitButton.toggleClass("disabled", !allInputsFilled);
    submitButton.toggleClass("enable", allInputsFilled);
  }
  for (let input of inputs) {
    input.element.on("input", checkInputs);
  }
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
          let submitButton = $(".send-comment");
          let formData = new FormData();
          formData.append("full_name", fullName);
          formData.append("user_mail", email);
          formData.append("comment", comment);
          formData.append("user_id", submitButton.attr("data-userID"));
          formData.append("owner_id", submitButton.attr("data-ownerID"));
          formData.append("property_id", submitButton.attr("data-propertyID"));
          // send the data to the server
          $.ajax({
            method: "POST",
            url: "send_comment.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              console.log(data);
              if (data == 1) {
                $(".success-message")
                  .addClass("show-success")
                  .text("تم ارسال التعليق بنجاح")
                  .on("click", function () {
                    $(this).removeClass("show-success");
                  });
                setTimeout(function () {
                  $(".success-message").removeClass("show-success");
                  location.reload();
                }, 2000);
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
  let formData = new FormData();
  formData.append("property_id", submitButton.attr("data-propertyID"));
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
    // check if the user is login or not and display the delete burron
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
      deleteComment(commentID, uID);
    });
    return comment;
  }
  // Function to get timestamp of comment in string format from UNIX time stamp
  function getTimestampString(timestamp) {
    var currentTime = new Date();
    var previousTime = new Date(timestamp);
    var timeDifference = currentTime - previousTime;
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
      return "Just now";
    }
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
  function deleteComment(commentID, uID) {
    $.ajax({
      method: "POST",
      url: "delete_comment.php",
      data: {
        commentID: commentID,
        uID: uID,
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

  // Create the main container div
  const reportModelDiv = $("<div>").addClass("report-model");

  // Create the title paragraph
  const titleParagraph = $("<p>")
    .addClass("title")
    .text("الإبلاغ عن هذا العقار");
  reportModelDiv.append(titleParagraph);

  // Create the form container div
  const formDiv = $("<div>").addClass("form");
  reportModelDiv.append(formDiv);

  // Create the form element
  const formElement = $("<form>").attr("action", "");
  formDiv.append(formElement);

  // Create the select dropdown item div
  const selectDropdownItemDiv = $("<div>").addClass("select-dropdown__item");
  formElement.append(selectDropdownItemDiv);

  // Create the reason select element
  const reasonSelect = $("<select>")
    .attr("name", "reason")
    .addClass("select-resson");
  selectDropdownItemDiv.append(reasonSelect);

  // Create the default option for the reason select
  const defaultOption = $("<option>").val("").text("إختر السبب");
  reasonSelect.append(defaultOption);

  // Create the other options for the reason select
  const reasons = [
    "العقار غير متوافر",
    "السعر غير دقيق",
    "لم أتسلم رد من الوسيط العقاري",
    "لا توجد تفاصيل للعقار",
    "نوعية الصور رديئة",
    "نص الوصف ضعيف جداً",
    "الموقع غير صحيح",
    "العقار المدرج غير موجود فعلياً",
    "خطأ في نوع العقار المدرج",
  ];

  reasons.forEach((reason, index) => {
    const option = $("<option>")
      .val(index + 1)
      .text(reason);
    reasonSelect.append(option);
  });

  // Create the input message div
  const inputMessageDiv = $("<div>")
    .addClass("input__message")
    .text("يرجى تحديد السبب");
  selectDropdownItemDiv.append(inputMessageDiv);

  // Create the textarea for the message
  const messageTextarea = $("<textarea>")
    .attr("name", "message")
    .addClass("main-input")
    .attr("placeholder", "تعليق إضافي");
  formElement.append(messageTextarea);

  // Create the submit button
  const subButton = $("<button>").addClass("submit-report").text("إرسال");
  formElement.append(subButton);

  // Create the image container div
  const imgDiv = $("<div>").addClass("img");
  reportModelDiv.append(imgDiv);

  // Create the image element
  const imageElement = $("<img>")
    .attr("src", "images/report-property.png")
    .attr("alt", "");
  imgDiv.append(imageElement);

  // Create the description paragraph
  const descriptionParagraph = $("<p>").text(
    "هل هناك مشكلة في هذا العقار؟ يرجى تزويدنا بمزيد من المعلومات حتى نتمكن من حل المشكلة"
  );
  imgDiv.append(descriptionParagraph);

  // Append the model box to the desired container in your HTML
  $(".report-property").append(reportModelDiv);

  // Get the property paragraph element
  const propertyRepor = $("#property");

  // Get the report model element
  const reportModel = $(".report");

  // Add a click event listener to the property paragraph
  propertyRepor.on("click", (event) => {
    // event.stopPropagation(); // Stop the click event from propagating to the document
    // Show the report model
    reportModel.fadeToggle();
    reportModel.css("display", "flex");
  });
  let close_model = $(".close-report-model");
  close_model.on("click", () => {
    reportModel.fadeOut();
    reportModel.css("display", "none");
  });
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
    zoom: 18,
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
