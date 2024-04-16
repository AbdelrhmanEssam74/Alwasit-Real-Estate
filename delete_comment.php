<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$comment_obj = new GeneralClass;
$user_id = $_POST['uID'];
$comment_id = $_POST['commentID'];
$delete_query = "DELETE FROM comments WHERE user_id = '$user_id' AND comment_id = '$comment_id'";
echo $comment_obj->delete($delete_query);
