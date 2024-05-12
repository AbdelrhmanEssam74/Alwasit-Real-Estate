<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$obj = new GeneralClass;
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$message = $_POST['message'];

date_default_timezone_set('Europe/Sofia');
// inset the comment in the database
$current_date = date('Y-m-d h:i:s');
$inset_query = "INSERT INTO `customers_service` ( `fullName`, `email`, `message_content`, `timestamp`, `is_client`) VALUES ('$fullName', '$email', '$message', '$current_date', '1')";
echo $obj->insert($inset_query);
