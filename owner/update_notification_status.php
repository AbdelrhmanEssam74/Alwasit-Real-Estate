<?php
include 'init.php';
//NOTE - update read status of notifications
$id = isset($_POST['owner_id']) ? $_POST['owner_id'] : 0;
$update_query = $conn->prepare("UPDATE notifications SET `read_status` = 1 WHERE `receive_id` = '$id'");
$update_query->execute();