<?php
include 'init.php';
include  $config . 'config.php';
include $config . "generalClass.php";
$comment_obj = new GeneralClass;
$property_id = $_POST['property_id'];
print_r(json_encode($comment_obj->get_lasted_comments($property_id)));
