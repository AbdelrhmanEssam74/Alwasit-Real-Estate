<?php include 'init.php'; ?>
<?php
session_start();
$register_page = '';
$pageTitel = 'انشاء حساب جديد';
if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
    header("Location:" . $home);
    exit();
}
// check if the phone number is valid or not
$invalid_phone = "";
$Exists_EMAIL = "";
$Exists_Phone = "";
$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$old_data = [];
if (isset($_SESSION)) :
    if (isset($_SESSION['Invalid_PHONE'])) :
        $invalid_phone = $_SESSION['Invalid_PHONE'];
    endif;
    if (isset($_SESSION['Exists_EMAIL'])) :
        $Exists_EMAIL = $_SESSION['Exists_EMAIL'];
    endif;
    if (isset($_SESSION['Exists_Phone'])) :
        $Exists_Phone = $_SESSION['Exists_Phone'];
    endif;
    if (isset($_SESSION['old_data'])) :
        $old_data = json_decode($_SESSION['old_data'], true);
        $old_data = $old_data[0];
        $firstName = $old_data['FName'];
        $lastName = $old_data['LName'];
        $email = $old_data['email'];
        $phone = $old_data['phone'];
    endif;
    session_unset();
    session_destroy();


endif;
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
            <p class="info">قم بإنشاء حساب جديد للوصول الي خدمات الوسيط</p>
            <form action="<?php echo $auth . 'register.php' ?>" method="POST" id="form">
                <div class="input-box-name">
                    <div class="first-name">
                        <input class="name" name="FName" id="firstName" value="<?php echo $firstName ?>" type="text" dir="rtl" placeholder=" الأسم الأول">
                        <i class='bx bx-user'></i>
                        <p class="error_message"></p>
                    </div>
                    <div class="last-name">
                        <input class="name" id="lastName" name="LName" value="<?php echo $lastName ?>" type="text" dir="rtl" placeholder=" الأسم الأخير">
                        <i class='bx bx-user'></i>
                        <p class="error_message"></p>
                    </div>
                </div>
                <div class="input-box">
                    <input id="email" type="email" name="email" dir="rtl" value="<?php echo $email ?>" placeholder="البريد الالكتروني">
                    <i class='bx bxs-envelope'></i>
                    <p class="error_message"></p>
                </div>
                <?php
                if (!empty($Exists_EMAIL)) {
                    echo "<p class='message'>{$Exists_EMAIL}</p>";
                }
                ?>
                <div class="input-box">
                    <input id="password" type="password" name="password" dir="rtl" placeholder="كلمه المرور ">
                    <i class='bx bx-lock-open'></i>

                    <i class='bx bx-show-alt eyeShowPassword' id="eyeShowPassword"></i>
                    <i class='bx bx-hide eyeHidePassword' id="eyeHidePassword"></i>

                    <p class="error_message"></p>
                </div>
                <div class="input-box">
                    <input id="confirmPassword" type="password" name="confirmPassword" dir="rtl" placeholder="تأكيد كلمه المرور">
                    <i class='bx bx-lock-open'></i>
                    <p class="error_message"></p>

                </div>
                <div class="input-box">
                    <input type="tel" dir="rtl" id="phone" value="<?php echo $phone ?>" name="phone" placeholder="+20">
                    <i class='bx bx-phone-call'></i>
                    <p class="error_message"></p>
                </div>
                <?php
                if (!empty($invalid_phone)) {
                    echo "<p class='message'>{$invalid_phone}</p>";
                }
                if (!empty($Exists_Phone)) {
                    echo "<p class='message'>{$Exists_Phone}</p>";
                }
                ?>
                <div class="Note">
                    <ul dir="rtl">
                        <li>
                            يفضل رقم يستخدم الوتس اب
                        </li>
                        <i class='bx bxs-circle'></i>
                    </ul>
                </div>
                <div class="submit_btn">
                    <input value="إنشاء حساب" id="submit" class="BTN_submit" name="submit" type="submit">
                </div>
                <a href="<?php echo $login ?>"> لدى حساب بالفعل </a>
            </form>
        </div>
    </div>
</div>


<!-- End Login Form -->
<script src="<?php echo $js ?>register.js"></script>
</body>

</html>