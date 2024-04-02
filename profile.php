<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'query';
$profile_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
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
<div class="wedge-section">
  <div class="container">
    <div class="description box">
      <div class="section__info">
        <div class="agent-links">
          <ul class="">
            <div class="section_info_content">
              <h1>FLR Real Estate <span><i class="fa-solid fa-check"></i></span></h1>
              <div>
                <span>15<span> العقارات المتوفرة</span>
              </div>
            </div>
            <li>
              <a href="tel:01028492181" class="link-item">01028492181</a>
              <i class="fa fa-phone" aria-hidden="true"></i>
            </li>
            <li><a class="link-item" href="">Mail.agent@gmail.com</a><i class="fa fa-envelope" aria-hidden="true"></i></li>
            <li> Egypt, Bani-Suef<i class="fa-solid fa-location-dot"></i> </li>
          </ul>
          <img src="ar/images/item3.jpg" alt="">
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
<!-- End widget -->>
<?php include $templates . 'footer.php'; ?>