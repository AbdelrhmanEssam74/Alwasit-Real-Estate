<?php
date_default_timezone_set('Africa/Cairo');
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';

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
// Set login status in session and save the user ID

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
$_SESSION['loggedIn'] = true;
$_SESSION['uID'] = $user_id;
$_SESSION['email'] = $email;
// Redirect to the home page
header("Location:../" . $home);
exit();
