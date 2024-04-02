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

  // add and remove login button in small screen
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
});
const newSearchInputs = document.querySelector(".search_inputs");
const newInputs = `
    <div class="input_control_search">
        <input type="text" name="q" required oninput="showSuggestions()" id="searchInput" placeholder="الحي او المنطقة">
        <p class="no-suggestion-message" id="noSuggestionMessage"></p>
        <ul class="suggestion-list" id="suggestionList"></ul>
        <i class='bx bx-search'></i>
    </div>
    <div class="submit_btn">
        <button type="submit" value=""><i class="fa fa-search"></i></button>
    </div>
`;

function updateMenuAndSearchInputs() {
  const websiteWidth =
    window.innerWidth || document.documentElement.clientWidth;

  if (websiteWidth <= 767) {
    newSearchInputs.innerHTML = newInputs;
  } else {
    newSearchInputs.innerHTML = `
    <div class="input_control_search">
        <input type="text" name="q" oninput="showSuggestions()" id="searchInput" placeholder="الحي او المنطقة">
        <p class="no-suggestion-message" id="noSuggestionMessage"></p>
        <ul class="suggestion-list" id="suggestionList"></ul>
        <i class='bx bx-search'></i>
    </div>
    <div class="select_type">
        <select name="t" id="propertyTypeSelect">
            <option value="all">نوع العقار</option>
            <option value="1">شقة</option>
            <option value="2">فيلا</option>
        </select>
    </div>
    <div class="select_price">
        <p class="price_text">السعر</p>
        <div class="price_input">
            <div class="input_field">
                <div class="input_field_min">
                    <input type="number" name="pmi" placeholder="الحد الادني للسعر" id="minPriceInput">
                    <ul class="suggestion_min_price">
                </ul>
                </div>
                <span>-</span>
                <div class="input_field_max">
                    <input type="number" name="pmx" placeholder="الحد الاقصي للسعر" id="maxPriceInput">
                    <ul class="suggestion_max_price">
                    </ul>
                </div>
            </div>
            <div class="rest_price_input">إعادة ضبط</div>
        </div>
    </div>
    <div class="select_area">
    <p class="area_text">المساحه <span>(متر مربع)</span></p>
    <div class="area_input">
        <div class="input_field">
            <div class="input_field_min">
                <input type="number" name="ami" placeholder="اقل مساحه" id="minAreaInput">
                <ul class="suggestion_min_area">
                </ul>
            </div>
            <span>-</span>
            <div class="input_field_max">
                <input type="number" name="amx" placeholder="اكبر مساحه" id="maxAreaInput">
                <ul class="suggestion_max_area">
                </ul>
            </div>
        </div>
        <div class="rest_area_input">إعادة ضبط</div>
    </div>
</div>
    <div class="submit_btn">
        <button type="submit" value=""><i class="fa fa-search"></i></button>
    </div>
    `;
  }
}

// Check the width of the website on window resize
window.addEventListener("resize", updateMenuAndSearchInputs);
updateMenuAndSearchInputs();
//SECTION - suggestions list for search input
const suggestions = [
  "الرمد",
  "الحميات",
  "الكورنيش",
  "المدينة",
  "الحي الاول",
  "الواسطي",
];

function showSuggestions() {
  const userInput = document.getElementById("searchInput").value.toLowerCase();
  const suggestionList = document.getElementById("suggestionList");
  const noSuggestionMessage = document.getElementById("noSuggestionMessage");
  suggestionList.innerHTML = "";
  noSuggestionMessage.textContent = "";

  if (userInput.length === 0) {
    return;
  }

  const matchingSuggestions = suggestions.filter((suggestion) =>
    suggestion.toLowerCase().startsWith(userInput)
  );

  matchingSuggestions.forEach((suggestion) => {
    const li = document.createElement("li");
    li.textContent = suggestion;
    li.addEventListener("click", () => {
      document.getElementById("searchInput").value = suggestion;
      suggestionList.innerHTML = "";
    });
    suggestionList.appendChild(li);
  });

  if (matchingSuggestions.length === 0) {
    noSuggestionMessage.textContent =
      "لا يمكننا العثور على استعلام البحث الخاص بك. جرب موقعًا مختلفًا.";
  }
}
document
  .querySelector("body")
  .addEventListener("click", function hideSuggestions() {
    const suggestionList = document.getElementById("suggestionList");
    suggestionList.innerHTML = "";
  });

//SECTION - suggestions list for price
const suggestions_price_buy = [1000, 2000, 3000, 4000, 5000, 6000];

const suggestions_price_rent = [500, 1000, 1500, 2000, 2500, 3500];

let radio_buy = document.querySelector("#buy");
let radio_rent = document.querySelector("#rent");

