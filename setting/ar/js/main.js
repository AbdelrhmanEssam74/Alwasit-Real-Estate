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

    // update the user in the DB
    $('.personal_info_save_btn').on('click', function () {
        let user_id = $('.personal_info_save_btn').attr('data-UID');
        let oldImg = $('.oldimg').attr('value').split('/').pop();
        // Check if a new image has been selected
        let newImg = $('#newProfileImage').prop('files')[0]?.name || null;
        let username = $('#username').attr('value');
        let first_name = $('#first_name').attr('value');
        let last_name = $('#last_name').attr('value');
        let formData = new FormData();
        if (newImg) {
            formData.append('id', user_id);
            formData.append('oldImg', oldImg);
            formData.append('newImg', newImg);
            formData.append('username', username);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
        }
        else {
            formData.append('id', user_id);
            formData.append('oldImg', oldImg);
            formData.append('username', username);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
        }
        $.ajax({
            method: "POST",
            url: 'update.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    });
})

