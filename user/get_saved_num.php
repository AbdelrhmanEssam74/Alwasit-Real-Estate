<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$saved_obj = new GeneralClass;
$user_id = $_POST['user_id'];
echo $saved_obj->get_saved_num($user_id);
