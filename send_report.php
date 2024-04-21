<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$reports_obj = new GeneralClass;
$user_id = $_POST['user_id'];
$owner_id = $_POST['owner_id'];
$property_id = $_POST['property_id'];
$report_reason = $_POST['report_reason'];
$additional_reason = $_POST['additional_reason'];
date_default_timezone_set('Africa/Cairo');
// inset the reports in the database
$current_date = date('Y-m-d h:i:s');
$inset_query = "INSERT INTO `reports` ( `user_id`, `owner_id`, `property_id`, `report_reason` , `additional_reason`, `timestamp`) VALUES ('$user_id', '$owner_id', '$property_id', '$report_reason', '$additional_reason', '$current_date')";
echo $reports_obj->insert($inset_query);
