<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$comment_obj = new GeneralClass;
$user_id = $_POST['user_id'];
$owner_id = $_POST['owner_id'];
$property_id = $_POST['property_id'];
$comment = $_POST['comment'];
// $user_mail = $_POST['user_mail'];
// $full_name = $_POST['full_name'];
date_default_timezone_set('Africa/Cairo');
// inset the comment in the database
$current_date = date('Y-m-d h:i:s');
$inset_query = "INSERT INTO `comments` ( `user_id`, `owner_id`, `property_id`, `content`, `timestamp`) VALUES ('$user_id', '$owner_id', '$property_id', '$comment', '$current_date')";
echo $comment_obj->insert($inset_query);
