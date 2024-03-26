<?php include 'init.php'; ?>
<?php
$pageTitel = 'تسجيل الدخول';
$login_page = '';
session_start();
print_r($_SESSION);

if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
    header("Location:" . $home);
    exit();
}
$email  = " ";
(isset($_SESSION['email'])) ? $email = $_SESSION['email'] : $email = "";
?>
<?php
// check if the user is already logged in, if so redirect them to their home page

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

<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Login Form -->
<div class="form_box">
    <div class="back_img">
        <div class="form_content">
            <p class="title">مرحباً بكم في <br /><span><strong>الوسيط</strong></span></p>
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
                    <p class="error_message"></p>
                </div>
                <div class="input-box">
                    <input id="password" name="password" type="password" dir="rtl" placeholder="كلمه المرور ">
                    <i class='bx bx-lock-open'></i>
                    <i class='bx bx-show-alt ' id="eyeShowPassword"></i>
                    <i class='bx bx-hide ' id="eyeHidePassword"></i>
                    <p class="error_message"></p>

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