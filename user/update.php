<?php
include_once 'init.php';
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
$login_obj = new loginTable;
$user_obj = new RegisterTable;


// Validate input data
if (isset($_POST['submit']) && $_POST['submit'] == 'personal_info') {
  // $newImg = isset($_POST['newImg']) ? $_POST['newImg'] : 0;
  // $oldImg = $_POST['oldImg'];
  // $username = (isset($_POST['username'])) ? $_POST['username'] : '';
  $full_name = (isset($_POST['fullname'])) ? $_POST['fullname'] : '';
  // $profile_img = ($newImg == 0) ? $oldImg : $newImg;
  $user_id = $_POST['id'];
  // $update_query = "UPDATE users SET username = :uname , FullName =:Name , profile_img = :img WHERE user_id = :id";
  $update_query = "UPDATE users SET  FullName =:Name  WHERE user_id = :id";
  $data = [
    // "uname" => $username,
    "Name" => $full_name,
    // "img" => $profile_img,
    "id" => $user_id,
  ];
  // if (empty($username)) {
  //   echo 'nameEmpty';
  // } else 
  if (empty($full_name)) {
    echo "fNameEmpty";
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

if (isset($_POST['submit']) && $_POST['submit'] == 'Password-info') {
  $user_id = $_POST['id'];
  $user_data = $user_obj->getAll($user_id)[0];
  $oldpass = $_POST['oldpass'];
  $oldPassInput = (isset($_POST['pass_old_input'])) ? $_POST['pass_old_input'] : '';
  $newpass = $_POST['newpass'];
  if (empty($oldPassInput)) {
    echo 'Cant Be Empty';
  } else if (!password_verify($oldPassInput, $user_data->Password)) {
    echo 'Wrong Password';
  }
  // Checking old password is correct or not
  else if (empty($newpass)) {
    echo 'New Password Cant be empty';
  } elseif (strcmp($oldPassInput, $newpass) === 0) {
    echo "You Use This Password Before! Try Another One.";
  } else {
    $update_query_users_table = "UPDATE users SET Password = :pass  WHERE user_id = :id";
    $update_query_login_table = "UPDATE login SET Password = :pass  WHERE user_id = :id";
    $data = [
      "pass" => password_hash($newpass, PASSWORD_DEFAULT),
      "id" => $user_id,
    ];
    if ($user_obj->update($update_query_users_table, $data) || $login_obj->update($update_query_login_table, $data)) {
      echo 1;
    } else {
      echo 0;
    }
  }
}
