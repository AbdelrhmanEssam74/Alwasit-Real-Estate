<?php
include '../init.php';
session_start();
include '../' . $config . 'config.php';
include '../' . $config . 'usersTable.php';
include '../' . $config . 'emailsTable.php';
include '../' . $emails_libs . 'index.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
}

$userObj = new RegisterTable();

$phone = $_POST['phone'];
$email = $_POST['email'];

// Validate phone number
if (!$userObj->checkPhoneNumber($phone)) {
  $_SESSION['Invalid_PHONE'] = "من فضلك أدخل رقم صحيح";
  header("Location:" . APPURL . $register);
  exit();
}

// Check if the email address is already registered
if ($userObj->checkEmailExists($email) > 0) {
  $_SESSION['Exists_EMAIL'] = "هذا البريد الإلكتروني مسجل بالفعل";
  $_SESSION['old_data'] = json_encode(array($_POST));
  header("Location:" . APPURL . $register);
  exit();
}

// Check if the phone number is already registered
if ($userObj->checkPhoneExists($phone) > 0) {
  $_SESSION['Exists_Phone'] = "هذا الرقم مسجل بالفعل";
  $_SESSION['old_data'] = json_encode(array($_POST));
  header("Location:" . APPURL . $register);
  exit();
}

$firstName = trim($_POST['FName']);
$lastName = trim($_POST['LName']);
$_SESSION['fullname'] = $firstName . " " . $lastName;
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$id = uniqid();
$_SESSION['user_id'] = $id;
$data = [
  "id" => $id,
  "username" => trim(strstr($email, '@', true)),
  "N" => $firstName . " " . $lastName,
  "em" => $email,
  "pass" => $password,
  "phone" => $phone,
];

$insertQuery = "INSERT INTO `alwasit`.`users` (user_id, username, FullName, email, user_phone, Password , reg_status) 
                VALUES (:id, :username, :N, :em, :phone, :pass , 1)";
$userObj->insert($insertQuery, $data);

// send verification  code to user's email
$email_obj = new EmailsTable();
$activation_code = $email_obj->generate_code();
$activation_code_hashed  = password_hash($activation_code, PASSWORD_DEFAULT);
$email_subject  = 'قم بتأكيد عنوان بريدك الإلكتروني';
$mailBody = "
<!DOCTYPE html>
<html dir='rtl'>
<head>
  <meta charset='UTF-8'>
  <title> Alwasit تنبيه تسجيل الدخول - نشاط على حسابك في </title>
  <style>
  p{
    color : #333;
    line-height : 1.8;
    padding:15px;
  }
  h3{
    color : #ff9a33;
  }
  </style>
</head>
<body>
  <div style='font-family: Arial, sans-serif; text-align: right; padding:15px'>
  <h3>مرحبًا  {$firstName} {$lastName}</h3>
  <p>شكرًا لك على تسجيل حساب معنا! قبل أن تتمكن من استخدام حسابك، يُرجى التحقق من عنوان بريدك الإلكتروني عن طريق النقر علي هذا الرابط:
</p>
<a href='http://localhost/Alwasit/verification.php?vc={$activation_code_hashed}&uID={$id}'>
Active
</a>
    <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3><a href='http://localhost/Alwasit'>Alwasit</a></h3>
  </div>
</body>
</html>
        ";
$current_time = time(); // Current timestamp
$next_day = strtotime('+24 hours', $current_time);
$next_day_formatted = date('Y-m-d H:i:s', $next_day);

$send_email_obj = new EmailSender($email, $email_subject, $mailBody);
$send_email_obj->sendEmail();

$data_email = [
  "id" => $id,
  "em" => $email,
  "code" => $activation_code,
  "active" => 0,
  "activation_expire_at" => $next_day_formatted
];

$insertQuery_email = "INSERT INTO `alwasit`.`email_verification` (user_id, email, code, active , activation_expiry) 
                VALUES (:id,:em, :code, :active , :activation_expire_at)";
$email_obj->insert($insertQuery_email, $data_email);
header("Location:../" . $verification_page . "?send=true");
exit();
