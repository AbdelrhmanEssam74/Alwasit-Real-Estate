<?php
/*
== check if the user is allowed to access the dashboard or no
    -- check if he is owner or normal user
*/
include 'init.php';
include $libs . "emails/index.php";
$dashboard_url = APPURL . "owner/dashboard.php";
$user_id = isset($_SESSION['uID']) ? $_SESSION['uID'] : 0;
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ);
if (isset($data)) :
  $is_onwer = $data->is_owner;
  //NOTE -  check if user is already onwer 
  if ($is_onwer) :
    $_SESSION['owner'] = true;
    $_SESSION['owner_id'] = $data->owner_id;
    print_r(json_encode([
      $is_onwer,
      $dashboard_url
    ]));
    exit;
  else :
    // check if user is already send a request before sending another one
    $stmt_owner_requset = $conn->prepare("SELECT * FROM `onwer_requests` WHERE `user_id` = '$user_id'");
    $stmt_owner_requset->execute();
    if ($stmt_owner_requset->rowCount() > 0) {
      echo 2;
      exit();
    } else {
      $owner_rquest = 0;
      if (isset($_POST['owner-request']) && $_POST['owner-request'] == 1) {
        $_SESSION['owner-request'] = $_POST['owner-request'];
        $owner_rquest = 3;
        // inset a new request in the database
        $insert_request = $conn->prepare("INSERT INTO `onwer_requests` (`user_id` , `username` ,`email` ,`active`)
        Value (:user_id, :username, :email, :active)");
        $inserted_data = [
          'user_id' => $user_id,
          'username' => $data->username,
          'email' => $data->email,
          'active' => 0
        ];
        $insert_request->bindValue(':user_id', $inserted_data['user_id']);
        $insert_request->bindValue(':username', $inserted_data['username']);
        $insert_request->bindValue(':email', $inserted_data['email']);
        $insert_request->bindValue(':active', $inserted_data['active']);
        $r = $insert_request->execute();
        // echo $r;
        // NOTE - send an email to the user 
        $mailBody = "
                  <!DOCTYPE html>
                  <html>
                  <head>
                  </head>
                  <body style='display: flex;flex-direction: column;align-items: center;gap: 15px text-align:right;'>
                  مرحبًا<h3>$data->F_Name  $data->L_Name,</h3>
                  <p>
                    تم إرسال الطلب الخاص بك 
                      سيتم التواصل معك في اقرب وقت لمراجعة بعض البيانات 
                  </p>
                  <p>فريق الوسيط</p>
                  <a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
                  </body>
                  </html>
                ";
        $email_subject  = 'Alwasit | الوسيط';
        $send_email_obj = new EmailSender($data->email, $email_subject, $mailBody);
        $send_email_obj->sendEmail();
        echo $owner_rquest;
      } else {
        $owner_rquest = 0;
        echo $owner_rquest;
      }
      if (isset($_SESSION['owner']) && $_SESSION['owner'] == 0 && $owner_rquest == 0) {
        echo 0;
        exit;
      }
    }
  endif;
endif;

// echo "<pre>";
// print_r($data);
// echo "</pre>";
// echo "request from here";