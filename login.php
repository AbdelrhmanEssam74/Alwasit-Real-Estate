<?php include 'init.php'; ?>
<?php
session_start();
$email  = " ";
(isset($_SESSION['email'])) ? $email = $_SESSION['email'] : $email = "";
?>
<?php
// check if the user is already logged in, if so redirect them to their home page

if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
    header("Location:" . $home);
    exit();
}

$emailNotFound = '';
if (isset($_SESSION['notFound'])) {
    $emailNotFound = $_SESSION['notFound'];
}
$wrongPassword = '';
if (isset($_SESSION['wrongPass'])) {
    $wrongPassword = $_SESSION['wrongPass'];
}
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- Main External Css file -->
    <link rel="stylesheet" href="<?php echo $css ?>login.css">
    <!-- Reader all elements nomarlly -->
    <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
    <!-- Font awesome library -->
    <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Login Page</title>
</head>

<body>
    <!-- Start Header -->
    <?php include $templates . 'header.php' ?>
    <!-- End Header -->
    <!-- Start Login Form -->
    <div class="form_box">
        <div class="back_img">
            <div class="form_content">
                <p>مرحباً بكم في <br /><span><strong>الوسيط</strong></span></p>
                <?php

                if (!empty($emailNotFound)) {
                    echo "<p class='message'>{$emailNotFound}</p>";
                }
                if (!empty($wrongPassword)) {
                    echo "<p class='message'>{$wrongPassword}</p>";
                }
                ?>
                <form action="auth/login.php" method="POST" id="form">
                    <div class="input-box">
                        <input id="email" name="email" type="email" dir="rtl" value="<?php echo $email ?>" placeholder="البريد الالكتروني">
                        <i class='bx bxs-envelope'></i>
                        <span class="error_message"></span>
                    </div>
                    <div class="input-box">
                        <input id="password" name="password" type="password" dir="rtl" placeholder="كلمه المرور ">
                        <i class='bx bx-lock-open'></i>
                        <i class='bx bx-show-alt ' id="eyeShowPassword"></i>
                        <i class='bx bx-hide ' id="eyeHidePassword"></i>
                        <span class="error_message"></span>

                    </div>

                    <div class="check-box">
                        <label dir="rtl" for="LoginForMonth">تسجيل الدخول لمده شهر</label>
                        <input class="checkbox" name="remember" id="LoginForMonth" type="checkbox">
                    </div>
                    <div class="submit_btn">
                        <button id="submit" class="btn2" name="submit" type="submit">تسجيل الدخول</button>
                    </div>
                    <a href="<?php echo $register ?>">انشاء حساب جديد</a>
                </form>
            </div>
        </div>
    </div>


    <!-- End Login Form -->
    <script src="<?php echo $js ?>login.js"></script>
</body>

</html>