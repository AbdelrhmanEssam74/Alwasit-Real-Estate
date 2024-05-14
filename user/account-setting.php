<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'Account Setting | Alwasit';
$setting_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<?php
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
// get all user information
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$users_obj = new RegisterTable;
$user_data = $users_obj->getAll($user_id)[0];
?>
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<!-- End Header -->
<div class="setting">
  <p class="success-message"></p>
  <div class="container">
    <div class="parent">
      <div class="">
        <div class="Password-info">
          <h2>تغيير كلمة المرور</h2>
          <p>.لتغيير كلمة مرور حسابك، أدخل كلمة المرور الحالية، ثم أدخل كلمة المرور الجديدة </p>
          <div class="form">
            <label for="profileImage">:كلمة المرور الحالية</label>
            <div class="form-control">
              <input type="password" id="currentpass" name="currentpass" required="required">
              <input type="hidden" id="oldpassword" value="<?php echo $user_data->Password; ?>" name="oldpassword">
              <i class="fa fa-eye show-old-pass" aria-hidden="true"></i>
              <p class="invalid-pass-value"></p>
              <a class="restPass" href="<?php echo $auth ?>rest-password.php?_action=verification">:نسيت كلمة السر</a>
            </div>

            <label for="username">:كلمة المرور الجديدة</label>
            <div class="form-control">
              <input type="password" id="newpassword" name="newpassword" required="required">
              <i class="fa fa-eye show-new-pass" aria-hidden="true"></i>
              <p class="invalid-newpass-value"></p>
            </div>
            <button type="submit" class="pass_info_save_btn" data-UID="<?php echo $user_data->user_id; ?>">Save</button>
          </div>
        </div>
      </div>
      <nva class="sidebar">
        <a href="general-info.php" class="sidebar__list-item ">
          <p> البيانات الشخصية</p>
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="account-setting.php" class="sidebar__list-item is_active">
          <p>إعدادت الحساب</p>
          <i class="fa fa-gear" aria-hidden="true"></i>
        </a>
        <a href="saved-properties.php" class="sidebar__list-item">
          <p>العقارات المحفوظة</p>
          <i class="fa-solid fa-heart"></i>
        </a>
        <a href="contacted-properties.php" class="sidebar__list-item ">
          <p>العقارات المتواصل بخصوصها</p>
          <i class="fa-solid fa-paperclip"></i>
        </a>
      </nva>
    </div>
  </div>
</div>
<script src="<?php echo $js ?>main.js"></script>
</body>

</html>