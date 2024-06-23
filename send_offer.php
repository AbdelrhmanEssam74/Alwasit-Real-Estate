<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$offer_obj = new GeneralClass;
$user_id = $_POST['user_id'];
$owner_id = $_POST['owner_id'];
$property_id = $_POST['property_id'];
$offer = $_POST['offer'];
// $user_mail = $_POST['user_mail'];
// $full_name = $_POST['full_name'];
date_default_timezone_set("Europe/Sofia");
// inset the offer in the database
$current_date = date('Y-m-d h:i:s');
$inset_query = "INSERT INTO `offers` ( `offer_user_id`, `offer_owner_id`, `offer_property_id`, `offer_content`, `offer_timestamp`) VALUES ('$user_id', '$owner_id', '$property_id', '$offer', '$current_date')";
echo $offer_obj->insert($inset_query);
