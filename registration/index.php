<?php
session_start();
// check if the phone number is valid or not
$invalid_phone = "";
$Exists_EMAIL = "";
$Exists_Phone = "";
$firstName = "";
$lastName = "";
$email = "";
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
        $firstName = $old_data['FName'];
        $lastName = $old_data['LName'];
        $email = $old_data['email'];
    endif;
    session_unset();
    session_destroy();
endif;

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
    <link rel="stylesheet" href="css/style.css">
    <!-- Reader all elements nomarlly -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font awesome library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Register</title>
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <nav class="navigation">
                <i class="bx bx-menu toggle_menu black" id="menuicon"></i>
                <ul id="menu" class="menu">
                    <li><a href="../تواصل_معنا.html">تواصل معنا</a></li>
                    <li> <a href="#">عنا</a></li>
                    <li> <a href="#">تجاريه</a></li>
                    <li> <a href="#">للطلاب</a></li>
                    <li> <a href="../عقارات_للإيجار.html">للإيجار</a></li>
                    <li> <a href="../عقارات_للبيع.html">للبيع</a></li>
                </ul>
            </nav>
            <a href="../index.html" class="logo"><img src="../images/logo.png" alt="Logo"></a>
        </div>
    </header>
    <!-- End Header -->
    <!-- Start Login Form -->
    <div class="form_box">
        <div class="back_img">
            <div class="form_content">
                <p>مرحباً بكم في <br /><span><strong>الوسيط</strong></span></p>
                <?php
                if (!empty($invalid_phone)) {
                    echo "<p class='message'>{$invalid_phone}</p>";
                } elseif (!empty($Exists_EMAIL)) {
                    echo "<p class='message'>{$Exists_EMAIL}</p>";
                } elseif (!empty($Exists_Phone)) {
                    echo "<p class='message'>{$Exists_Phone}</p>";
                } else {
                    echo '<p class="info">قم بإنشاء حساب جديد للوصول الي خدمات الوسيط</p>';
                }
                ?>
                <form action="../auth/register.php" method="POST" id="form">
                    <div class="input-box-name">
                        <div class="first-name">
                            <input class="name" name="FName" id="firstName" value="<?php echo $firstName ?>" type="text" dir="rtl" placeholder=" الأسم الأول">
                            <i class='bx bx-user'></i>
                            <span class="error_message"></span>
                        </div>
                        <div class="last-name">
                            <input class="name" id="lastName" name="LName" value="<?php echo $lastName ?>" type="text" dir="rtl" placeholder=" الأسم الأخير">
                            <i class='bx bx-user'></i>
                            <span class="error_message"></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <input id="email" type="email" name="email" dir="rtl" value="<?php echo $email ?>" placeholder="البريد الالكتروني">
                        <i class='bx bxs-envelope'></i>
                        <span class="error_message"></span>
                    </div>
                    <div class="input-box">
                        <input id="password" type="password" name="password" dir="rtl" placeholder="كلمه المرور ">
                        <i class='bx bx-lock-open'></i>
                        <i class='bx bx-show-alt eyeShowPassword' id="eyeShowPassword"></i>
                        <i class='bx bx-hide eyeHidePassword' id="eyeHidePassword"></i>

                        <span class="error_message"></span>
                    </div>
                    <div class="input-box">
                        <input id="confirmPassword" type="password" name="confirmPassword" dir="rtl" placeholder="تأكيد كلمه المرور">
                        <i class='bx bx-lock-open'></i>
                        <span class="error_message"></span>

                    </div>
                    <div class="input-box">
                        <input type="tel" dir="rtl" id="phone" name="phone" placeholder="+20">
                        <i class='bx bx-phone-call'></i>
                        <span class="error_message"></span>
                    </div>
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
                    <a href="../login/index.html"> لدى حساب بالفعل </a>
                </form>
            </div>
        </div>
    </div>


    <!-- End Login Form -->
    <script src="js/main.js"></script>
</body>

</html>