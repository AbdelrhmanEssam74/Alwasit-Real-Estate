<?php include_once 'init.php';
$DefultPage = '';
$pageTitel = 'General Info | Alwasit';
$setting_page = '';
?>
<?php include_once $templates . 'header.php' ?>
<!-- Start Header -->
<?php include_once $templates . 'navbar.php' ?>
<?php
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
// get all user information
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$users_obj = new RegisterTable;
$user_data = $users_obj->getAll($user_id)[0];
$_SESSION['full_name'] = $user_data->FullName;
?>
<!-- End Header -->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="setting">
  <p class="update-message"></p>
  <p class="success-message"></p>
  <div class="container">
    <div class="parent">
      <div class="">
        <div class="personal-info">
          <h2>المعلومات الخاصة بك</h2>
          <div class="form">
            <!-- <div class="img-box">
              <img id="imagePreview" src="<?php echo $images ?>person1.jpg" alt="Image preview">
            </div class="form-control">
            <label for="profileImage">Profile Image:</label>
            <div>
              <input type="file" id="newProfileImage" class="custom-file-input" name="newProfileImage" accept="image/*">
              <input type="hidden" class="oldimg" value="<?php echo $images ?>person1.jpg" name="oldProfileImage">
            </div> -->
            <!-- <label for="username">Username:</label>
            <div class="form-control">
              <input type="text" id="username" class="dynamic-input" name="username" value="<?php echo $user_data->username ?>" placeholder="Enter your username" required="required">
              <p class="invalid-username-value">Can't Be Empty</p>
            </div> -->
            <label for="first_name"> :الاسم </label>
            <div class="form-control">
              <input type="text" id="fullname" class="dynamic-input" name="full_name" value="<?php echo $user_data->FullName ?>" placeholder="أدخل الأسم" required="required">
              <p class="invalid-fName-value">أدخل الأسم بالكامل</p>
            </div>
            <button class="personal_info_save_btn" data-UID="<?php echo $user_data->user_id; ?>" type="submit">Save</button>
          </div>
        </div>
        <div class="contact_info">
          <h2>معلومات التواصل الخاصة بك</h2>
          <div class="form">
            <label for="email">:رقم الهاتف المحمول </label>
            <div class="form-control">
              <input type="tel" id="phone_num" class="dynamic-input-phone" name="phone" value="<?php echo $user_data->user_phone ?>" placeholder=" رقم الهاتف" required="required">
              <p class="invalid-num-value"></p>
            </div>
            <label for="email">:البريد الإلكتروني</label>
            <div class="form-control">
              <input type="email" id="email" name="email" disabled value="<?php echo $user_data->email ?>" placeholder="Enter your email">
            </div>
            <button class="contact_info_save_btn" data-UID="<?php echo $user_data->user_id; ?>" type="submit">Save</button>
          </div>
        </div>
      </div>
      <nva class="sidebar">
        <a href="general-info.php" class="sidebar__list-item  is_active">
          <p> البيانات الشخصية</p>
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="account-setting.php" class="sidebar__list-item ">
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