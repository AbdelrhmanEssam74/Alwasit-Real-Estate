<?php
include 'init.php';
if (isset($_POST['submit']) && $_POST['submit'] === "general_info") :
  $owner_id =  $_POST['owner_id'];
  $full_name = $_POST['full-name'];
  $user_id = $_POST['user_id'];
  $update_query_owner = $conn->prepare("UPDATE owners SET `full_name` = '$full_name' Where owner_id = '$owner_id'");
  $update_query_owner->execute();

  $update_query_user = $conn->prepare("UPDATE users SET `FullName` = '$full_name' Where user_id = '$user_id'");
  $update_query_user->execute();

  if ($update_query_owner->rowCount() &&   $update_query_owner->rowCount()) {
    echo 1;
  }
endif;
if (isset($_POST['submit']) && $_POST['submit'] === "security_info") :
  $owner_id =  $_POST['owner_id'];
  $user_id = $_POST['user_id'];
  $current_pass = $_POST['current_pass'];
  $new_pass = $_POST['new_pass'];
  // check the current pass
  $new_pass_hashed = password_hash($current_pass, PASSWORD_DEFAULT);
  $select_query_pass = $conn->prepare("SELECT `Password` FROM  `users` WHERE `user_id` = '$user_id' ");
  $select_query_pass->execute();
  if (password_verify($current_pass, $select_query_pass->fetchColumn())) :
    $update_query_pass = $conn->prepare("UPDATE users SET Password = '$new_pass_hashed' WHERE `user_id` = '$user_id'");
    $update_query_pass->execute();
    echo $update_query_pass->rowCount();
  else :
    echo -1;
  endif;
endif;
