<?php include 'init.php'; ?>
<?php
// get user owner_data
$user_id = isset($_SESSION['uID']) ? $_SESSION['uID'] : 0;
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$stmt->execute();
$owner_data = $stmt->fetch(PDO::FETCH_OBJ);
?>
<?php $pageTitel = "Settings | $owner_data->username "; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<p class="update-message"></p>
<h1 class="p-relative txt-r">الإعدادات</h1>
<div class="settings-page m-20 d-grid gap-20">
  <!-- Start Settings Box -->
  <div class="p-20 bg-white rad-10 d-end ">
    <h2 class="mt-0 mb-10 txt-r">المعلومات الخاصة بك</h2>
    <p class="mt-0 mb-20 c-grey fs-15 ">معلومات عامة عن حسابك</p>
    <div class="mb-15 ">
      <label class="fs-14 c-grey d-block mb-10 " for="first">الأسم:</label>
      <input class="dynamic-input b-none border-ccc p-10 rad-6 d-block w-full" type="text" value="<?php echo $owner_data->FullName ?>" id="full-name" placeholder="First Name" />
    </div>
    <div class="mb-15">
      <label class="fs-14 c-grey d-block mb-5" for="email">البريد الإلكتروني:</label>
      <input class="email b-none border-ccc p-10 rad-6 w-full mr-10" id="email" value="<?php echo $owner_data->email ?>" type="email" disabled />
      <a class="c-blue" href="#">Change</a>
    </div>
    <p style="cursor:pointer; transition:0.5s all" data-UID="<?php echo $user_id ?>" data-OID="<?php echo $owner_data->owner_id ?>" class=" button bg-blue b-none c-white btn-shape w-fit save-general-info btn-hover">حفظ</p>
  </div>
  <!-- End Settings Box -->
  <!-- Start Settings Box -->
  <div class="p-20 bg-white rad-10 d-end">
    <h2 class="mt-0 mb-10">تغيير كلمة المرور</h2>
    <p class="mt-0 mb-20 c-grey fs-15">معلومات الأمان حول حسابك</p>
    <div class="sec-box mb-15  flex-direction-column">
      <div>
        <span>كلمة المرور</span>
      </div>
      <div class="mb-15 p-relative">
        <label class="fs-14 c-grey d-block mb-10" for="first">كلمة المرور الحالية</label>
        <input class="b-none border-ccc p-10 rad-6 d-block w-full" type="password" id="current_pass" placeholder="كلمة المرور الحالية" />
        <span class="invalid-c-pass"></span>
        <i class="fa-solid fa-eye show-c-pass p-absolute"></i>
        <a class="restPass" href="<?php echo $auth ?>rest-password.php?_action=verification">نسيت كلمة السر؟</a>
      </div>
      <div class="mb-15 p-relative">
        <label class="fs-14 c-grey d-block mb-5" for="last">كلمة المرور الجديدة</label>
        <input class="b-none border-ccc p-10 rad-6 d-block w-full" id="new_pass" type="password" placeholder="كلمة المرور الجديدة" />
        <span class="invalid-n-pass"></span>
        <i class="fa-solid fa-eye show-n-pass p-absolute"></i>
      </div>
      <button type="submit" data-UID="<?php echo $user_id ?>" data-OID="<?php echo $owner_data->owner_id ?>" class="button bg-blue b-none c-white btn-shape w-fit btn-hover save-security-info">حفظ</button>
    </div>
  </div>
  <!-- End Settings Box -->
  <!-- Start Settings Box -->
  <div class="social-boxes p-20 bg-white rad-10">
    <h2 class="mt-0 mb-10">Social Info</h2>
    <p class="mt-0 mb-20 c-grey fs-15">Social Media Information</p>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-facebook-f center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Facebook Link" />
    </div>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-twitter center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Twitter Link" />
    </div>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-linkedin center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Linkedin Link" />
    </div>
    <p class="button bg-blue c-white btn-shape w-fit">Save</p>
  </div>
  <!-- End Settings Box -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>