let minPriceInput = document.querySelector("#minPriceInput");
let maxPriceInput = document.querySelector("#maxPriceInput");
let price_text = document.querySelector(".price_text");
if (minPriceInput) {
  minPriceInput.addEventListener("click", function () {
    const suggestion_min_price_list = document.querySelector(
      ".suggestion_min_price"
    );
    suggestion_min_price_list.innerHTML = ""; // Clear previous suggestions

    let suggestion = [];
    if (radio_buy.checked) {
      suggestion = suggestions_price_buy;
    } else {
      suggestion = suggestions_price_rent;
    }

    suggestion.forEach((e) => {
      const li = document.createElement("li");
      li.textContent = e;
      li.addEventListener("click", function () {
        minPriceInput.value = e;
        suggestion_min_price_list.innerHTML = "";
        updatePriceText();
      });
      suggestion_min_price_list.appendChild(li);
    });
  });

  maxPriceInput.addEventListener("click", function () {
    const suggestion_max_price_list = document.querySelector(
      ".suggestion_max_price"
    );
    suggestion_max_price_list.innerHTML = ""; // Clear previous suggestions

    let suggestion = [];
    if (radio_buy.checked) {
      suggestion = suggestions_price_buy;
    } else {
      suggestion = suggestions_price_rent;
    }

    const minValue = minPriceInput.value;
    let upadated_list = [];
    if (minValue) {
      suggestion.forEach((e) => {
        if (e > minValue) {
          upadated_list.push(e);
        }
      });
    }
    upadated_list.forEach((e) => {
      const li = document.createElement("li");
      li.textContent = e;
      li.addEventListener("click", function () {
        maxPriceInput.value = e;
        suggestion_max_price_list.innerHTML = "";
        updatePriceText();
      });
      suggestion_max_price_list.appendChild(li);
    });
  });

  function updatePriceText() {
    price_text.textContent =
      "من " + minPriceInput.value + " إلى " + maxPriceInput.value;
  }

  let rest_price_input = document.querySelector(".rest_price_input");
  rest_price_input.addEventListener("click", function () {
    minPriceInput.value = "";
    maxPriceInput.value = "";
    price_text.textContent = "السعر";
  });

  //SECTION - suggestions list for area

  const suggestions_min_area = [50, 60, 70, 80, 100];

  const suggestions_max_area = [50, 60, 70, 80, 100];

  let minAreaInput = document.querySelector("#minAreaInput");
  let maxAreaInput = document.querySelector("#maxAreaInput");
  let area_text = document.querySelector(".area_text");

  minAreaInput.addEventListener("click", function () {
    const suggestion_min_area_list = document.querySelector(
      ".suggestion_min_area"
    );
    suggestion_min_area_list.innerHTML = ""; // Clear previous suggestions

    suggestions_min_area.forEach((e) => {
      const li = document.createElement("li");
      li.textContent = "m " + e;
      li.addEventListener("click", function () {
        minAreaInput.value = e;
        suggestion_min_area_list.innerHTML = "";
        updateAreaText();
      });
      suggestion_min_area_list.appendChild(li);
    });
  });

  maxAreaInput.addEventListener("click", function () {
    const suggestion_max_area_list = document.querySelector(
      ".suggestion_max_area"
    );
    suggestion_max_area_list.innerHTML = ""; // Clear previous suggestions

    const minValue = minAreaInput.value;
    let upadated_list = [];
    if (minValue) {
      suggestions_min_area.forEach((e) => {
        if (e > minValue) {
          upadated_list.push(e);
        }
      });
    }
    upadated_list.forEach((e) => {
      const li = document.createElement("li");
      li.textContent = "m " + e;
      li.addEventListener("click", function () {
        maxAreaInput.value = e;
        suggestion_max_area_list.innerHTML = "";
        updateAreaText();
      });
      suggestion_max_area_list.appendChild(li);
    });
  });

  function updateAreaText() {
    area_text.textContent =
      "من " + minAreaInput.value + " إلى " + maxAreaInput.value;
  }

  let rest_area_input = document.querySelector(".rest_area_input");
  rest_area_input.addEventListener("click", function () {
    minAreaInput.value = "";
    maxAreaInput.value = "";
    area_text.innerHTML = "المساحه <span>(متر مربع)</span>";
  });

  //!SECTION display price inputs

  let AreaInputSelector = document.querySelector(".select_area p");
  let AreaInput_container = document.querySelector(".area_input");
  let priceInputSelector = document.querySelector(".select_price p");
  let priceInput_container = document.querySelector(".price_input");

  priceInputSelector.addEventListener("click", function () {
    if (priceInput_container.classList.contains("show_price_list")) {
      priceInput_container.classList.remove("show_price_list");
    } else {
      priceInput_container.classList.add("show_price_list");
    }
    if (AreaInput_container.classList.contains("show_area_list")) {
      AreaInput_container.classList.remove("show_area_list");
    }
  });

  //SECTION display price inputs

  AreaInputSelector.addEventListener("click", function () {
    if (AreaInput_container.classList.contains("show_area_list")) {
      AreaInput_container.classList.remove("show_area_list");
    } else {
      AreaInput_container.classList.add("show_area_list");
    }
    if (priceInput_container.classList.contains("show_price_list")) {
      priceInput_container.classList.remove("show_price_list");
    }
  });

  let submit_btn = document.querySelector(".submit_btn");
  submit_btn.addEventListener("click", function () {
    if (AreaInput_container.classList.contains("show_area_list")) {
      AreaInput_container.classList.remove("show_area_list");
    }
    if (priceInput_container.classList.contains("show_price_list")) {
      priceInput_container.classList.remove("show_price_list");
    }
  });
}

//SECTION -  Animate property body
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY);

  const propertyBodies = document.querySelectorAll(".property-body");
  const windowHeight = window.innerHeight;
  const windowWidth = window.innerWidth;

  if (windowWidth > 768) {
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

$(document).ready(function () {
  const btn = $(".up");
  //NOTE -  Button to go to the top of the page
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 400) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });
  btn.click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "smooth"
    );
  });

  const startBoxs = $(".stats .box .number");
  const statsSection = $(".stats");
  let started = false;

  function startCounter(el) {
    const goal = parseInt(el.data("goal"));
    let count = 0;
    const counter = setInterval(() => {
      count++;
      el.text(count);
      if (count === goal) {
        clearInterval(counter);
      }
    }, 2000 / goal);
  }

  if (statsSection.length) {
    $(window).scroll(function () {
      if (
        $(window).scrollTop() >= statsSection.offset().top - 350 &&
        !started
      ) {
        startBoxs.each(function () {
          startCounter($(this));
        });
        started = true;
      }
    });
  }
});
