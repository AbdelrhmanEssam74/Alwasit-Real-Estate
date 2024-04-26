<?php
include 'init.php';
include $libs . 'emails/index.php';
$submit = $_POST['submit'];
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
$stmt2 = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt2->execute(array($user_id));
$user = $stmt2->fetch(PDO::FETCH_OBJ);
$user_email = $user->email;
$user_full_name = $user->FullName;
$property_url = APPURL . "property_details.php?PId=" . $property_id;
$current_date = date('Y-m-d h:i');
if ($submit == "accept") {
  $stmt = $conn->prepare("UPDATE offers set offer_status = 1 WHERE offer_user_id = ? AND offer_property_id = ?");
  $r = $stmt->execute(array($user_id, $property_id));
  if ($r) {
    // send email to user
    $email_subject = "تم قبول عرضك بنجاح";
    $mailBody = "
<!DOCTYPE html>
<html dir='rtl'>
<head>
  <meta charset='UTF-8'>
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
  <h3>مرحباً :  $user_full_name</h3>
  <p><strong>تم قبول عرضك بنجاح. </strong></p>
  <hr />
  <p>التاريخ : $current_date</p>
  <a href='$property_url'>الرابط الخاص بالعرض</a>
  <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3>Alwasit</h3>
  </div>
</body>
</html>
        ";
    $send_login_obj = new EmailSender($user_email, $email_subject,   $mailBody);
    $send_login_obj->sendEmail();
    echo $r;
  }
} else if ($submit == "refuse") {
  $stmt = $conn->prepare("UPDATE offers set offer_status = -1 WHERE offer_user_id = ? AND offer_property_id = ?");
  $r = $stmt->execute(array($user_id, $property_id));
  if ($r) {
    // send email to user
    $email_subject = "تم رفض عرضك ";
    $mailBody = "
<!DOCTYPE html>
<html dir='rtl'>
<head>
  <meta charset='UTF-8'>
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
  <h3>مرحباً :  $user_full_name</h3>
  <p><strong>تم رفض عرضك . </strong></p>
  <hr />
  <p>التاريخ : $current_date</p>
  <a href='$property_url'>الرابط الخاص بالعرض</a>
  <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3>Alwasit</h3>
  </div>
</body>
</html>
        ";
    $send_login_obj = new EmailSender($user_email, $email_subject,   $mailBody);
    $send_login_obj->sendEmail();
    echo $r;
  }
}
