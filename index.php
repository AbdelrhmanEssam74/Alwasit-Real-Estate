<?php include 'init.php';
include  $config . 'config.php';
include $config . 'propertyTable.php';
$DefultPage = '';
$pageTitel = 'الوسيط | Alwasit';
$main_page  = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php';
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "";
?>
<!-- End Header -->
<!-- Start Landing -->
<div class="modal-container modal-overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="modal-container-2 modal-overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn login" id="login-comment" for="modal-toggle"></button>
  </div>
</div>
<p class="update-message"></p>
<div class="langing">
  <div class="container">
    <div class="content">
      <h1 id="h2">خاص بمحافظة بني سويف</h1>
      <p id="info">
        شراء او استئجار العقارات <br> بدون عمولة
      </p>
    </div>
    <!-- start Form -->
    <?php include $templates . 'searchform.php' ?>
    <!-- End Form -->
  </div>
</div>
<!-- End Landing -->
<!-- Start widget -->
<div class="widget-container">
  <div class="container">
    <div class="main-heading animate__bounceInLeft">
      <h2 class="heading2">عقارات مميزة</h2>
    </div>
    <div class="widgets">
      <?php
      // get top 3 properties from database
      $property_obj = new PropertyTable();
      foreach ($property_obj->getTopProperties() as $prop) :
        // echo "<pre>";
        // print_r($prop);
        // echo "</pre>";
        $imgs = explode(",", $prop->img);
        $main_img = $imgs[0];
      ?>
        <div class="property-body">
          <div class="images-details">
            <a href="<?php echo $prop_details ?>?PId=<?php echo  $prop->property_id ?>" class="property-link">
              <img class="prop-img" src="<?php echo $owner ?>/upload/<?php echo $prop->owner_id . "/" . $prop->property_id . "/" . $main_img ?>" alt="">
            </a>
            <div class="details-top">
              <div class="details-type">
                <div class="type1"><?php echo  $prop->property_id ?></div>
                <?php
                echo ($prop->status == 'لللإيجار') ? '<div class="rent">للإيجار</div>' : '<div class="buy">للبيع</div>';
                ?>
              </div>
              <div class="favorite-box" data-fav="<?php echo ($prop->property_id == $prop->fav_property_id and $prop->checked == 1 and $prop->fav_user_id == $user_id) ? $prop->checked : 0 ?>" data-PID="<?php echo  $prop->property_id ?>" data-OID="<?php echo  $prop->owner_id ?>" data-UID="<?php echo $user_id ?>">
                <button title="اضف للمفضلة" class=' property-favorite'>
                  <span class='icon-heart-o'>
                    <i class="fa-regular fa-heart"></i>
                  </span>
                </button>
              </div>
            </div>
            <div class="details-bottom">
              <div class="property-details">
                <div class="bath">
                  <p><?php echo $prop->bath ?></p>
                  <i class='bx bx-bath'></i>
                </div>
                <div class="rooms">
                  <p><?php
                      if ($prop->rooms == 0) {
                        echo '+5';
                      } else {
                        echo $prop->rooms;
                      }
                      ?></p>
                  <i class='bx bx-bed'></i>
                </div>
                <div class="area">
                  <p><?php echo $prop->area ?> m<sup>2</sup> </p>
                  <i class='bx bx-layout'></i>
                </div>
              </div>
              <div class="photos">
                <p>5</p>
                <i class="fa-solid fa-camera"></i>
              </div>
            </div>
          </div>
          <div class="proparty-info">
            <div class="location">
              <i class="fa-solid fa-location-dot"></i>
              <p><?php echo $prop->neighborhood ?></p>
            </div>
            <div class="description">
              <p>......<?php echo substr($prop->description, 0, 55) ?></p>
            </div>
            <div class="price">
              <p><?php echo number_format($prop->price) ?> <span>جنيه</span></p>
            </div>
            <hr>
            <div class="owner">
              <a href="profile.php?ID=<?php echo $prop->owner_id ?>">
                <p> : المالك </p>
                <span><?php echo  $prop->full_name ?></span>
              </a>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>
</div>
<!-- End widget -->
<!-- Start Design -->
<div class="design">
  <div class="container">
    <div class="design_img">
      <img src="<?php echo $images ?>item3.jpg" alt="">
    </div>
    <div class="design_content">
      <p>قم بإنشاء حسابك ونشر العقارات الخاصة بك
        للوصول لأكبر عدد من مستخدمي الوسيط</p>
      <a class="LoginBtn" href='<?php echo $login ?>'>
        تسجيل الدخول
      </a>
    </div>
  </div>
</div>
<!-- End Design -->
<!-- start stats -->
<div class="stats" id="stats-section">
  <div class="container">
    <div class="box">
      <i class="fa-solid fa-building"></i>
      <div class="number" id="prop-count-rent" data-goal="">0</div>
      <p>عقار للإيجار</p>
    </div>
    <div class="box">
      <i class="fa-solid fa-building"></i>
      <div class="number" id="prop-count-buy" data-goal="">0</div>
      <p>عقار للبيع</p>
    </div>
    <div class="box">
      <i class="fa-solid fa-person"></i>
      <div class="number" id="clients-count" data-goal="">0</div>
      <p>عميل</p>
    </div>
    <div class="box">
      <i class="fa-solid fa-eye"></i>
      <div class="number" id="visitors" data-goal="">0</div>
      <p>زائر</p>
    </div>
  </div>
</div>
<!-- End stats -->
<?php include $templates . 'footer.php'; ?>