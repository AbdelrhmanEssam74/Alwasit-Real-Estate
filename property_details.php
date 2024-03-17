<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>property details</title>
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Main External Css file -->
  <link rel="stylesheet" href="<?php echo $css ?>property_details.css">
  <!-- Reader all elements nomarlly -->
  <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
  <!-- Font awesome library -->
  <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- light box gallery -->
  <!-- <link rel="stylesheet" href="css/lightbox.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>

<body>
  <!-- Button to top -->
  <span class="up"><i class="fa-regular fa-circle-up"></i></span>
  <!-- Start Header -->
  <?php include $templates . 'header.php' ?>
  <!-- End Header -->
  <!--start gallery-->
  <div class="image-gallery">
    <div class="container">
      <div class="main-image">
        <div>
          <img data-index="1" src="<?php echo $images ?>img1.jpg" alt="Image 1">
        </div>
      </div>
      <div class="other-images">
        <div> <img data-index="2" src="<?php echo $images ?>img2.jpg" alt="Image 1"></div>
        <div><img data-index="3" src="<?php echo $images ?>img3.jpg" alt="Image 1"></div>
        <div> <img data-index="4" src="<?php echo $images ?>img4.jpg" alt="Image 1"></div>
        <div> <img data-index="5" src="<?php echo $images ?>img5.jpg" alt="Image 1"></div>
      </div>
    </div>
    <div class="popup-img">
      <span class="close"> <i class="fa fa-close" aria-hidden="true"></i> </span>
      <span class="next"><i class="fa-solid fa-angle-right"></i></span>
      <span class="prev"><i class="fa-solid fa-angle-left"></i></span>
      <img src="images/img3.jpg" alt="Image 1">
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
              <p>للبيع</p>
              <p>فيلا</p>
            </div>
          </div>
          <div class="content">
            <h2>الوصف</h2>
            <p>فيلا للبيع المدينة الحي الاول ناصية اولي موقع متميز اول ساكن</p>
          </div>
        </div>
        <div class="property-details box">
          <h2>تفاصيل العقار</h2>
          <div class="divTable">
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCell">
                  <i class='bx bxs-purchase-tag'></i>
                  <p>السعر<span> : 3,000,000</span></p>
                </div>
                <div class="divTableCell">
                  <i class='bx bxs-building'></i>
                  <p>حالة العقار <span> : للبيع</span></p>
                </div>
                <div class="divTableCell">
                  <i class='bx bxs-building'></i>
                  <p>نوع العقار<span> : فيلا</span></p>
                </div>
              </div>
              <div class="divTableRow">
                <div class="divTableCell">
                  <i class='bx bx-area'></i>
                  <p>المساحة<span> : 300 متر مربع</span></p>
                </div>
                <div class="divTableCell">
                  <i class='bx bx-bath'></i>
                  <p>حمامات<span> : 3</span></p>
                </div>
                <div class="divTableCell">
                  <i class='bx bx-bed'></i>
                  <p> عدد الغرف<span> : 4</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="property-location box">
          <h2>موقع العقار</h2>
          <div id="map"></div>
        </div>
        <div class="comments box">
          <h2>التعليقات</h2>
          <div class="content">
            <div class="comment">
              <div class="image">
                <img src="<?php echo $images ?>person1.jpg" alt="">
              </div>
              <div class="details">
                <div class="rate">
                  <h5>user</h5>
                  <div class="starts">
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                  </div>
                </div>
                <p>منزل جميل ورائع جدًا وقريب من كل شيء ! دافئ قليلاً لعطلة نهاية أسبوع حارة
                  ، ولكن أحب أن أعود خلال المواسم الباردة!</p>
              </div>
            </div>
            <div class="comment">
              <div class="image">
                <img src="<?php echo $images ?>person1.jpg" alt="">
              </div>
              <div class="details">
                <div class="rate">
                  <h5>user</h5>
                  <div class="starts">
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                  </div>
                </div>
                <p>منزل جميل ورائع جدًا وقريب من كل شيء ! دافئ قليلاً لعطلة نهاية أسبوع حارة
                  ، ولكن أحب أن أعود خلال المواسم الباردة!</p>
              </div>
            </div>
          </div>
        </div>
        <div class="comment-form box">
          <h2>اكتب تعليق</h2>
          <div class="rate">
            <div class="starts">
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
            <p>تقييمك ؟</p>
          </div>
          <div role="form" class="form">
            <input type="text" name="name" class="main-input" placeholder="الأسم">
            <input type="email" name="email" class="main-input" placeholder="البريد الإلكتروني">
            <textarea name="message" class="main-input" placeholder="تعليقك"></textarea>
            <button>إرسال</button>
          </div>
        </div>
      </div>
      <div class="right-section">
        <div class="owner box">
          <div class="owner-details">
            <div class="info">
              <h4>User</h4>
              <a href="">25 عقار</a>
            </div>
            <img src="<?php echo $images ?>person1.jpg" alt="">
          </div>
          <div class="connection-links">
            <a class="connection-btn phone-link" data-phone="+201028492181" href="tel:+201007816670">إتصل</a>
            <a class="connection-btn email-link" href="mailto:abdelrhmanroshdy8@gmail.com">بريد إلكتروني</a>
            <button onclick="send_handle()" class="connection-btn button-whatsapp" data-phone="+201028492181" data-propertyLink="">
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