<?php include 'init.php';
include  $config . 'config.php';
include $config . 'generalClass.php';
include $config . 'propertyTable.php';
$DefultPage = '';
$profile_page = '';
$owner_id = (isset($_GET['ID'])) ? ($_GET['ID']) : 0;
// get owner from database and display his info
$owner_data = new GeneralClass;
$data = $owner_data->select("SELECT * FROM owners WHERE owner_id='{$owner_id}'")[0];
$pageTitel = $data['full_name'];
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
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
<div class="wedge-section">
  <div class="container">
    <div class="description box">
      <div class="section__info">
        <div class="agent-links">
          <ul class="">
            <div class="section_info_content">
              <h1><?php echo $data['full_name'] ?>
                <?php
                echo ($data['trust_status'] == 1) ? '<span class="trusted"><i class="fa-solid fa-check"></i></span>' : '';
                ?>
              </h1>
              <div>
                <span><?php echo $data['property_num'] ?><span> العقارات المتوفرة</span>
              </div>
            </div>
            <li>
              <a href="tel:01028492181" class="link-item"><?php echo $data['phone_num'] ?></a>
              <i class="fa fa-phone" aria-hidden="true"></i>
            </li>
            <li><a class="link-item" href="mailto:<?php echo $data['email'] ?>"><?php echo $data['email'] ?></a><i class="fa fa-envelope" aria-hidden="true"></i></li>
            <!-- <li> Egypt, Bani-Suef<i class="fa-solid fa-location-dot"></i> </li> -->
          </ul>
          <img src="ar/images/<?php echo $data['owner_img'] ?> " alt="">
        </div>
        <div class="share-btn">
          <button> مشاركة الملف الشخصي <i class="fa fa-share" aria-hidden="true"></i> </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Start widget -->
<div class="widget-container">
  <div class="container">
    <div class="main-heading animate__bounceInLeft">
      <h2 class="heading2">عقارات الوكيل</h2>
    </div>
    <div class="widgets">
      <?php
      // get top 3 properties from database
      $property_obj = new PropertyTable();
      foreach ($property_obj->getALLProperties($owner_id) as $prop) :
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
                <!-- <div class="type1">سكني</div> -->
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
                  <p><?php echo $prop->rooms ?></p>
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
<!-- End widget -->>
<?php include $templates . 'footer.php'; ?>