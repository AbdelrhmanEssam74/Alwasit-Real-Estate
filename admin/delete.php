<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
$user_id =  (isset($_POST['id']) && is_numeric($_POST['id'])) ? intval($_POST['id'])  : 0;
$stmt = $conn->prepare("SELECT *  FROM users  WHERE user_id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetchObject();
$count = $stmt->rowCount();
if ($count > 0) :
    $stmt = $conn->prepare("DELETE FROM `users` WHERE user_id = :id");
    $stmt->bindParam(':id', $user_id);
    $r = $stmt->execute();
    echo $r;
endif;
