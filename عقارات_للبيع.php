<?php include 'init.php';
include  $config . 'config.php';
include $config . 'propertyTable.php';
$DefultPage = '';
$pageTitel = 'الوسيط | شقق للبيع في بني سويف';
$buy_page = '';
$user_id = (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "";
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Landing -->
<div class="langing">
  <div class="container">
    <!-- start Form -->
    <?php include $templates . 'searchform.php' ?>
    <!-- End Form -->
  </div>
</div>
<!-- End Landing -->
<!-- start design-->
<p class="update-message"></p>
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
  <div class="container" dir="rtl">
    <?php
    // get  properties for buy from database
    $property_obj = new PropertyTable();
    $data = $property_obj->getALLPropertiesBuyType("للبيع");
    ?>
    <div class="text">
      <h2>عقارات للبيع في بني سويف</h2>
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
      // get  properties for buy from database
      $itemsPerPage = 6;
      $totalItems = count($data);
      $totalPages = ceil($totalItems / $itemsPerPage);
      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
      $offset = ($currentPage - 1) * $itemsPerPage;
      $query = isset($_GET['q']) ? $_GET['q'] : '';
      switch ($query) {
        case 'd':
          $data = $property_obj->getALLPropertiesBuyType("للبيع", "DESC");
          break;
        case 'pa':
          $data = $property_obj->getALLPropertiesBuyType("للبيع", "ASC", "price");
          break;
        case 'pd':
          $data = $property_obj->getALLPropertiesBuyType("للبيع", "DESC", "price");
          break;
        case 'aa':
          $data = $property_obj->getALLPropertiesBuyType("للبيع", "ASC", "area");
          break;
        case 'ad':
          $data = $property_obj->getALLPropertiesBuyType("للبيع", "DESC", "area");
          break;
        default:
          // No sorting option selected
          break;
      }
      $data = array_slice($data, $offset, $itemsPerPage); // display only 6 items
      // Shuffle the data randomly
      // shuffle($data);
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
                <div class="buy">للبيع</div>
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
  <?php if ($totalPages > 2) : ?>
    <?php if ($currentPage > 1) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $currentPage - 1;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <a href="<?php echo $url; ?>" id="arrow">&lt;</a>
    <?php endif; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $page;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <?php if ($page == $currentPage) : ?>
        <span class="current-page"><?php echo $page; ?></span>
      <?php else : ?>
        <a href="<?php echo $url; ?>"><?php echo $page; ?></a>
      <?php endif; ?>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $currentPage + 1;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <a href="<?php echo $url; ?>" id="arrow">&gt;</a>
    <?php endif; ?>
  <?php else : ?>
    <!-- Display all pages if there are 2 or fewer pages -->
    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
      <?php
      $queryParams = $_GET;
      $queryParams['page'] = $page;
      $url = $_SERVER['REQUEST_URI'];
      $urlParts = parse_url($url);
      $query = isset($urlParts['query']) ? $urlParts['query'] : '';
      parse_str($query, $existingParams);
      $mergedParams = array_merge($existingParams, $queryParams);
      $mergedQuery = http_build_query($mergedParams);
      $url = $urlParts['path'] . '?' . $mergedQuery;
      ?>
      <?php if ($page == $currentPage) : ?>
        <span class="current-page"><?php echo $page; ?></span>
      <?php else : ?>
        <a href="<?php echo $url; ?>"><?php echo $page; ?></a>
      <?php endif; ?>
    <?php endfor; ?>
  <?php endif; ?>
</div>
<?php include $templates . 'footer.php'; ?>