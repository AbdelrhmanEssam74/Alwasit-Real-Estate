$(function () {
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
  // Add Asterisk On Required Field
  $("input").each(function () {
    if ($(this).attr("required") === "required") {
      $(this).after('<span class="asterisk">*</span>');
    }
  });

  // convert password field to text when clicked on eye icon
  let passwordInput = $(".password");
  let show_pass = $(".show-pass");
  show_pass.hover(
    function () {
      passwordInput.attr("type", "text");
    },
    function () {
      passwordInput.attr("type", "password");
    }
  );

  // confirmation message on button
  let confirmationButton = $(".confirm");
  confirmationButton.click(function () {
    return confirm("Are you sure?");
  });

  /*   delete the row from table and from database using ajax call
  $('.deleteBtn').on('click', function () {
      let element = $(this);
      let user_id = element.attr('data-UID');
      let success_message = $('.success-message');
      $.ajax({
          method: "POST",
          url: 'delete.php',
          data: { id: user_id },
          success: function (data) {
              if (data == 1) {
                  success_message.addClass('show-success').text("Row Deleted Successfully");
                  $('#row_' + user_id).remove();
                  setTimeout(function () {
                      success_message.removeClass('show-success');
                  }, 1500);
              } else {
                  success_message.addClass('show-failed').text("Row Deletion Failed");
                  setTimeout(function () {
                      success_message.removeClass('show-failed');
                  }, 1500);
              }
          },
          error: function (xhr, status, error) {
              console.error(xhr);
          }
      });
  });

  // Active the user in the system
  $('.activeBtn').on('click', function () {
      let element = $(this);
      let user_id = element.attr('data-UID');
      let success_message = $('.success-message');
      $.ajax({
          method: "POST",
          url: 'activeMember.php',
          data: { id: user_id },
          success: function (data) {
              console.log(data);
              if (data == 1) {
                  success_message.addClass('show-success').text("Member Active Successfully");
                  $('#row_' + user_id).remove();
                  setTimeout(function () {
                      success_message.removeClass('show-success');
                  }, 1500);
              } else {
                  success_message.addClass('show-failed').text("Member Active Failed");
                  setTimeout(function () {
                      success_message.removeClass('show-failed');
                  }, 1500);
              }
          },
          error: function (xhr, status, error) {
              console.error(xhr);
          }
      });
  }); */

  // accept user request to be an owner
  $(".acceptRequest").on("click", function () {
    let element = $(this);
    let user_id = element.attr("data-UID");
    let success_message = $(".success-message");
    $.ajax({
      method: "POST",
      url: "activeOwner.php",
      data: { id: user_id },
      success: function (data) {
        if (data == 1) {
          success_message
            .addClass("show-success")
            .text("Owner Active Successfully");
          $("#row_" + user_id).remove();
          setTimeout(function () {
            success_message.removeClass("show-success");
          }, 1500);
        } else {
          success_message.addClass("show-failed").text("Owner Active Failed");
          setTimeout(function () {
            success_message.removeClass("show-failed");
          }, 1500);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
  // refuse user request to be an owner
  $(".RefuseBtn").on("click", function () {
    let element = $(this);
    let user_id = element.attr("data-UID");
    let success_message = $(".success-message");
    $.ajax({
      method: "POST",
      url: "refuseOwner.php",
      data: { id: user_id },
      success: function (data) {
        if (data == 1) {
          success_message
            .addClass("show-success")
            .text("Owner Refused Successfully");
          $("#row_" + user_id).remove();
          setTimeout(function () {
            success_message.removeClass("show-success");
          }, 1500);
        } else {
          success_message.addClass("show-failed").text("Owner Refused Failed");
          setTimeout(function () {
            success_message.removeClass("show-failed");
          }, 1500);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      },
    });
  });
});
