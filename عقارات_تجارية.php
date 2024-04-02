<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | عقارات تجارية في بني سويف';
$commercial_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Landing -->
<div class="langing" style="background-image: url('<?php echo $images ?>item3.jpg');">
  <div class="container">
    <h2 class="landing-title">
      عقارات تجارية في بني سويف
    </h2>
    <!-- start Form -->
    <?php  // include $templates . 'searchform.php' ?>
    <!-- End Form -->
  </div>
</div>
<!-- End Landing -->
<!-- start design-->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="design">
  <div class="container" dir="rtl">
    <div class="text">
      <h2>عقارات تجارية في بني سويف</h2>
      <p><span>1,550,00</span>عقارات اخري </p>
    </div>
    <div class="sort-by">
      <div class="sort_by_btn">ترتيب حسب</div>
      <div class="sort_list">
        <a href="#" data-link="متميز">متميز</a>
        <a href="#" data-link="الأحدث">الأحدث</a>
        <a href="#" data-link="اقل سعر">اقل سعر</a>
        <a href="#" data-link="اعلي سعر">اعلي سعر</a>
        <a href="#" data-link="اكبر مساحة">اكبر مساحة</a>
        <a href="#" data-link="اقل مساحة">اقل مساحة</a>
      </div>
    </div>
  </div>
</div>
<!-- end design-->
<!-- Start widget -->
<div class="widget-container">
  <div class="container">
    <div class="main-heading animate__bounceInLeft">
      <h2 class="heading2">عقارات مميزة</h2>
    </div>
    <div class="widgets">
      <div class="property-body">
        <div class="images-details">
          <a href="<?php echo $prop_details ?>" class="property-link">
            <img class="prop-img" src="<?php echo $images ?>item1.jpg" alt="">
          </a>
          <div class="details-top">
            <div class="details-type">
              <div class="type1">سكني</div>
              <div class="rent">للإيجار</div>
            </div>
            <div class="favorite-box">
              <button title="اضف للمفضلة" class='property-favorite'>
                <span class='icon-heart-o'>
                  <i class="fa-regular fa-heart"></i>
                </span>
              </button>
            </div>
          </div>
          <div class="details-bottom">
            <div class="property-details">
              <div class="bath">
                <p>2</p>
                <i class='bx bx-bath'></i>
              </div>
              <div class="rooms">
                <p>4</p>
                <i class='bx bx-bed'></i>
              </div>
              <div class="area">
                <p>200 m<sup>2</sup> </p>
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
            <p>location</p>
          </div>
          <div class="description">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum, quae.</p>
          </div>
          <div class="price">
            <p>3,000 <span>جنيه</span></p>
          </div>
          <hr>
          <div class="owner">
            <a href="">
              <p> : المالك </p>
              <span> ابراهيم عبد الرحمن</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End widget -->
<!-- Start footer -->
<?php include $templates . 'footer.php' ?>
<!-- End footer -->