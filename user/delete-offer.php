<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$delete_obj = new GeneralClass;
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
echo $delete_obj->delete("DELETE FROM `offers` WHERE `offer_user_id` = '$user_id' AND `offer_property_id` = '$property_id'");
