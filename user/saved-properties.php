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
include_once $config . 'propertyTable.php';
// get all user information
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$properties = new PropertyTable;
$properties_saved = $properties->getFavoriteProperties($user_id);
// echo "<pre>";
// print_r($properties_saved);
// echo "</pre>";
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
        <?php
        if (count($properties_saved)) {

          foreach ($properties_saved as $property) :
            $main_img = explode(",", $property->img)[0];
        ?>
            <div class="card">
              <div class="description">
                <h1><?php echo $property->title ?></h1>
                <h2><?php echo $property->city . " | " . $property->neighborhood ?></h2>
                <p> <?php echo $property->description ?></p>
              </div>
              <div class="meta">
                <a class="photo" href="<?php echo $main_link . "/property_details.php?PId=" . $property->property_id ?>">
                  <img src="<?php echo "../owner/upload/" . $property->owner_id . "/" . $property->property_id . "/" .  $main_img ?>" alt="">
                </a>
              </div>
              <i data-uid="<?= $property->fav_user_id  ?>" data-pid="<?= $property->property_id ?>" class='fa-solid fa-trash-can remove-saved'></i>
            </div>
        <?php
          endforeach;
        } else {
          echo "<h2 class='no-query2'>لا يوجد عقارات محفوظة</h2>";
        }
        ?>
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