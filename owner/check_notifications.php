<?php
include 'init.php';
//NOTE - update read status of notifications
$id = isset($_POST['owner_id']) ? $_POST['owner_id'] : 0;
$stmt2 = $conn->prepare("SELECT * FROM `notifications` WHERE `read_status` = 0 AND `receive_id` = ?");
$stmt2->execute([$id]);
$notifications_num = ($stmt2->rowCount() > 0) ? $stmt2->rowCount() : '';
echo $notifications_num;
