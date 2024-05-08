<?php
include 'init.php';

if (isset($_POST['submit'])) {
  $submit = $_POST['submit'];

  switch ($submit) {
    case 'general_info':
      updateGeneralInfo();
      break;

    case 'security_info':
      updateSecurityInfo();
      break;

    case 'social_info':
      updateSocialInfo();
      break;

    default:
      echo -1;
      break;
  }
}

function updateGeneralInfo()
{
  global $conn;

  $owner_id = $_POST['owner_id'];
  $full_name = $_POST['full-name'];
  $user_id = $_POST['user_id'];

  $update_query_owner = $conn->prepare("UPDATE owners SET `full_name` = :full_name WHERE owner_id = :owner_id");
  $update_query_owner->bindParam(':full_name', $full_name);
  $update_query_owner->bindParam(':owner_id', $owner_id);
  $update_query_owner->execute();

  $update_query_user = $conn->prepare("UPDATE users SET `FullName` = :full_name WHERE user_id = :user_id");
  $update_query_user->bindParam(':full_name', $full_name);
  $update_query_user->bindParam(':user_id', $user_id);
  $update_query_user->execute();

  if ($update_query_owner->rowCount() && $update_query_user->rowCount()) {
    echo 1;
  } else {
    echo -1;
  }
}

function updateSecurityInfo()
{
  global $conn;

  $owner_id = $_POST['owner_id'];
  $user_id = $_POST['user_id'];
  $current_pass = $_POST['current_pass'];
  $new_pass = $_POST['new_pass'];

  $select_query_pass = $conn->prepare("SELECT `Password` FROM `users` WHERE `user_id` = :user_id");
  $select_query_pass->bindParam(':user_id', $user_id);
  $select_query_pass->execute();
  $hashed_password = $select_query_pass->fetchColumn();

  if (password_verify($current_pass, $hashed_password)) {
    $new_pass_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
    $update_query_pass = $conn->prepare("UPDATE users SET Password = :new_pass WHERE `user_id` = :user_id");
    $update_query_pass->bindParam(':new_pass', $new_pass_hashed);
    $update_query_pass->bindParam(':user_id', $user_id);
    $update_query_pass->execute();
    echo $update_query_pass->rowCount();
  } else {
    echo -1;
  }
}

function updateSocialInfo()
{
  global $conn;

  $owner_id = $_POST['owner_id'];
  $user_id = $_POST['user_id'];
  $face_link = $_POST['face_link'];
  $x_link = $_POST['x_link'];
  $linked_link = $_POST['linked_link'];

  // Check if all inputs have a value
  $update_query = $conn->prepare("UPDATE owners SET `facebook_link` = :face_link, `twitter_link` = :x_link, `linkedin_link` = :linked_link WHERE `owner_id` = :owner_id");
  $update_query->bindParam(':face_link', $face_link);
  $update_query->bindParam(':x_link', $x_link);
  $update_query->bindParam(':linked_link', $linked_link);
  $update_query->bindParam(':owner_id', $owner_id);
  $update_query->execute();

  echo $update_query->rowCount();
}
