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
  // close alert modal
  $(".alert_close, .modal-overlay , .close").click(function () {
    $(".alert_modal").css("display", "none");
    $(".modal-overlay").css("display", "none");
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
  // add proparty to favorate
  $(".favorite-box").on("click", function () {
    // send request to DB to check if the user is login or not
    let element = $(this);
    $.ajax({
      method: "POST",
      url: "../checklogin.php",
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
              url: "../add_favorite.php",
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
              url: "../add_favorite.php",
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
                console.error(xhr, status, error);
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
  // display the number of favorite items
  let user_id = $(".favorite_page a").attr("data-uid");
  $.ajax({
    url: "../user/get_saved_num.php",
    method: "POST",
    data: { user_id: user_id },
    success: function (data) {
      if (data == 0) {
        $(".favorite_page a").attr("data-saved", "");
      } else {
        $(".favorite_page a").attr("data-saved", data);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
      console.log(errorThrown);
    },
  });
});
const newSearchInputs = document.querySelector(".search_inputs");
const value = document.querySelector("#searchInput").value;
const newInputs = `
    <div class="input_control_search">
        <input type="text" name="q" required oninput="showSuggestions()"  autocomplete="false" value="${value}" id="searchInput" placeholder="الحي او المنطقة">
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
    const value = document.querySelector("#searchInput").value;
    newSearchInputs.innerHTML = `
    <div class="input_control_search">
        <input type="text" name="q" oninput="showSuggestions()" id="searchInput" value="${value}" placeholder="الحي او المنطقة">
        <p class="no-suggestion-message" id="noSuggestionMessage"></p>
        <ul class="suggestion-list" id="suggestionList"></ul>
        <i class='bx bx-search'></i>
    </div>
    <div class="select_type">
    <select name="t" id="propertyTypeSelect">
      <option value="all">نوع العقار</option>
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
//NOTE -  get suggestions list from database and apend data in suggestion list
const suggestions = [];
const suggestions_price_buy = [];
const suggestions_price_rent = [];
const suggestions_min_area = [];
$(document).ready(function () {
  // send ajax request to server
  $.ajax({
    url: "../owner/get_neighborhoods.php",
    method: "GET",
    success: function (response) {
      let neighborhoods = JSON.parse(response);
      for (let index = 0; index < neighborhoods.length; index++) {
        const element = neighborhoods[index];
        suggestions.push(element.neighborhood_name);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
    },
  });
  //SECTION - suggestions list for categories  select input
  //NOTE -  get categories list from database and apend data in suggestion list
  $.ajax({
    url: "../owner/get_categories.php",
    method: "GET",
    success: function (response) {
      let categories = JSON.parse(response);
      for (let index = 0, i = 1; index < categories.length; index++, i++) {
        const element = categories[index];
        element.category_name;
        let option = $("<option value=" + i + "></option>").text(
          element.category_name
        );
        option.appendTo($("#propertyTypeSelect"));
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
    },
  });
  // get  price from database when user clicks on buy radio btn
  $.ajax({
    url: "../owner/includes/functions/get_price_buy.php",
    method: "GET",
    success: function (response) {
      let BuyPrice = JSON.parse(response);
      for (let index = 0; index < BuyPrice.length; index++) {
        const element = BuyPrice[index];
        suggestions_price_buy.push(element.price);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
    },
  });
  // get  price from database when user clicks on rent radio btn
  $.ajax({
    url: "../owner/includes/functions/get_price_rent.php",
    method: "GET",
    success: function (response) {
      let RentPrice = JSON.parse(response);
      for (let index = 0; index < RentPrice.length; index++) {
        const element = RentPrice[index];
        suggestions_price_rent.push(element.price);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
    },
  });
  // get  area from database
  $.ajax({
    url: "../owner/includes/functions/get_area.php",
    method: "GET",
    success: function (response) {
      let area = JSON.parse(response);
      for (let index = 0; index < area.length; index++) {
        const element = area[index];
        suggestions_min_area.push(element.area);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus);
    },
  });
  var sort_by = $(".sort_by_btn");
  var sort_list = $(".sort_list");
  var sort_links = $(".sort_list a");
  var sort_by_overlay = $(".sort-by-overlay");

  if (sort_by.length) {
    sort_by.on("click", function () {
      sort_list.toggleClass("show_list");
      sort_by_overlay.toggleClass("show");
    });
  }

  sort_by_overlay.on("click", function () {
    if (sort_list.length && sort_list.hasClass("show_list")) {
      sort_list.removeClass("show_list");
      sort_by_overlay.removeClass("show");
    }
  });

  setTimeout(function () {
    if (sort_list.length && sort_list.hasClass("show_list")) {
      sort_list.removeClass("show_list");
    }
  }, 5000);
});
console.log(123);
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
    suggestion.toLowerCase().includes(userInput)
  );

  matchingSuggestions.forEach((suggestion) => {
    const li = document.createElement("li");
    li.textContent = suggestion;
    li.addEventListener("click", function () {
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

//SECTION - suggestions list for price

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
