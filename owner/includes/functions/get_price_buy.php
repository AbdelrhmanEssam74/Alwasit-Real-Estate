<?php
include '../../init.php';
$stmt2 = $conn->prepare("SELECT `price` FROM `properties` WHERE `status` = 'للبيع' ORDER BY `properties`.`price` ASC");
$stmt2->execute();
$buy_Price = $stmt2->fetchAll(PDO::FETCH_OBJ);
echo json_encode($buy_Price);
