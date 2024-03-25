<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
$user_id =  (isset($_POST['id']) && is_numeric($_POST['id'])) ? intval($_POST['id'])  : 0;
// Update The RegStatus in database
$stmt = $conn->prepare("UPDATE users SET `reg_status` = :reg WHERE user_id = :id");
$r = $stmt->execute(array(
    'reg'     => 1,
    'id'     => $user_id,
));
echo  $stmt->rowCount();
