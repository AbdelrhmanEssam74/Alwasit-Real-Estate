<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
include $libs . "emails/index.php";
function sendEmail($full_name, $email)
{
  $mailBody = "
<!DOCTYPE html>
<html>
<head>
</head>
<body>
مرحبًا  <h3 style='text-align:right'>$full_name</h3>
<p style='text-align:right'>
  تم حذف الحساب الخاص بك لإختراقك قوانين موقع الوسيط 
</p>
<p style='text-align:right'>فريق الوسيط</p>
<a style='text-align:right' href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
</body>
</html>
";
  $email_subject  = 'Alwasit | الوسيط';
  $send_email_obj = new EmailSender($email, $email_subject, $mailBody);
  $send_email_obj->sendEmail();
}
if (isset($_POST['user_id'])) {
  $user_id =  (isset($_POST['id'])) ? $_POST['id']  : 0;
  $stmt = $conn->prepare("SELECT *  FROM users  WHERE user_id = ?");
  $stmt->execute([$user_id]);
  $row = $stmt->fetchObject();
  $count = $stmt->rowCount();
  if ($count > 0) :
    $stmt = $conn->prepare("DELETE FROM `users` WHERE user_id = :id");
    $stmt->bindParam(':id', $user_id);
    $r = $stmt->execute();
    echo $r;
    sendEmail($row->F_Name . ' ' .  $row->L_Name,   $row->email);
  endif;
} elseif (isset($_POST['owner_id'])) {
  $owner_id =  (isset($_POST['owner_id'])) ? $_POST['owner_id']  : 0;
  $stmt = $conn->prepare("SELECT * FROM owners  WHERE owner_id = ?");
  $stmt->execute([$owner_id]);
  $row = $stmt->fetchObject();
  $count = $stmt->rowCount();
  if ($count > 0) :
    $stmt = $conn->prepare("DELETE FROM `owners` WHERE owner_id = :id");
    $stmt->bindParam(':id', $owner_id);
    $r = $stmt->execute();
    echo $r;
    sendEmail($row->F_Name . ' ' .  $row->L_Name,   $row->email);
  endif;
}
