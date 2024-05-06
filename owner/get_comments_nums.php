<?php
include 'init.php';
$owner_id = $_SESSION['owner_id'];
$stmt2 = $conn->prepare("SELECT COUNT(owner_id) from comments WHERE owner_id = '$owner_id'");
$stmt2->execute();
$nums = $stmt2->fetchColumn();
echo $nums;
