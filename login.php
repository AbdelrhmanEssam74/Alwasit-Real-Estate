<?php include 'init.php'; ?>
<?php
$pageTitel = 'تسجيل الدخول';
$login_page = '';
if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
  header("Location:" . $home);
  exit();
}
$email = " ";
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
$duplicate_login = '';
if (isset($_SESSION['duplicate_login']) && $_SESSION['duplicate_login'] == 1) {
  $duplicate_login = $_SESSION['duplicate_login'];
}
$user_id  = '';
if (isset($_SESSION["uID"])) {
  $user_id = $_SESSION['uID'];
}
$not_verified = '';
if (isset($_SESSION['not_verified']) && $_SESSION['not_verified'] == 1) {
  $not_verified = $_SESSION['not_verified'];
}
session_unset();
$_SESSION['HTTP_REFERER'] = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER']  : "";
?>

<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Login Form -->
<?php
if (!empty($duplicate_login)) {
  echo <<< _END
            <div class="alert">
              <div class="overlay"></div>
              <div class="content">
                <p>هذا الحساب مسجل بالفعل
                  <br>
                  تسجيل الخروج من جميع الاجهزة ام الغاء العملية ؟
                </p>
                <div class="btns">
                <button class="cancel" onclick="this.parentElement.parentElement.parentElement.style.display='none';">إلغاء</button>
                <button class="logout" data-uid = "$user_id">تسجيل الخروج </button>
                </div>
                </div>
                </div>
        _END;
}
?>
<?php
if (!empty($not_verified)) {
  echo <<< _END
            <label class='alert-verified'>
            <div class='overlay'></div>
            <div class="alert error">
              <span class="alertText">
                <h4>قم بتأكيد البريد الإلكتروني</h4>
                <p>تتبع هذه الخطوات</p>
                <span> فتح بريدك الإلكتروني </span>
                <br>
                <span> ابحث عن رسالة التأكيد منا</span>
                <br>
                <span> انقر على رابط التأكيد في الرسالة</span>
                <br>
                <a href=""></a>
              </span>
            </div>
          </label>
        _END;
}
?>
<p class='logout_message'>تم تسجيل الخروج بنجاح</p>
<div class="form_box">
  <div class="back_img">
    <div class="form_content">
      <p class="title">مرحباً بكم في <br /><span><strong>الوسيط</strong></span></p>
      <form action="auth/login.php" method="POST" id="form">
        <div class="input-box">
          <input id="email" name="email" type="email" dir="rtl" value="<?php echo $email ?>" placeholder="البريد الالكتروني">
          <i class='bx bxs-envelope'></i>
          <p class="error_message"></p>
        </div>
        <?php
        if (!empty($emailNotFound)) {
          echo "<p class='message'>{$emailNotFound}</p>";
        }
        ?>
        <div class="input-box pass-box">
          <input id="password" name="password" type="password" dir="rtl" placeholder="كلمه المرور ">
          <i class='bx bx-lock-open'></i>
          <i class='bx bx-show-alt ' id="eyeShowPassword"></i>
          <i class='bx bx-hide ' id="eyeHidePassword"></i>
          <p class="error_message"></p>
        </div>
        <?php
        if (!empty($wrongPassword)) {
          echo "<p class='message'>{$wrongPassword}</p>";
        }
        ?>
        <a id="restPass" href="<?php echo $auth ?>rest-password.php?_action=verification">نسيت كلمة السر؟</a>
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