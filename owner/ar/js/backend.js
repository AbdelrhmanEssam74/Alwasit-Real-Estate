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
  var propertyTitle = $("#propertyTitle");
  var propertyDescription = $("#propertyDescription");
  var propertyType = $(".type-conditions .Type_input select").eq(0);
  var propertyStatus = $(".type-conditions .Type_input select").eq(1);
  var propertyPrice = $("#formGroupExamplePrice");
  var propertyArea = $("#formGroupExampleArea");
  var propertyRooms = $(".price-area-rooms .Rooms select");
  var propertyBaths = $(".price-area-rooms .baths select");
  var propertyAddress = $("#propertyAddress");
  var propertyNeighborhood = $("#neighborhood");
  var propertyCity = $("#City");
  var locationURL = $("#locationURL");
  var buildingYear = $("#longitude");
  // Get the selected images count
  $("#imgs")[0].files.length;

  //NOTE - Validate the inputs
  // Check if any input field is empty
  var isAnyFieldEmpty = propertyTitle.val() === "";
  // propertyDescription.val() === "" ||
  // propertyType.val() === "" ||
  // propertyStatus.val() === "" ||
  // propertyPrice.val() === "" ||
  // propertyArea.val() === "" ||
  // propertyRooms.val() === "" ||
  // propertyBaths.val() === "" ||
  // propertyAddress.val() === "" ||
  // propertyNeighborhood.val() === "" ||
  // propertyCity.val() === "" ||
  // locationURL.val() === "" ||
  // buildingYear.val() === "";

  // Extract latitude and longitude from the URL
  var coordinates = extractLatLngFromUrl(locationURL.val());
  var latitude = coordinates ? coordinates.latitude : null;
  var longitude = coordinates ? coordinates.longitude : null;
  // Disable the button if any field is empty
  console.log(isAnyFieldEmpty);
  if (isAnyFieldEmpty) {
    $(".publish-btn").prop("disabled", true).addClass("disabled");
  } else {
    $(".publish-btn")
      .prop("disabled", false)
      .removeClass("disabled")
      .addClass("enabled");
  }
  $(".publish-btn").on("click", function () {
    //  AJAX request
    $.ajax({
      url: "backend.php",
      method: "POST",
      data: {
        propertyTitle: propertyTitle.val(),
        propertyDescription: propertyDescription.val(),
        propertyType: propertyType.val(),
        propertyStatus: propertyStatus.val(),
        propertyPrice: propertyPrice.val(),
        propertyArea: propertyArea.val(),
        propertyRooms: propertyRooms.val(),
        propertyBaths: propertyBaths.val(),
        propertyAddress: propertyAddress.val(),
        propertyNeighborhood: propertyNeighborhood.val(),
        propertyCity: propertyCity.val(),
        latitude: latitude,
        longitude: longitude,
        buildingYear: buildingYear.val(),
        // imgs: $("#imgs")[0].files,
      },
      success: function (response) {
        // Handle the server response
        console.log(response);
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.error(error);
      },
    });
  });
});
