<?php include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
// get  properties for buy from database
$obj = new GeneralClass;
$data = $obj->select("SELECT COUNT(*) FROM users");
echo 26;
