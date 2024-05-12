<?php include 'init.php';
include  $config . 'config.php';
include $config . 'propertyTable.php';
// get  properties for buy from database
$property_obj = new PropertyTable();
$data = $property_obj->getALLPropertiesBuyType("للبيع");
echo count($data);
