<?php
include 'init.php';
include $function . 'function.php';
include $libs . 'emails/index.php';
$owner_id = $_POST['owner_id'];
$property_id = $_POST['property_id'];
$update_query = $conn->prepare("UPDATE properties SET `deleted` = 1 WHERE `property_id` = '$property_id' AND `owner_id` = '$owner_id'");
setNotifications($owner_id, array_keys($notification_type, $notification_type['Delete'])[0], $notification_type['Delete']);
// get the value of property_num from owners table in database and increate it by 1
$get_stmt = $conn->prepare("SELECT property_num FROM owners WHERE owner_id = :owner_id");
$get_stmt->execute(['owner_id' => $owner_id]);
$property_num = $get_stmt->fetchColumn();
$property_num = ($property_num > 0) ? $property_num-- : 0; // if there is no property, set property_num to 0
// update the property_num in owners table in database
$update_stmt = $conn->prepare("UPDATE owners SET property_num = :property_num WHERE owner_id = :owner_id");
$update_stmt->execute(['property_num' => $property_num, 'owner_id' => $owner_id]);
$full_name = $_SESSION['fullname'];
$current_date = date('Y-m-d h:i');
$propertyTitle = $_SESSION['property_title'];
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
    <h2>عزيزي $full_name</h2>
    <p>تم حذف العقار بنجاح</p>
    <h4>تفاصيل العقار:</h4>
    <ul>
      <li>$propertyTitle</li>
    </ul>
    <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3>Alwasit</h3>
  </div>
</body>
</html>
";
$email_subject  = 'Alwasit | الوسيط';
$send_email_obj = new EmailSender($_SESSION['email'], $email_subject, $mailBody);
$send_email_obj->sendEmail();
echo $update_query->execute();
