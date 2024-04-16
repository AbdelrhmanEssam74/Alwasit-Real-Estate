<?php include 'init.php';
include  $config . 'config.php';
include  $config . 'propertyTable.php';
$DefultPage = '';
if (isset($_SESSION['property_title'])) {
  $pageTitel = $_SESSION['property_title'];
} else {
  $pageTitel = "Query";
}
$prop_details_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<?php
// get property details from database
$property_id = (isset($_GET['PId']) ? $_GET['PId'] : 0);
if ($property_id != 0) :
  // Get Property Details From Database
  $property_obj = new PropertyTable();
  $property_data = $property_obj->getPropertyById($property_id);
  if (empty($property_data)) :
    echo " <div class='invalid-id'>Property Not Found!</div>";
    exit;
  else :
    $fullDescription = $property_data->description;
    $desc = substr($fullDescription, 0, 89);
    // explode the imgs
    $imgs = explode(',', $property_data->img);
  endif;
endif;
?>
<p class="success-message"></p>
<!--start gallery-->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="modal-container-2 overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn login" id="login-comment" for="modal-toggle"></button>
  </div>
</div>
<div class="image-gallery">
  <div class="container">
    <div class="main-image">
      <div>
        <img data-index="1" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[0] ?>" alt="Image 1">
      </div>
    </div>
    <div class="other-images">
      <div> <img data-index="2" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[1] ?>" alt="Image 1"></div>
      <div> <img data-index="3" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[2] ?>" alt="Image 1"></div>
      <div> <img data-index="4" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[3] ?>" alt="Image 1"></div>
      <div> <img data-index="3" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[4] ?>" alt="Image 1"></div>
    </div>
  </div>
  <div class="popup-img">
    <div class="overlay-close"></div>
    <span class="close-popupImg"> <i class="fa fa-close" aria-hidden="true"></i> </span>
    <span class="next"><i class="fa-solid fa-angle-right"></i></span>
    <img data-index="1" src="<?php echo $owner ?>upload/<?php echo $property_data->owner_id ?>/<?php echo $property_data->property_id ?>/<?php echo $imgs[0] ?>" alt="Image 1">
    <span class="prev"><i class="fa-solid fa-angle-left"></i></span>

  </div>
