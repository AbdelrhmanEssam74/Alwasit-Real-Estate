<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
include $libs . "emails/index.php";
$user_id =  (isset($_POST['id'])) ? $_POST['id'] : 0;
$stmt = $conn->prepare("SELECT *  FROM  users WHERE user_id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetchObject();
$count = $stmt->rowCount();
if ($count > 0) :
  $stmt = $conn->prepare("DELETE FROM `onwer_requests` WHERE user_id = :id");
  $stmt->bindParam(':id', $user_id);
  $r = $stmt->execute();
  echo $r;
  // send email to user tell him he is now an active owner 
  $mailBody = "
  <!DOCTYPE html>
  <html>
  <head>
  </head>
  <body style='display: flex;flex-direction: column;align-items: center;gap: 15px;'>
  مرحبًا  <h3 style='text-align:right ; width:100%'>$row->F_Name  $row->L_Name,</h3>
  <p style='text-align:right ; width:100% ; padding: 20px ; background-color:#003481 ; color :#fff'>
    ناسف لقد تم رفض الطلب الخاص بك ,برجاء مراجعة البيانات الخاصه بك
  </p>
  <p style='text-align:right ; width:100%'>فريق الوسيط</p>
  <a style='text-align:right ; width:100%' href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
  </body>
  </html>
  ";
  $email_subject  = 'Alwasit | الوسيط';
  $send_email_obj = new EmailSender($row->email, $email_subject, $mailBody);
  $send_email_obj->sendEmail();
endif;
