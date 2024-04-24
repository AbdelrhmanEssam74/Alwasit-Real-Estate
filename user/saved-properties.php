<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'Saved Properties | Alwasit';
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
      <div class="cards">
        <div class="blog-card">
          <div class="description">
            <h1>Learning to Code</h1>
            <h2>Opening a door to the future</h2>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
          </div>
          <div class="meta">
            <a href="">
              <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)">
              </div>
            </a>
          </div>
        </div>
      </div>
      <nva class="sidebar">
        <a href="general-info.php" class="sidebar__list-item">
          <p> البيانات الشخصية</p>
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="account-setting.php" class="sidebar__list-item">
          <p>إعدادت الحساب</p>
          <i class="fa fa-gear" aria-hidden="true"></i>
        </a>
        <a href="saved-properties.php" class="sidebar__list-item is_active">
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