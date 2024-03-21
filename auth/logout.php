<?php
session_start();
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';
$userObj = new loginTable();
$user_id = $_SESSION['uID'];
$delete_query = "DELETE FROM `login` WHERE user_id='" . $user_id . "'";
$userObj->delete($delete_query);
session_unset();
session_destroy();
setcookie('rem', "", -1, '/');
header("Location:../" . $home);
exit();
