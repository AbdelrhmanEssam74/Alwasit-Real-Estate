<?php
include 'init.php';
$stmt2 = $conn->prepare("SELECT category_name FROM `categories`");
$stmt2->execute();
$category_name = $stmt2->fetchAll(PDO::FETCH_OBJ);
echo json_encode($category_name);
