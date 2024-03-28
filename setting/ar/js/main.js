// Get all navigation items

const navItems = document.querySelectorAll('.sidebar__list-item');

// Add a click event listener to each item
navItems.forEach(item => {
    item.addEventListener('click', function () {
        // Remove the "active" class from all items
        navItems.forEach(navItem => {
            navItem.classList.remove('is_active');
        });
        // Add the "active" class to the clicked item
        this.classList.add('is_active');
    });
});

$(function () {
    'use strict';
    //NOTE - Hide Placeholder On Form focus
    $('[placeholder]').focus(function () {
        $($(this).attr('data-text', $(this).attr('placeholder')));
        $(this).attr('placeholder', " ")
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'))
    })
    // Add Asterisk On Required Field
    $('input').each(function () {
        if ($(this).attr('required') === 'required') {
            $(this).after('<span class="asterisk">*</span>');
        }
    });
    // toggle menu for user
    let droptn = $('.dropbtn img');
    let dropDown_list = $('.dropdown-content');
    droptn.click(function () {
        dropDown_list.toggleClass('show');
    });
    // update the user personal info in the DB
    $('.personal_info_save_btn').on('click', function () {
        let user_id = $('.personal_info_save_btn').attr('data-UID');
        let oldImg = $('.oldimg').attr('value').split('/').pop();

        let newImg = $('#newProfileImage').prop('files')[0]?.name || null;

        let formData = new FormData();

        // Iterate through all input fields with the class 'dynamic-input'
        $('.dynamic-input').each(function () {
            let inputId = $(this).attr('id');
            let inputValue = $(this).val();
            formData.append(inputId, inputValue);
        });

        // Append common form data
        formData.append('submit', 'personal_info');
        formData.append('id', user_id);
        formData.append('oldImg', oldImg);

        if (newImg) {
            formData.append('newImg', newImg);
        }

        let success_message = $('.success-message');

        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data === '1') {
                    success_message.addClass('show-success').text("Saved Successfully");
                    setTimeout(function () {
                        success_message.removeClass('show-success');
                    }, 5000);
                } else {
                    success_message.addClass('show-failed').text("Save Failed");
                    setTimeout(function () {
                        success_message.removeClass('show-failed');
                    }, 5000);
                }

                $(".invalid-username-value, .invalid-fName-value, .invalid-lName-value").css("display", "none");

                if (data === 'nameEmpty') {
                    $(".invalid-username-value").css("display", "block");
                }
                if (data === 'fNameEmpty') {
                    $(".invalid-fName-value").css("display", "block");
                }
                if (data === 'lNameEmpty') {
                    $(".invalid-lName-value").css("display", "block");
                }

                success_message.click(function () {
                    $(this).removeClass('show-failed show-success');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });
    // update the user contact info in the DB
    $('.contact_info_save_btn').on('click', function () {
        let user_id = $('.contact_info_save_btn').attr('data-UID');
        let phoneInput = $('#phone_num');
        let phoneValue = phoneInput.val();
        let formData = new FormData();
        // Append common form data
        formData.append('phone', phoneValue);
        formData.append('submit', 'contact_info');
        formData.append('id', user_id);
        let success_message = $('.success-message');
        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data === '1') {
                    success_message.addClass('show-success').text("Saved Successfully");
                    setTimeout(function () {
                        success_message.removeClass('show-success');
                    }, 5000);
                } else {
                    success_message.addClass('show-failed').text("Save Failed");
                    setTimeout(function () {
                        success_message.removeClass('show-failed');
                    }, 5000);
                }
                $(".invalid-num-value").css("display", "none");


                if (data === 'Cant Be Empty') {
                    $(".invalid-num-value").css("display", "block").text(data);
                }
                if (data === 'Invalid Phone Number') {
                    $(".invalid-num-value").css("display", "block").text(data);
                }

                success_message.click(function () {
                    $(this).removeClass('show-failed show-success');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });
    // update the user password info in the DB
    let newpass = document.getElementById('newpassword');
    if (newpass) {
        if (newpass.value.length < 8) {
            $('.pass_info_save_btn').attr('disabled', 'disabled').addClass('disabled');
            newpass.addEventListener('input', function () {
                if (newpass.value.length < 8) {
                    $('.pass_info_save_btn').attr('disabled', 'disabled');
                } else {
                    $('.pass_info_save_btn').removeAttr('disabled').removeClass('disabled');
                }
            });
        }
    }
    $('.pass_info_save_btn').on('click', function () {
        let user_id = $(this).attr('data-UID');
        let oldPass = $('#oldpassword').val();
        let currentpass = $('#currentpass').val();
        let newpass = $('#newpassword').val();
        if (newpass.length < 8) {
            $(".invalid-newpass-value").css("display", "block").text("Password must be at least 8 characters");
        }
        let formData = new FormData();
        // Append common form data
        formData.append('submit', 'Password-info');
        formData.append('id', user_id);
        formData.append('oldpass', oldPass);
        formData.append('pass_old_input', currentpass);
        formData.append('newpass', newpass);
        let success_message = $('.success-message');
        $.ajax({
            method: 'POST',
            url: 'update.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data === 'Cant Be Empty') {
                    $(".invalid-pass-value").css("display", "block").text(data);
                }
                if (data === 'Wrong Password') {
                    $(".invalid-pass-value").css("display", "block").text(data);
                }
                if (data === 'New Password Cant be empty') {
                    $(".invalid-newpass-value").css("display", "block").text(data);
                }
                if (data === 'You Use This Password Before! Try Another One.') {
                    $(".invalid-newpass-value").css("display", "block").text(data);
                }
                $(".invalid-pass-value, .invalid-newpass-value").css("display", "none");
                if (data === '1') {
                    success_message.addClass('show-success').text("Saved Successfully");
                    setTimeout(function () {
                        success_message.removeClass('show-success');
                        window.location.reload();
                    }, 5000);
                } else {
                    success_message.addClass('show-failed').text("Save Failed");
                    setTimeout(function () {
                        success_message.removeClass('show-failed');
                    }, 5000);
                }
                success_message.click(function () {
                    $(this).removeClass('show-failed show-success');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });
})

