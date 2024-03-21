<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | Alwasit';
$main_page  = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php'
?>
<!-- End Header -->
<!-- Start Landing -->
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
            <div class="property-body">
                <a href="<?php echo $prop_details ?>" class="property-link">
                    <div class="images-details">
                        <img src="<?php echo $images ?>item1.jpg" alt="">
                        <div class="details-top">
                            <div class="details-type">
                                <div class="type1">سكني</div>
                                <div class="rent">للإيجار</div>
                            </div>
                            <div class="favorite-box">
                                <a href='#' title="اضف للمفضلة" class='property-favorite'>
                                    <span class='icon-heart-o'>
                                        <i class="fa-regular fa-heart"></i>
                                    </span>
                                </a>
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
                </a>
            </div>
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
            <div class="number" data-goal="450">0</div>
            <p>عقار للإيجار</p>
        </div>
        <div class="box">
            <i class="fa-solid fa-building"></i>
            <div class="number" data-goal="256">0</div>
            <p>عقار للبيع</p>
        </div>
        <div class="box">
            <i class="fa-solid fa-person"></i>
            <div class="number" data-goal="210">0</div>
            <p>عميل</p>
        </div>
        <div class="box">
            <i class="fa-solid fa-eye"></i>
            <div class="number" data-goal="600">0</div>
            <p>زائر</p>
        </div>
    </div>
</div>
<!-- End stats -->
<?php include $templates . 'footer.php'; ?>