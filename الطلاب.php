<?php
include 'init.php';
include  $config . 'config.php';
include $config . 'propertyTable.php';
$DefultPage = '';
$pageTitel = 'الوسيط | شقق مفروشة في بني سويف';
$commercial_page = '';
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "";
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Landing -->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="langing" style="background-image: url('<?php echo $images ?>item2.jpg'); object-fit:cover;">
  <div class="container">
    <h2 class="landing-title">
      شقق مفروشة في بني سويف
    </h2>
    <!-- start Form -->
    <!-- End Form -->
  </div>
</div>
<!-- End Landing -->
<!-- start design-->
<p class="success-message"></p>
<div class="modal-container overlay">
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
<div class="sort-by-overlay"></div>
<div class="design">
  <?php
  // get  properties for buy from database
  $property_obj = new PropertyTable();
  $data = $property_obj->getALLPropertiesFurnished();
  ?>
  <div class="container" dir="rtl">
    <div class="text">
      <h2>عقارات مفروشة في بني سويف</h2>
      <p><span><?php echo count($data) ?></span>عقارات اخري </p>
    </div>
    <div class="sort-by">
      <div class="sort_by_btn">ترتيب حسب</div>
      <div class="sort_list">
        <a href="?q=d" data-link="الأحدث">الأحدث</a>
        <a href="?q=pa" data-link="اقل سعر">اقل سعر</a>
        <a href="?q=pd" data-link="اعلي سعر">اعلي سعر</a>
        <a href="?q=aa" data-link="اقل مساحة">اقل مساحة</a>
        <a href="?q=ad" data-link="اكبر مساحة">اكبر مساحة</a>
      </div>
    </div>
  </div>
</div>
<!-- end design-->
<!-- Start widget -->
<div class="widget-container">
  <div class="container">
    <div class="main-heading animate__bounceInLeft">
    </div>
    <div class="widgets">
      <?php
      $itemsPerPage = 6;
      $totalItems = count($data);
      $totalPages = ceil($totalItems / $itemsPerPage);
      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
      $offset = ($currentPage - 1) * $itemsPerPage;
      $data = array_slice($data, $offset, $itemsPerPage);
      $query = (isset($_GET['q'])) ? $_GET['q'] : '';
      switch ($query) {
        case 'd':
          $data = $property_obj->getALLPropertiesFurnished("DESC");
          break;
        case 'pa':
          $data = $property_obj->getALLPropertiesFurnished("ASC", "price");
          break;
        case 'pd':
          $data = $property_obj->getALLPropertiesFurnished("DESC", "price");
          break;
        case 'aa':
          $data = $property_obj->getALLPropertiesFurnished("ASC", "area");
          break;
        case 'ad':
          $data = $property_obj->getALLPropertiesFurnished("DESC", "area");
          break;
        default:
          # code...
          break;
      }
      foreach ($data as $prop) :
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
                <?php
                if ($prop->Furnished) :
                  echo '<div class="Furnished">مفروش</div>';
                endif;
                ?>
                <div class="type1"><?php echo  $prop->type ?></div>
                <div class="rent">للإيجار</div>
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
<!-- // Display pagination links -->
<div class="pagination">
  <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
    <?php if ($page == $currentPage) : ?>
      <span class="current-page"><?php echo $page; ?></span>
    <?php else : ?>
      <a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
    <?php endif; ?>
  <?php endfor; ?>
</div>
<!-- Start Footer -->
<?php include $templates . 'footer.php' ?>
<!-- end Footer -->