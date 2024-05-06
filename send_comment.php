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
// update number of comments in comments_num for property
// get the value of the number and increase it
$number_of_comments = "SELECT `comments_num` FROM `properties` WHERE `property_id` = '$property_id'";
$num = $comment_obj->select($number_of_comments);
$n = $num[0]['comments_num'];
$n = $n + 1;
$update_query = "UPDATE `properties` SET `comments_num` = '$n' WHERE `property_id` = '$property_id'";
$comment_obj->update($update_query);
