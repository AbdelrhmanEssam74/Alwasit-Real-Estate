<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | شقق للطلاب في بني سويف';
$commercial_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Landing -->
<div class="langing" style="background-image: url('<?php echo $images ?>item2.jpg');">
    <div class="container">
        <h2 class="landing-title">
            شقق للطلاب في بني سويف
        </h2>
        <!-- start Form -->
        <?php //include $templates . 'searchform.php' 
        ?>
        <!-- End Form -->
    </div>
</div>
<!-- End Landing -->
<!-- start design-->
<div class="design">
    <div class="container" dir="rtl">
        <div class="text">
            <h2>شقق للطلاب في بني سويف</h2>
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
        <div class="widgets">
            <div class="property-body">
                <div class="images-details">
                    <a href="<?php echo $prop_details ?>">
                        <img src="<?php echo $images ?>item1.jpg" alt="">
                    </a>
                    <div class="details-top">
                        <div class="details-type">
                            <div class="type1">مفروش</div>
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
                        <p>1,550,00 <span>جنيه</span></p>
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

<!-- Start Footer -->
<?php include $templates . 'footer.php' ?>
<!-- end Footer -->