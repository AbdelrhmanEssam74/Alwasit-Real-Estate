$(document).ready(function () {
    'use strict';

    $('.toggle_menu').click(function () {
        $("#menu").toggleClass("show_menu");
        $(this).toggleClass("active");
    })
    if ($("#menu").hasClass("show_menu")) {
        $('body').on('click', function () {
            $('#menu').css('display', 'none')
        });
    }
    if (!$("#menu").hasClass("show_menu")) {
        $('.toggle_menu').remove("active");

    }
    let header = $('header .container');
    let login_box = $('.login_box');
    $(window).resize(function () {
        if ($(window).width() >= 767) {
            login_box.remove(); // Remove .login_box
        } else {
            header.append(login_box); // Append .login_box
        }
    });
});


// Get Slider items
let images = Array.from(document.querySelectorAll('.image-gallery .container img'));
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
    popupImg.src = images[currentSlide].getAttribute('src');
}

images.forEach(function (image, index) {
    image.addEventListener("click", () => {
        currentSlide = index;
        ShowSlide();
        document.querySelector(".popup-img").style.display = "block";
    });
});

document.querySelector('.popup-img .close').onclick = () => {
    document.querySelector(".popup-img").style.display = "none";
}



// Keyboard navigation
document.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowRight') {
        NextSlide();
    } else if (event.key === 'ArrowLeft') {
        PrevSlide();
    } else if (event.key === 'Escape') {
        document.querySelector(".popup-img").style.display = "none";
    }
});


// fixed navbar
window.addEventListener("scroll", function () {
    let header = document.querySelector("header")
    header.classList.toggle("sticky", window.scrollY);
});

// send whatsApp message
function send_handle() {
    const whatsAppBtn = document.querySelector(".button-whatsapp")
    const num = whatsAppBtn.dataset.phone;
    const link = whatsAppBtn.getAttribute('data-propertyLink');
    const message_model = `
    مرحباً
    أود الحصول على المزيد من المعلومات 
    حول هذا العقار المنشور على موقع 
    alwasite.eg
    نوع العقار: فيلا
    السعر: 3,721,600 جنيه
    الموقع: المدينة
    الرابط: ${link}
    `
    const win = window.open(`https://wa.me/${num}?text=${message_model}`, '_blank');
}
const phone_btn = document.querySelector(".phone-link")
const num = phone_btn.dataset.phone;
phone_btn.addEventListener("click", () => {
    phone_btn.textContent = num;
});


// Create the main container div
const reportModelDiv = document.createElement('div');
reportModelDiv.classList.add('report-model');

// Create the title paragraph
const titleParagraph = document.createElement('p');
titleParagraph.classList.add('title');
titleParagraph.textContent = 'الإبلاغ عن هذا العقار';
reportModelDiv.appendChild(titleParagraph);

// Create the form container div
const formDiv = document.createElement('div');
formDiv.classList.add('form');
reportModelDiv.appendChild(formDiv);

// Create the form element
const formElement = document.createElement('form');
formElement.action = '';
formDiv.appendChild(formElement);

// Create the select dropdown item div
const selectDropdownItemDiv = document.createElement('div');
selectDropdownItemDiv.classList.add('select-dropdown__item');
formElement.appendChild(selectDropdownItemDiv);

// Create the reason select element
const reasonSelect = document.createElement('select');
reasonSelect.name = 'reason';
reasonSelect.classList.add('select-resson');
selectDropdownItemDiv.appendChild(reasonSelect);

// Create the default option for the reason select
const defaultOption = document.createElement('option');
defaultOption.value = '';
defaultOption.textContent = 'إختر السبب';
reasonSelect.appendChild(defaultOption);

// Create the other options for the reason select
const reasons = [
    'العقار غير متوافر',
    'السعر غير دقيق',
    'لم أتسلم رد من الوسيط العقاري',
    'لا توجد تفاصيل للعقار',
    'نوعية الصور رديئة',
    'نص الوصف ضعيف جداً',
    'الموقع غير صحيح',
    'العقار المدرج غير موجود فعلياً',
    'خطأ في نوع العقار المدرج'
];

reasons.forEach((reason, index) => {
    const option = document.createElement('option');
    option.value = index + 1;
    option.textContent = reason;
    reasonSelect.appendChild(option);
});


// Create the input message div
const inputMessageDiv = document.createElement('div');
inputMessageDiv.classList.add('input__message');
inputMessageDiv.textContent = 'يرجى تحديد السبب';
selectDropdownItemDiv.appendChild(inputMessageDiv);

// Create the textarea for the message
const messageTextarea = document.createElement('textarea');
messageTextarea.name = 'message';
messageTextarea.classList.add('main-input');
messageTextarea.placeholder = 'تعليق إضافي';
formElement.appendChild(messageTextarea);

// Create the submit button
const submitButton = document.createElement('button');
submitButton.classList.add('submit-report')
submitButton.textContent = 'إرسال';
formElement.appendChild(submitButton);

// Create the image container div
const imgDiv = document.createElement('div');
imgDiv.classList.add('img');
reportModelDiv.appendChild(imgDiv);

// Create the image element
const imageElement = document.createElement('img');
imageElement.src = 'images/report-property.png';
imageElement.alt = '';
imgDiv.appendChild(imageElement);

// Create the description paragraph
const descriptionParagraph = document.createElement('p');
descriptionParagraph.textContent = 'هل هناك مشكلة في هذا العقار؟ يرجى تزويدنا بمزيد من المعلومات حتى نتمكن من حل المشكلة';
imgDiv.appendChild(descriptionParagraph);

// Append the model box to the desired container in your HTML
const container = document.querySelector('.report-property');
container.appendChild(reportModelDiv);





// Get the property paragraph element
const propertyRepor = document.getElementById('property');

// Get the report model element
const reportModel = document.querySelector('.report');

// Add a click event listener to the property paragraph
propertyRepor.addEventListener('click', (event) => {
    event.stopPropagation(); // Stop the click event from propagating to the document
    // Show the report model
    reportModel.style.display = 'flex';
});

let close_model = document.querySelector(".close-report-model")
close_model.addEventListener("click", () => {
    if (reportModel.style.display === 'flex') {
        reportModel.style.display = 'none'
    }
})

// validate report from
let validate = false;

formElement.addEventListener("submit", (e) => {
    if (reasonSelect.value != "") {
        validate = true
    } else {
        inputMessageDiv.classList.add("input__message--invalid")
    }
    if (!validate) {
        e.preventDefault();
    }
})


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
        center: { lat: 29.07136598167721, lng: 31.095339506442322 }
    }
    // new map
    var map = new google.maps.Map(document.getElementById("map"), options);

    // add marker
    var marker = new google.maps.Marker({
        position: { lat: lat_value, lng: lang_value },
        map: map
    });

    // function to add marker dynamice
    function addMarker(pos) {
        var marker = new google.maps.Marker({
            position: pos.coords,
            map: map
        });
        var infoWindow = new google.maps.InfoWindow({
            content: pos.content
        })
        marker.addListener("click", function () {
            infoWindow.open(map, marker)
        })
    }
    addMarker({
        coords: { lat: 29.07136598167721, lng: 31.095339506442322 },
    })
}

