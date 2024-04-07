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
  // Call the checkNotifications function initially
  checkNotifications();
  // Set interval to call checkNotifications every 1 minute (3000 milliseconds)
  setInterval(checkNotifications, 3000);
});
