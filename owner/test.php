<?php
include 'init.php';
include $function . 'function.php';
$owner_id = $_SESSION['owner_id'];
print_r(array_keys($notification_type, $notification_type['New Property Listing'])[0]);
print_r($_SESSION);