<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$comment_obj = new GeneralClass;
$user_id = $_POST['uID'];
$comment_id = $_POST['commentID'];
$property_id = $_POST['PID'];
$delete_query = "DELETE FROM comments WHERE user_id = '$user_id' AND comment_id = '$comment_id'";
echo $comment_obj->delete($delete_query);
// update number of comments in comments_num for property
// get the value of the number and decrease it
$number_of_comments = "SELECT `comments_num` FROM `properties` WHERE `property_id` = '$property_id'";
$num = $comment_obj->select($number_of_comments);
$n = $num[0]['comments_num'];
$n = $n - 1;
$update_query = "UPDATE `properties` SET `comments_num` = '$n' WHERE `property_id` = '$property_id'";
$comment_obj->update($update_query);
