<?php
session_start();
date_default_timezone_set('Africa/Cairo');
include '../init.php';
include '../' . $config . 'config.php';
include '../' . $config . 'loginTable.php';

//check if user already logged in

// check if the the request method is post
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("location:../" . $login);
    exit();
}
// check if user has an account
$userObj = new loginTable();
$email = $_POST['email'];
$password = $_POST['password'];
$row_count = $userObj->checkIfUserExist($email);
if (!$row_count) {
    $_SESSION['notFound'] = " البريد الإلكتروني غير صحيح";
    header("location:../" . $login);
    exit();
} else {
    // check if user password is correct
    $isPasswordCorrect = $userObj->checkPassword($email, $password);
    if ($isPasswordCorrect === false) {
        $_SESSION['wrongPass'] = "كلمة المرور غير صحيحه";
        header("location:../" . $login);
        exit();
    } else {
        // check if user want login for 1 month
        if (isset($_POST["remember"])) {
            // Generate a secure token (you can choose any method)
            $token = bin2hex(random_bytes(16)); // 32-character token
            setcookie("rem", $token, strtotime("+1 month"), '/');
            // set login True in session and save the username to be used later
            $_SESSION['loggedIn'] = true;
            $_SESSION['uID'] = $userObj->GetUserID();
            print_r($_SESSION);
            // Save the token in the database (along with user ID and expiration)
        }
    }
}
