<?php
include 'init.php';
include $function . 'function.php';
$owner_id = $_SESSION['owner_id'];
echo setNotifications($owner_id, "Accept New Property Listing", "تم قبول العقار بنجاح");
