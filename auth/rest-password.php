<?php
date_default_timezone_set('Africa/Cairo');
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';
include '../' . $config . 'usersTable.php';
include '../' . $libs . 'emails/index.php';
$email_from_post = "";
$action = $_GET['_action'];
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
$full_name = (isset($_SESSION['full_name'])) ? $_SESSION['full_name'] : "";
switch ($action) {
  case 'verification':
    //SECTION -  VERIFICATION EMAIL Form
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email Address Verification</title>
      <style>
        body {
          font-family: 'Cairo';
          background-color: #f9f9f9;
          margin: 0;
          padding: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
        }

        .container form {
          background-color: #ffffff;
          border-radius: 10px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          padding: 20px;
          text-align: center;
          display: flex;
          flex-direction: column;
          width: 300px;
          align-items: center;
          gap: 15px;
        }

        p {
          text-align: center;
          background-color: #ff4d4d;
          width: 100%;
          font-size: 18px;
          color: #fff;
          padding: 15px 0px;
          border-radius: 5px;
        }

        label {
          font-weight: bold;
          display: block;
        }

        input[type="email"] {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          text-align: right;
          font-size: 15px;
          outline: none;
        }

        .button {
          display: inline-block;
          padding: 10px 20px;
          background-color: #007bff;
          color: #fff;
          text-decoration: none;
          border-radius: 5px;
          transition: background-color 0.3s ease;
          border: none;
          cursor: pointer;
        }

        .button:hover {
          background-color: #0056b3;
        }
      </style>
    </head>

    <body>
      <div class="container">
        <?php
        if (isset($_SESSION['email_not_found'])) {
          echo "<p> {$_SESSION['email_not_found']} </p>";
          unset($_SESSION['email_not_found']);
        }
        ?>
        <form method="POST" action="?_action=Verified">
          <label for="email"> أدخل البريد الإلكتروني الخاص بك</label>
          <input type="email" id="email" name="email" placeholder="أدخل البريد الالكتروني">
          <button type="submit" class="button">إرسال إيميل</button>
        </form>
      </div>
    </body>

    </html>
  <?php
    break;
  case 'Verified':
    $email_from_post = $_POST['email'];
    $userObj = new loginTable();
    $row_count = $userObj->checkIfUserExist($email_from_post);
    if ($row_count) :
      $_SESSION['newEmial'] = $email_from_post;
      $token = bin2hex(random_bytes(32)); // Generate a 32-character random token
      $expiryTime = date('Y-m-d H:i:s', strtotime('+12 hour'));
      $_SESSION['privacy_token'] = $token; // Store the generated token in session for later comparison
      $_SESSION['expiryTime'] = $expiryTime; // Store the expiration time of this token
      $mailBody = "
      <!DOCTYPE html>
      <html>
      <head>
      </head>
      <body style='display: flex;flex-direction: column;align-items: center;gap: 15px;'>
      مرحبًا  <h3>$full_name</h3>
      <p>
      يمكن إعادة تعيين كلمة المرور الخاصة بك عن طريق النقر على الزر أدناه. إذا لم تكن قد طلبت كلمة مرور جديدة، يرجى تجاهل هذا البريد الإلكتروني
      </p>
      <a style='display: inline-block;padding: 10px 20px;background-color: #007BFF;color: #fff;text-decoration: none;border-radius: 5px;transition: background-color 0.3s ease;' href='http://localhost/Alwasit/auth/rest-password.php?token=$token&_action=check-token'>
      Change Password
      </a>
      <p>هذا الايميل صالح لمدة 12 ساعه فقط</p>
      <p>فريق الوسيط</p>
      <a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
      </body>
      </html>
      ";
      $email_subject  = 'هذا طلب إعادة تعيين كلمة المرور لـ الوسيط';
      $send_email_obj = new EmailSender($email_from_post, $email_subject, $mailBody);
      $send_email_obj->sendEmail();
    else :
      $_SESSION['email_not_found'] = "لا يوجد حساب بهذا البريد الالكتروني";
      header("location: " . $_SERVER["HTTP_REFERER"]);
    endif;
  ?>
    <!DOCTYPE html>
    <html lang='ar'>

    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <style>
        body {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
          background-color: #f0f0f0;
        }

        .confirmation-box {
          padding: 20px;
          border: 2px solid #333;
          border-radius: 10px;
          background-color: #fff;
          text-align: center;
          font-size: 18px;
          font-family: Arial, sans-serif;
          line-height: 1.5;
        }
      </style>
    </head>

    <body>
      <div class='confirmation-box'>
        <p>تم إرسال ايميل الي بريدك الإلكتروني <br>
          برجاء فحص البريدك الإلكتروني </p>
        <a href="?_action=verification" class="button">إعادة ارسال</a>
      </div>
    </body>

    </html>
  <?php
    break;
  case 'check-token':
    $url_token = $_GET['token'];
    $storage_token = $_SESSION['privacy_token'];
    $storage_expiryTime = $_SESSION['expiryTime'];
    $current_date = date("Y-m-d H:i:s");
    //NOTE - check if the current time is less than expiry time from session data
    if ($storage_expiryTime > $current_date) :
      //NOTE - chekc if the storage token is valid or not
      if ($url_token === $storage_token) :
        header("Location:?_action=set-new-password");
        exit();
      endif;
    endif;
    break;
  case 'set-new-password':
    //SECTION - Form Input New Password
  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <title>Change Your Password</title>
      <style>
        body {
          font-family: 'Cairo';
          background-color: #f9f9f9;
          margin: 0;
          padding: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
        }

        .container {
          background-color: #ffffff;
          border-radius: 10px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          padding: 20px;
          text-align: center;
          display: flex;
          flex-direction: column;
          width: 300px;
          align-items: center;
          gap: 15px;
        }

        label {
          font-weight: bold;
          display: block;
        }

        .form-control {
          width: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
          position: relative;
          flex-direction: column;
        }

        .asterisk {
          position: absolute;
          font-size: 25px;
          color: rgb(255, 51, 51);
          top: 5%;
          left: 10%;
        }

        .invalid-input {
          margin-top: -3px;
          margin-bottom: -5px;
          font-size: 12px;
          text-align: right;
          width: 100%;
          position: relative;
          color: rgb(255, 51, 51);
          display: none;
          ;
        }

        svg {
          font-size: 15px;
          position: absolute;
          left: 0;
          cursor: pointer;
        }

        .invalid-input.show {
          display: block;
        }

        .invalid-input::before {
          position: absolute;
          content: "*";
          right: -5%;
          top: -20%;
          font-size: 25px;
          color: rgb(255, 51, 51);
        }

        input {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          outline: none;
          text-align: right;
          font-size: 20px;
        }

        input::placeholder {
          text-align: right;
          font-size: 15px;
        }

        button {
          display: inline-block;
          cursor: pointer;
          padding: 10px 20px;
          background-color: #007bff;
          color: #fff;
          text-decoration: none;
          border-radius: 5px;
          transition: background-color 0.3s ease;
          outline: none;
          border: none;
        }

        button:hover {
          background-color: #0056b3;
        }
      </style>
    </head>

    <body>
      <form class="container" method="POST" action="?_action=update-password">
        <label for="password"> أدخل كلمة المرور الجديدة </label>
        <div class="form-control">
          <input type="password" autocomplete="new-password" class="password" id="password" name="password" placeholder=" أدخل كلمة المرور الجديدة" required="required">
          <p class="invalid-input">كلمة المرور يجب أن تحتوي على الأقل 8 أحرف</p>
          <i class="fa fa-eye show-pass" aria-hidden="true"></i>
        </div>
        <div class="form-control">
          <input type="password" autocomplete="new-password" class="password" id="confirm_password" name="confirm_password" placeholder="أعد إدخل كلمة المرور الجديدة" required="required">
          <p class="invalid-input">كلمة المرور وتأكيد كلمة المرور غير متطابقين</p>
          <i class="fa fa-eye show-pass" aria-hidden="true"></i>
        </div>
        <button class="update-button" type="submit">حفظ</button>
      </form>
    </body>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery Validation plugin -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
      $(document).ready(function() {
        "use strict";
        $('.container').submit(function(event) {
          var password = $('#password').val();
          var confirm_password = $('#confirm_password').val();

          if (password.length < 8) {
            $('.invalid-input').addClass('show');
            event.preventDefault(); // Prevent form submission
          } else if (password !== confirm_password) {
            $('.invalid-input').addClass('show');
            event.preventDefault(); // Prevent form submission
          }
        });
        //NOTE - Hide Placeholder On Form focus
        $("[placeholder]")
          .focus(function() {
            $($(this).attr("data-text", $(this).attr("placeholder")));
            $(this).attr("placeholder", " ");
          })
          .blur(function() {
            $(this).attr("placeholder", $(this).attr("data-text"));
          });
        // Add Asterisk On Required Field
        $("input").each(function() {
          if ($(this).attr("required") === "required") {
            $(this).after('<span class="asterisk">*</span>');
          }
        });
        // convert password field to text when hover on eye icon
        let passwordInput = $('.password');
        let show_pass = $('.show-pass');
        show_pass.hover(function() {
          passwordInput.attr('type', 'text');
        }, function() {
          passwordInput.attr('type', 'password');
        });
      });
    </script>

    </html>
<?php
    break;
  case 'update-password':
    $password = $_POST['password'];
    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : $_SESSION['newEmial'];
    $data = [
      password_hash($password, PASSWORD_DEFAULT),
      $email
    ];
    $user_obj = new RegisterTable;
    $login_obj = new loginTable;
    if (isset($_SESSION['loggedIn']))
      $update_query_login = "UPDATE `login` SET `Password` = ? WHERE `email` = ?";
    $update_query_users = "UPDATE `users` SET `Password` = ? WHERE `email` = ?";
    $current_date = date("Y-m-d h:i:s");
    if ($user_obj->update($update_query_users, $data)) :
      $mailBody = "
      <!DOCTYPE html>
      <html>
      <head>
      </head>
      <body style='display: flex;flex-direction: column;align-items: center;gap: 15px;'>
      مرحبًا  <h3>$full_name</h3>
      <p>
      تم تحديث كلمة المرور بنجاح
      تاريخ العملية : $current_date 
      </p>
      <p>فريق الوسيط</p>
      <a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
      </body>
      </html>
      ";
      $email_subject  = '  إعادة تعيين كلمة المرور لـ الوسيط';
      $send_email_obj = new EmailSender($email, $email_subject, $mailBody);
      $send_email_obj->sendEmail();
      header("Location:" . APPURL . "login.php");
      exit();
    endif;
    break;
  default:
    echo "  
    <div style='margin:-8px;font-size: 25px;font-family:Cairo;color: #fff; background-color: rgb(95 129 255);padding:10px;'>403 : Can't Access This Page</div>";
    break;
}
