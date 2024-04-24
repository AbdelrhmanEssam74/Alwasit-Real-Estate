<?php
include 'init.php';
include  $config . 'config.php';
include $config . "propertyTable.php";
$saved_obj = new PropertyTable;
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
echo $saved_obj->remove_fav($user_id, $property_id);
