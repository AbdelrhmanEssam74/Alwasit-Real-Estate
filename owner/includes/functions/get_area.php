<?php
include '../../init.php';
$stmt2 = $conn->prepare("SELECT DISTINCT(area) FROM `properties` ORDER BY `properties`.`area` ASC");
$stmt2->execute();
$area = $stmt2->fetchAll(PDO::FETCH_OBJ);
echo json_encode($area);
