<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$neighborhood_obj = new GeneralClass;
$neighborhood_names = $neighborhood_obj->get_neighborhood();
echo json_encode($neighborhood_names);
