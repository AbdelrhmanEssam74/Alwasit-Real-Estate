<?php

session_start();
include '../config/registerTable.php';
$prev_path = $_SERVER['HTTP_REFERER'];
if ($_SERVER['REQUEST_METHOD'] !== "POST") :
    header("Location:" . $prev_path);
    exit();
else :
    //NOTE - validate phone number according to the system of egypt
    $userObj = new RegisterTable();
    if ($userObj->checkPhoneNumber((int)($_POST['phone']))) {
        echo "Phone number is already registered";
    } else {
        echo "good";
    }
    var_dump($_POST);
    $data = [
        "FN" => $firstName = trim($_POST['FName']),
        "LN" => $lastName = trim($_POST['LName']),
        "em" => $email = $_POST['email'],
        "pass" => $password = password_hash($_POST['password'], PASSWORD_DEFAULT),
        "phone" => $phoneNumber = $_POST['phone'],
    ];
endif;
