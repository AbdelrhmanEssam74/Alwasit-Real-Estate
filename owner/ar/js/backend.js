//  function to extract the latitude and longitude from the URL
function extractLatLngFromUrl(url) {
  var pattern = /@(-?\d+\.\d+),(-?\d+\.\d+)/;
  var match = url.match(pattern);

  if (match) {
    var latitude = parseFloat(match[1]);
    var longitude = parseFloat(match[2]);
    return { latitude, longitude };
  } else {
    return null;
  }
}

$(document).ready(function () {
  "use strict";
  //NOTE - Hide Placeholder On Form focus
  $("[placeholder]")
    .focus(function () {
      $($(this).attr("data-text", $(this).attr("placeholder")));
      $(this).attr("placeholder", " ");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });

  const $fileInput = $(".file-input");
  const $droparea = $(".file-drop-area");
  const $delete = $(".item-delete");

  $fileInput.on("dragenter focus click", function () {
    $droparea.addClass("is-active");
  });

  $fileInput.on("dragleave blur drop", function () {
    $droparea.removeClass("is-active");
  });

  $fileInput.on("change", function () {
    let filesCount = $(this)[0].files.length;
    let $textContainer = $(this).prev();

    if (filesCount === 1) {
      let fileName = $(this).val().split("\\").pop();
      $textContainer.text(fileName);
      $(".item-delete").css("display", "inline-block");
    } else if (filesCount === 0) {
      $textContainer.text("or drop files here");
      $(".item-delete").css("display", "none");
    } else {
      $textContainer.text(filesCount + " files selected");
      $(".item-delete").css("display", "inline-block");
    }
  });

  $delete.on("click", function () {
    $(".file-input").val(null);
    $(".file-msg").text("or drop files here");
    $(".item-delete").css("display", "none");
  });

  // Add Asterisk On Required Field
  $("input , select , textarea").each(function () {
    if ($(this).attr("required") === "required") {
      $(this).after('<span class="asterisk">*</span>');
    }
  });

  // Get the values from the input fields
  var inputFields = [
    $("#propertyTitle"),
    $("#propertyDescription"),
    $(".type-conditions .Type_input select").eq(0),
    $(".type-conditions .Type_input select").eq(1),
    $("#formGroupExamplePrice"),
    $("#formGroupExampleArea"),
    $(".price-area-rooms .Rooms select"),
    $(".price-area-rooms .baths select"),
    $("#propertyAddress"),
    $("#neighborhood"),
    $("#City"),
    $("#locationURL"),
    $("#build-year"),
  ];
  // Get the selected images count

  // Validate the inputs and disable the button initially
  let input_valid = false;
  let img_valid = false;
  // Attach input event listener to each input field
  inputFields.forEach(function (field) {
    field.on("input", () => {
      var allFieldsFilled = inputFields.every(function (field) {
        return field.val().trim() !== "";
      });
      if (allFieldsFilled) {
        $(".publish-btn")
          .prop("disabled", false)
          .removeClass("disabled")
          .addClass("enabled");
        input_valid = true;
      } else {
        $(".publish-btn")
          .prop("disabled", true)
          .removeClass("enabled")
          .addClass("disabled");
      }
    });
    // Attach input event listener to img input field
  });
  $("#imgs").on("input", () => {
    if (
      $("#imgs")[0].files.length == 0 ||
      $("#imgs")[0].files.length < 5 ||
      $("#imgs")[0].files.length > 5
    ) {
      $(".publish-btn")
        .prop("disabled", true)
        .removeClass("enabled")
        .addClass("disabled");
      $("#imgs").after('<span class="invalid-img">أرفق 5 صور فقط</span>');
    } else if ($("#imgs")[0].files.length == 5) {
      $(".publish-btn")
        .prop("disabled", false)
        .removeClass("disabled")
        .addClass("enabled");
      $(".invalid-img").css("display", "none");
      img_valid = true;
    }
  });
  if (input_valid && img_valid) {
    $(".publish-btn")
      .prop("disabled", false)
      .removeClass("disabled")
      .addClass("enabled");
  } else {
    $(".publish-btn").prop("disabled", true).addClass("disabled");
  }

  if ($(".success-message")) {
    $(".success-message").addClass("show-success");
    $(".success-message").on("click", function () {
      $(".success-message").removeClass("show-success");
      location.reload();
    });
  }

  $(".notifications .icon_wrap").click(function () {
    $(this).parent().toggleClass("active");
    $(".notifications #overloay").css("display", "block");
  });
  $(".notifications #overloay").click(function () {
    $(".notifications").removeClass("active");
    $(".notifications #overloay").css("display", "none");
  });

  $(".notifications .icon_wrap").click(function () {
    let notifications_num = $(".icon_wrap").attr("data-notify");
    let owner_id = $(".icon_wrap").attr("data-owerID");
    if (notifications_num > 0) {
      // send ajax request to update read status of notification
      $.ajax({
        url: "update_notification_status.php",
        method: "POST",
        data: { owner_id: owner_id },
        success: function (response) {
          $(".icon_wrap").attr("data-notify", "");
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
  // Function to check for new notifications
  function checkNotifications() {
    let owner_id = $(".icon_wrap").attr("data-owerID");
    $.ajax({
      url: "check_notifications.php",
      method: "POST",
      data: { owner_id: owner_id },
      success: function (response) {
        $(".icon_wrap").attr("data-notify", response);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
  $(".delete-btn").on("click", function () {
    let element = $(this);
    let owner_id = element.attr("data-owner");
    let property_id = element.attr("data-PropID");
    // show delete reson modal
    $(".modal-overlay").css("display", "flex");
    $(".close-overlay").on("click", function () {
      $(".modal-overlay").css("display", "none");
    });
    $("#delete-confirm-button").on("click", function () {
      let delete_reason = $("#delete-reason").val().length;
      if (delete_reason < 1) {
        $(".invalid").css("display", "block").text("من فضلك ادخل سبب الحذف");
      } else {
        $(".modal-overlay").css("display", "none");
        var delete_reason_val = $("#delete-reason").val();
        $.ajax({
          url: "delete.php",
          method: "POST",
          data: {
            owner_id: owner_id,
            property_id: property_id,
            delete_reason_val: delete_reason_val,
          },
          success: function (response) {
            $("#row_" + property_id).remove();
            $(".success-message2")
              .addClass("show-success")
              .text("تم حذف العقار بنجاح")
              .on("click", function () {
                $(".success-message2").removeClass("show-success");
              });
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
    });
  });
  // Call the checkNotifications function initially
  checkNotifications();
  // Set interval to call checkNotifications every 1 minute (3000 milliseconds)
  setInterval(checkNotifications, 3000);
  // get all neighborhoods when user try to enter a neighborhood input
  $("#neighborhood").on("click", function () {
    let parent = $(this).parent();
    let list = $("<div>").addClass("neighborhood_list").appendTo(parent);
    let overlay = $("<div>").addClass("overlay").appendTo(parent);
    overlay.on("click", function () {
      list.hide();
      overlay.remove();
    });
    let ul = $("<ul>").appendTo(list);
    // send ajax request to get neighborhoods
    $.ajax({
      url: "get_neighborhoods.php",
      method: "GET",
      success: function (response) {
        let neighborhoods = JSON.parse(response);
        for (let index = 0; index < neighborhoods.length; index++) {
          const element = neighborhoods[index];
          let li = $("<li>")
            .addClass("neighborhood_item")
            .text(element.neighborhood_name)
            .appendTo(ul);
          li.on("click", function () {
            let input = $("#neighborhood");
            input.val($(this).text());
            list.hide();
            overlay.remove();
          });
        }
      },
    });
  });
  // get all categories when user try to enter a neighborhood input
  $("#propertyType").one("click", function () {
    let parent = $(this).parent();
    let list = $("<div>").addClass("neighborhood_list").appendTo(parent);
    let overlay = $("<div>").addClass("overlay").appendTo(parent);
    overlay.on("click", function () {
      list.hide();
      overlay.remove();
    });
    let ul = $("<ul>").appendTo(list);
    // send ajax request to get neighborhoods
    $.ajax({
      url: "get_categories.php",
      method: "GET",
      success: function (response) {
        let neighborhoods = JSON.parse(response);
        for (let index = 0; index < neighborhoods.length; index++) {
          const element = neighborhoods[index];
          let li = $("<li>")
            .addClass("neighborhood_item")
            .text(element.category_name)
            .appendTo(ul);
          li.on("click", function () {
            let input = $("#propertyType");
            input.val($(this).text());
            list.hide();
            overlay.remove();
          });
        }
      },
    });
  });
  // accept client offer
  $(".acceptOffer").on("click", function () {
    let submit = "accept";
    let user_id = $(this).attr("data-userID");
    let property_id = $(this).attr("data-PropID");
    // Display the loading icon
    $("#loadingIcon").show();
    $.ajax({
      url: "manage_offer.php",
      method: "POST",
      data: { submit: submit, user_id: user_id, property_id: property_id },
      success: function (response) {
        // Remove the loading icon
        $("#loadingIcon").hide();
        // Remove the corresponding row
        $("#row_" + user_id).remove();
        setTimeout(() => {
          location.reload();
        }, 1);
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  // refuse client offer
  $(".refuseOffer").on("click", function () {
    let submit = "refuse";
    let user_id = $(this).attr("data-userID");
    let property_id = $(this).attr("data-PropID");
    // Display the loading icon
    $("#loadingIcon").show();
    $.ajax({
      url: "manage_offer.php",
      method: "POST",
      data: { submit: submit, user_id: user_id, property_id: property_id },
      success: function (response) {
        // Remove the loading icon
        $("#loadingIcon").hide();
        // Remove the corresponding row
        $("#row_" + user_id).remove();
        setTimeout(() => {
          location.reload();
        }, 1);
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  setInterval(() => {
    $.ajax({
      url: "get_comments_nums.php",
      method: "POST",
      data: {},
      success: function (data) {
        $(".comments_nums").text(data);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }, 500);
});
