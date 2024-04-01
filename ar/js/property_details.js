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

// Show current slide
function ShowSlide() {
  let popupImg = document.querySelector(".popup-img img");
  popupImg.src = images[currentSlide].getAttribute("src");
}

images.forEach(function (image, index) {
  image.addEventListener("click", () => {
    currentSlide = index;
    ShowSlide();
    document.querySelector(".popup-img").style.display = "block";
  });
});

document.querySelector(".popup-img .close").onclick = () => {
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
  const submitButton = $("<button>").addClass("submit-report").text("إرسال");
  formElement.append(submitButton);

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
  // toggle menu for user
  let droptn = $(".dropbtn img");
  let dropDown_list = $(".dropdown-content");
  droptn.click(function () {
    dropDown_list.toggleClass("show");
  });
});

// $.ajax({
//     url: 'test.php',
//     type: 'POST',
//     success: function (coordinates) {
//         var values = coordinates.split("|");
//         var lat_value = values[0]
//         var lang_value = values[1]
//         console.log(lat_value.type());
//         console.log(lang_value);
//     },
//     error: function () {
//         console.log('error');
//     }
// });

//SECTION - google map api
function initMap() {
  // map options
  var options = {
    zoom: 18,
    center: { lat: 29.07136598167721, lng: 31.095339506442322 },
  };
  // new map
  var map = new google.maps.Map(document.getElementById("map"), options);

  // add marker
  var marker = new google.maps.Marker({
    position: { lat: lat_value, lng: lang_value },
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
    coords: { lat: 29.07136598167721, lng: 31.095339506442322 },
  });
}
