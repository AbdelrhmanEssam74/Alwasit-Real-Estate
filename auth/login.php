<?php
date_default_timezone_set('Africa/Cairo');
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';
include '../' . $emails_libs . 'index.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("location:../" . $login);
  exit();
}
$email = $_POST['email'];
$password = $_POST['password'];
$userObj = new loginTable();
$row_count = $userObj->checkIfUserExist($email);
$user_id = $userObj->GetUserID();

if ($userObj->checklogin($email)) {
  header("location:../" . $login);
  $_SESSION['duplicate_login'] = true;
  $_SESSION['uID'] = $userObj->GetUserID();
  exit();
}

// Check if user already logged in with "Remember Me" cookie
if (isset($_COOKIE['rem'])) {
  if ($userObj->GetUserToken($user_id)['token'] === $_COOKIE['rem']) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['uID'] = $user_id;
    $_SESSION['email'] = $email;
    header("Location:" . $home);
    exit();
  }
}
// check if user is has owner permission and try to log him in as an owner
if ($userObj->isOwner()) {
  $_SESSION['owner'] = true;
} else {
  $_SESSION['owner'] = false;
}
// // Check if user has an account
if (!$row_count) {
  $_SESSION['notFound'] = "البريد الإلكتروني غير صحيح";
  header("location:../" . $login);
  exit();
}

// // Check if user password is correct
$isPasswordCorrect = $userObj->checkPassword($email, $password);
if ($isPasswordCorrect === false) {
  $_SESSION['wrongPass'] = "كلمة المرور غير صحيحة";
  header("location:../" . $login);
  exit();
}

// Store user login in the database
$user_data = [
  'id' => $user_id,
  'email' => $email,
  'pass' => password_hash($password, PASSWORD_DEFAULT)
];
$insertQuery_user = "INSERT INTO `alwasit`.`login` (user_id, email, Password) 
                    VALUES (:id, :email, :pass)";
$userObj->insert($insertQuery_user, $user_data);

// alert user that he login
$ip = "154.182.109.22"; // Get the IP address of the user
$api_url = "http://ip-api.com/json/{$ip}"; // API endpoint for ip-api.com
// Make a request to the API
$response = file_get_contents($api_url);
// Decode the JSON response
$data = json_decode($response);
// Retrieve the location information
$country = $data->country;
$region = $data->regionName;
$city = $data->city;
$devise = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
$Login_email_subject  = 'تنبيه تسجيل الدخول';
$current_date = date('Y-m-d h:i');
$Login_mailBody = "
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
    <p>نأمل أن تكون بخير. نود أن نبلغك بأنه تم اكتشاف تسجيل دخول على حسابك في Alwasit. نحن نولي أهمية قصوى لأمان حسابك ونرغب في التأكد من أنك على علم بأي نشاط يتعلق بحسابك.</p>
    <h4>تفاصيل التسجيل:</h4>
    <ul>
      <li>التاريخ والوقت: $current_date</li>
      <li>الجهاز : $devise</li>
      <li>الدولة : $country</li>
      <li>المحافظة: $city</li>
      <li>المنطقة: $region</li>
    </ul>
    <p>إذا قمت مؤخرًا بتسجيل الدخول إلى حسابك، يمكنك تجاهل هذا البريد الإلكتروني. ومع ذلك، إذا لم تقم بتسجيل الدخول هذا أنت أو تشتبه في أي وصول غير مصرح به، فإننا نوصي باتخاذ الخطوات التالية لتأمين حسابك:</p>
    <ol>
      <li>تغيير كلمة المرور: قم بزيارة [اسم تطبيق الويب الخاص بك] وانتقل إلى إعدادات حسابك. حدد الخيار لتغيير كلمة المرور وقم بإنشاء كلمة مرور قوية وفريدة وغير قابلة للتخمين.</li>
    </ol>
    <p>نحن ملتزمون بالحفاظ على بيئة آمنة لجميع مستخدمينا، وسنواصل مراقبة حسابك لأي نشاط مشبوه. إذا ك
    نحن ملتزمون بالحفاظ على بيئة آمنة لجميع مستخدمينا، وسنواصل مراقبة حسابك لأي نشاط مشبوه. إذا كان لديك أي أسئلة أو مخاوف، فلا تتردد في الاتصال بفريق الدعم لدينا.</p>
    <p>شكرًا لاستخدامك لخدماتنا وثقتك فينا.</p>
    <p>مع أطيب التحيات،<br>
    فريق</p>
    <h3>Alwasit</h3>
  </div>
</body>
</html>
        ";
$send_login_obj = new EmailSender($email, $Login_email_subject, $Login_mailBody);
// $send_login_obj->sendEmail();
// Check if user wants to login for 1 month (Remember Me)
if (isset($_POST["remember"])) {
  // Generate a secure token 
  $token = bin2hex(random_bytes(16)); // 32-character token
  // store user id in cookie 
  setcookie('u', password_hash($user_id, PASSWORD_DEFAULT), strtotime("+1 month"), "/");
  setcookie("rem", $token, strtotime("+1 month"), '/');
  $expire_date = date("Y-m-d H:i:s", strtotime("+1 month"));

  // Save the token in the database (along with user ID and expiration)
  $data_remember = [
    'id' => $user_id,
    'token' => $token,
    'expire_date' => $expire_date
  ];
  $insertQuery_token = "INSERT INTO `alwasit`.`remember_tokens` (user_id, token, expire_date) 
            VALUES (:id,:token, :expire_date)";
  $userObj->insert($insertQuery_token, $data_remember);
}
// Set login status in session and save the user ID
$_SESSION['loggedIn'] = true;
$_SESSION['uID'] = $user_id;
$_SESSION['email'] = $email;
$_SESSION['fullName'] =  $userObj->GetUserFullName();
// Redirect to the home page
if (isset($_SESSION['HTTP_REFERER']))
  header("Location:" . $_SESSION['HTTP_REFERER']);
else
  header("Location:../" . $home);
exit();
