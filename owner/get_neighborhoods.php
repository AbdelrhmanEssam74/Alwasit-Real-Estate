<?php
include 'init.php';
$stmt2 = $conn->prepare("SELECT neighborhood_name FROM `neighborhoods`");
$stmt2->execute();
$neighborhood_names = $stmt2->fetchAll(PDO::FETCH_OBJ);
echo json_encode($neighborhood_names);
