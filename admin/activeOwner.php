<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
include $libs . "emails/index.php";
$user_id =  (isset($_POST['id'])) ? $_POST['id'] : 0;

// add The owner in database
// get his data from users table in database to inset the owner info into owners table
$stmt_data = $conn->prepare('SELECT * FROM users WHERE user_id = :id');
$r = $stmt_data->execute(array(
  'id'     => $user_id,
));
$user_data = $stmt_data->fetch(PDO::FETCH_OBJ);

// inset the owner info into owners table
$owner_id = uniqid();
$inset_query = $conn->prepare("INSERT INTO owners (`owner_id`, `full_name`, `username`, `email`, `phone_num`, `is_active`)
          VALUES (:owner_id, :full_name, :username, :email, :phone_num, :is_active)");
$inserted_data = [
  'owner_id' => $owner_id,
  'full_name' => $user_data->F_Name . ' ' . $user_data->L_Name,
  'username' => $user_data->username,
  'email' => $user_data->email,
  'phone_num' => $user_data->user_phone,
  'is_active' => 1
];
$inset_query->bindValue(':owner_id', $inserted_data['owner_id']);
$inset_query->bindValue(':full_name', $inserted_data['full_name']);
$inset_query->bindValue(':username', $inserted_data['username']);
$inset_query->bindValue(':email', $inserted_data['email']);
$inset_query->bindValue(':phone_num', $inserted_data['phone_num']);
$inset_query->bindValue(':is_active', $inserted_data['is_active']);
$r = $inset_query->execute();

// Update The is_owner in userts talbe in database
$stmt_users = $conn->prepare("UPDATE users SET `is_owner` = :ow , `owner_id` = :owner_id WHERE user_id = :id");
$r = $stmt_users->execute(array(
  'ow'     => 1,
  'owner_id' => $owner_id,
  'id'     => $user_id,
));

// Update The active in owner_requests talbe in database
$stmt_users = $conn->prepare("UPDATE onwer_requests SET `active` = :act WHERE user_id = :id");
$r = $stmt_users->execute(array(
  'act'     => 1,
  'id'     => $user_id,
));

// send email to user tell him he is now an active owner 
$mailBody = "
<!DOCTYPE html>
<html>
<head>
</head>
<body style='display: flex;flex-direction: column;align-items: center;gap: 15px;'>
مرحبًا  <h3>$user_data->F_Name  $user_data->L_Name,</h3>
<p>
    تم قبول طلبك يمكنك الأن نشر العقارات الخاصه بك 
</p>
<p>فريق الوسيط</p>
<a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
</body>
</html>
";
$email_subject  = 'Alwasit | الوسيط';
$send_email_obj = new EmailSender($user_data->email, $email_subject, $mailBody);
$send_email_obj->sendEmail();
if ($stmt_users->rowCount() &&   $stmt_users->rowCount() && $r)
  echo 1;
else
  echo 0;
