<?php
include 'init.php';
include $config . 'config.php';
include $config . "generalClass.php";

$favorite_obj = new GeneralClass;
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
$is_fav = $_POST['is_fav'];
$owner_id = $_POST['owner_id'];
date_default_timezone_set('Africa/Cairo');
$current_date = date('Y-m-d H:i:s');

// Check if the property exists in favorites for the user
$stmt_select = $favorite_obj->select("SELECT * FROM `favorites` WHERE `fav_property_id`='$property_id' AND `fav_user_id`='$user_id'");

if (isset($stmt_select[0])) {
  // Update the favorite status
  if ($is_fav == 0) {
    $update_query = "UPDATE `favorites` SET `checked`=1, `timestamp`='$current_date' WHERE `fav_property_id`='$property_id' AND `fav_user_id`='$user_id'";
    echo $favorite_obj->insert($update_query);
  } else {
    $update_query = "UPDATE `favorites` SET `checked`=0, `timestamp`='$current_date' WHERE `fav_property_id`='$property_id' AND `fav_user_id`='$user_id'";
    echo $favorite_obj->insert($update_query);
  }
} else {
  // Insert a new favorite
  $insert_query = "INSERT INTO `favorites` (`fav_owner_id` ,`fav_property_id`, `fav_user_id`, `checked`, `timestamp`) VALUES ('$owner_id','$property_id', '$user_id', 1, '$current_date')";
  echo $favorite_obj->insert($insert_query);
}