</div>
<!--end gallery-->
<div class="wedge-section">
  <div class="container">
    <div class="left-section">
      <div class="description box">
        <div class="top">
          <div class="share_btns">
            <button class="share" title="مشاركة"><i class='bx bxs-share-alt'></i></button>
            <button class="add_to_fav" title="أضف للمفضلة"><i class="fa-regular fa-heart"></i></button>
          </div>
          <div class="type">
            <p><?php echo $property_data->status ?></p>
            <p><?php echo $property_data->type ?></p>
          </div>
        </div>
        <div class="content">
          <h2>الوصف</h2>
          <p> ...<?php echo $desc ?> </p>
          <button class="show-more" data-full-desc="<?php echo $fullDescription ?>">عرض المزيد</button>
        </div>
      </div>
      <div class="property-details box">
        <h2>تفاصيل العقار</h2>
        <div class="divTable">
          <div class="divTableBody">
            <div class="divTableRow">
              <div class="divTableCell">
                <i class='bx bxs-purchase-tag'></i>
                <p>السعر<span> : <?php echo number_format($property_data->price) ?> جنيه</span></p>
              </div>
              <div class="divTableCell">
                <i class='bx bxs-building'></i>
                <p>حالة العقار <span> : <?php echo $property_data->status ?></span></p>
              </div>
              <div class="divTableCell">
                <i class='bx bxs-building'></i>
                <p>نوع العقار<span> : <?php echo $property_data->type ?></span></p>
              </div>
            </div>
            <div class="divTableRow">
              <div class="divTableCell">
                <i class='bx bx-area'></i>
                <p>المساحة<span> : <?php echo $property_data->area ?> متر مربع</span></p>
              </div>
              <div class="divTableCell">
                <i class='bx bx-bath'></i>
                <p>حمامات<span> : <?php echo $property_data->bath ?></span></p>
              </div>
              <div class="divTableCell">
                <i class='bx bx-bed'></i>
                <p> عدد الغرف<span> : <?php echo $property_data->rooms ?></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="property-location box" data-lat="<?php echo $property_data->latitude ?>" data-lang="<?php echo $property_data->longitude ?>">
        <h2>موقع العقار</h2>
        <div class="loc">
          <?php echo $property_data->address ?> <i class="fa-solid fa-location-dot"></i>
        </div>
        <div id="map"></div>
      </div>
      <div class="comments box">
        <h2>التعليقات</h2>
        <div class="content" data-img-src="<?php echo $images ?>" data-loID="<?php echo (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "" ?>">
        </div>
      </div>
      <div class="comment-form box">
        <h2>اكتب تعليق</h2>
        <div role="form" class="form" id="comment-form">
          <div>
            <input type="text" name="name" id="fullname" class="main-input" placeholder="الأسم" required="required">
          </div>
          <div>
            <input type="email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : " "  ?>" name="email" id="email" class="main-input" placeholder="البريد الإلكتروني" required="required">
          </div>
          <div>
            <textarea name="message" id="comment-content" class="main-input" placeholder="تعليقك" required="required"></textarea>
          </div>
          <button class="send-comment" type="submit" data-propertyID="<?php echo $property_data->property_id ?>" data-userID="<?php echo (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "" ?>" data-ownerID="<?php echo $property_data->owner_id ?>">إرسال</button>
        </div>
      </div>
    </div>
    <div class="right-section">
      <div class="owner box">
        <div class="owner-details">
          <div class="info">
            <h4>User</h4>
            <a href="profile.php?ID="><?php echo $property_data->property_num ?> عقار</a>
          </div>
          <img src="<?php echo $images ?>person1.jpg" alt="">
        </div>
        <div class="connection-links">
          <a class="connection-btn phone-link" data-phone="<?php echo $property_data->phone_num ?>" href="tel:<?php echo $property_data->phone_num ?>">إتصل</a>
          <a class="connection-btn email-link" href="mailto:<?php echo $property_data->email ?>">بريد إلكتروني</a>
          <button onclick="send_handle()" class="connection-btn button-whatsapp" data-phone="<?php echo $property_data->phone_num ?>" data-propertyLink="<?php echo APPURL . $prop_details . "?PId=" .  $property_data->property_id ?>">
            واتس أب
          </button>
        </div>
        <div class="report-links">
          <p id="property">الإبلاغ عن هذا العقار</p>
        </div>
        <div class="report">
          <i class="fa-solid fa-xmark close-report-model"></i>
          <div class="report-property">
          </div>
        </div>
      </div>
      <div class="connectio-with-owner box">
        <p class="title">إرسال عرض خاص بهذا العقار للوسيط</p>
        <div role="form" class="form">
          <input type="text" name="name" class="main-input" placeholder="الأسم">
          <input type="email" name="email" class="main-input" placeholder="البريد الإلكتروني">
          <textarea name="message" class="main-input" placeholder="عرضك"></textarea>
          <button>إرسال</button>
        </div>
      </div>
      <div class="other-proparty box">
        <p class="title">عقارات اخري في نفس المنطقة</p>
        <div>
          <a href="" role="rowgroup">
            <div class="img">
              <img src="<?php echo $images ?>img1.jpg" alt="">
            </div>
            <div class="info">
              <p class="type">شقة | للإيجار</p>
              <p class="price">3000 <span> جنية</span> </p>
              <div class="details">
                <div>
                  <span>متر مربع</span> <span> 150 </span>
                  <i class='bx bx-area'></i>
                </div>
                <div>
                  <span>1</span>
                  <i class='bx bx-bath'></i>
                </div>
                <div>
                  <span>3</span>
                  <i class='bx bx-bed'></i>
                </div>
              </div>
            </div>
          </a>
          <a href="" role="rowgroup">
            <div class="img">
              <img src="<?php echo $images ?>img1.jpg" alt="">
            </div>
            <div class="info">
              <p class="type">شقة | للإيجار</p>
              <p class="price">3000 <span> جنية</span> </p>
              <div class="details">
                <div>
                  <span>متر مربع</span> <span> 90 </span>
                  <i class='bx bx-area'></i>
                </div>
                <div>
                  <span>1</span>
                  <i class='bx bx-bath'></i>
                </div>
                <div>
                  <span>3</span>
                  <i class='bx bx-bed'></i>
                </div>
              </div>
            </div>
          </a>
          <a href="" role="rowgroup">
            <div class="img">
              <img src="<?php echo $images ?>img1.jpg" alt="">
            </div>
            <div class="info">
              <p class="type">شقة | للإيجار</p>
              <p class="price">3000 <span> جنية</span> </p>
              <div class="details">
                <div>
                  <span>متر مربع</span> <span> 90 </span>
                  <i class='bx bx-area'></i>
                </div>
                <div>
                  <span>1</span>
                  <i class='bx bx-bath'></i>
                </div>
                <div>
                  <span>3</span>
                  <i class='bx bx-bed'></i>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include $templates . 'footer.php'; ?>