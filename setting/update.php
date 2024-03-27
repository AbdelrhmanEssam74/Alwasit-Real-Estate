<?php
include_once 'init.php';
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
$login_obj = new loginTable;
$user_obj = new RegisterTable;


// Validate input data
if (isset($_POST['submit']) && $_POST['submit'] == 'personal_info') {
    $newImg = isset($_POST['newImg']) ? $_POST['newImg'] : 0;
    $oldImg = $_POST['oldImg'];
    $username = (isset($_POST['username'])) ? $_POST['username'] : '';
    $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
    $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
    $profile_img = ($newImg == 0) ? $oldImg : $newImg;
    $user_id = $_POST['id'];
    $update_query = "UPDATE users SET username = :uname , F_name =:fName , L_name = :lName , profile_img = :img WHERE user_id = :id";
    $data = [
        "uname" => $username,
        "fName" => $first_name,
        "lName" => $last_name,
        "img" => $profile_img,
        "id" => $user_id,
    ];
    if (empty($username)) {
        echo 'nameEmpty';
    } else if (empty($first_name)) {
        echo "fNameEmpty";
    } else if (empty($last_name)) {
        echo "lNameEmpty";
    } else {
        echo $user_obj->update($update_query, $data);
    }
}

if (isset($_POST['submit']) && $_POST['submit'] == 'contact_info') {
    $phone_num = (isset($_POST['phone'])) ? $_POST['phone'] : '';
    $user_id = $_POST['id'];
    $update_query = "UPDATE users SET user_phone = :phone  WHERE user_id = :id";
    $data = [
        "phone" => $phone_num,
        "id" => $user_id,
    ];
    if (empty($phone_num)) {
        echo 'Cant Be Empty';
    } else if (!$user_obj->checkPhoneNumber($phone_num)) {
        echo 'Invalid Phone Number';
    } else {
        echo $user_obj->update($update_query, $data);
    }
}

