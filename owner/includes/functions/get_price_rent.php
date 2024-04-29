<?php
include '../../init.php';
$stmt2 = $conn->prepare("SELECT DISTINCT(`price`) FROM `properties` WHERE `status` = 'لللإيجار' ORDER BY `properties`.`price` ASC");
$stmt2->execute();
$rent_Price = $stmt2->fetchAll(PDO::FETCH_OBJ);
echo json_encode($rent_Price);
