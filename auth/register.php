<?php

define("AppURL", 'http://localhost/Graduation_Project');  // Define the URL of your application

session_start();
include '../config/registerTable.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$userObj = new RegisterTable();

$phone = $_POST['phone'];
$email = $_POST['email'];

// Check if the phone number is valid
if (!$userObj->checkPhoneNumber($phone)) {
    $_SESSION['Invalid_PHONE'] = "من فضلك أدخل رقم صحيح";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Check if the email address is already registered
if ($userObj->checkEmailExists($email) > 0) {
    $_SESSION['Exists_EMAIL'] = "هذا البريد الإلكتروني مسجل بالفعل";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Check if the phone number is already registered
if ($userObj->checkPhoneExists($phone) > 0) {
    $_SESSION['Exists_Phone'] = "هذا الرقم مسجل بالفعل";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$firstName = trim($_POST['FName']);
$lastName = trim($_POST['LName']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$data = [
    "id" => uniqid(),
    "username" => trim(strstr($email, '@', true)),
    "FN" => $firstName,
    "LN" => $lastName,
    "em" => $email,
    "pass" => $password,
    "phone" => $phone,
];

$insertQuery = "INSERT INTO `alwasit`.`register` (user_id, username, F_Name, L_Name, email, user_phone, Password) 
                VALUES (:id, :username, :FN, :LN, :em, :phone, :pass)";
$userObj->insert($insertQuery, $data);

header("Location: " . AppURL . "/verification.php");
exit();
