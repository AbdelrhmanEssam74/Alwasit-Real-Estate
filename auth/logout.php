<?php
session_start();
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';
$userObj = new loginTable();
$user_id = $_SESSION['uID'];
$delete_query = "DELETE FROM `users` WHERE user_id='" . $user_id . "'";
echo $userObj->delete($delete_query);
$_SESSION = array();
session_destroy();
if (isset($_COOKIE['your_cookie_name'])) {
    unset($_COOKIE['your_cookie_name']);
}
// header("Location:../" . $home);
// exit();
