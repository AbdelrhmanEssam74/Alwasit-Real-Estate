<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
include $func . 'functions.php';
include $libs . "emails/index.php";
$owner_id =  (isset($_POST['owner_id'])) ? $_POST['owner_id'] : 0;
$property_id =  (isset($_POST['property_id'])) ? $_POST['property_id'] : 0;

// active property in database
$stmt = $conn->prepare("UPDATE `properties` SET `active` = 1 WHERE `owner_id` = ? AND `property_id` = ?");
$stmt->execute(array($owner_id, $property_id));

$stmt2 = $conn->prepare('SELECT * FROM owners INNER JOIN properties ON owners.owner_id=properties.owner_id WHERE properties.property_id = ? AND properties.owner_id =?');
$r = $stmt2->execute(array($property_id, $owner_id));
$user_data = $stmt2->fetch(PDO::FETCH_OBJ);
if ($stmt->rowCount() && $r) {
  // send email to user tell him he is now an active owner 
  $mailBody = "
  <!DOCTYPE html>
  <html>
  <head>
  </head>
  <body style='display: flex;flex-direction: column; text-align:right;gap: 15px;'>
  مرحبًا  <h3>$user_data->full_name,</h3>
  <p>
  تم قبول العقار الخاص بك بنجاح 
  <br>
  عنوان العقار : $user_data->title
  <br>
  تاريخ النشر : $user_data->uploaded_at
  </p>
  <p>فريق الوسيط</p>
  <a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
  </body>
  </html>
  ";
  $email_subject  = 'Alwasit | الوسيط';
  $send_email_obj = new EmailSender($user_data->email, $email_subject, $mailBody);
  $send_email_obj->sendEmail();
  // send notification to the owner 
  setNotifications($owner_id, array_keys($notification_type, $notification_type['Accept Property Listing'])[0], $notification_type['Accept Property Listing']);
}
if ($stmt->rowCount() > 0 && $r)
  echo 1;
else
  echo 0;
