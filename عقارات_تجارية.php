<?php include 'init.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main External Css file -->
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent2.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>footer.css">
    <!-- Reader all elements nomarlly -->
    <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
    <!-- Font awesome library -->
    <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- animate text  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Home</title>
</head>

<body>
    <!-- Button to top -->
    <span class="up"><i class="fa-regular fa-circle-up"></i></span>
    <!-- Start Header -->
    <?php include $templates . 'header.php' ?>
    <!-- End Header -->
    <!-- Start Landing -->
    <div class="langing" style="background-image: url('<?php echo $images ?>item3.jpg');">
        <div class="container">
            <h2 class="landing-title">
                عقارات تجارية في بني سويف
            </h2>
            <!-- start Form -->
            <form action="">
                <div class="check_btn">
                    <label>
                        <input type="radio" class="toggle-radio" name="c" value="1" id="buy" checked>
                        <div class="toggle-buy"></div>
                    </label>
                    <label>
                        <input type="radio" class="toggle-radio" name="c" value="2" id="rent">
                        <div class="toggle-rent"></div>
                    </label>
                </div>
                <div class="search_inputs row">
                    <div class="input_control_search col-6 col-md-2">
                        <input type="text" required name="q" oninput="showSuggestions()" id="searchInput" placeholder="الحي او المنطقة">
                        <p class="no-suggestion-message" id="noSuggestionMessage"></p>
                        <ul class="suggestion-list" id="suggestionList">
                        </ul>
                        <i class='bx bx-search'></i>
                    </div>
                    <div class="select_type col-6 col-md-2">
                        <select name="t" id="propertyTypeSelect">
                            <option value="all">نوع العقار</option>
                            <option value="1">شقة</option>
                            <option value="2">فيلا</option>
                        </select>
                    </div>
                    <div class="select_price col-6 col-md-2">
                        <p class="price_text">السعر</p>
                        <div class="price_input">
                            <div class="input_field">
                                <div class="input_field_min">
                                    <input type="number" name="pmi" placeholder="الحد الادني للسعر" id="minPriceInput">
                                    <ul class="suggestion_min_price">
                                    </ul>
                                </div>
                                <span>-</span>
                                <div class="input_field_max">
                                    <input type="number" name="pmx" placeholder="الحد الاقصي للسعر" id="maxPriceInput">
                                    <ul class="suggestion_max_price">
                                    </ul>
                                </div>
                            </div>
                            <div class="rest_price_input">إعادة ضبط</div>
                        </div>
                    </div>
                    <div class="select_area col-6 col-md-2">
                        <p class="area_text">المساحه <span>(متر مربع)</span></p>
                        <div class="area_input">
                            <div class="input_field">
                                <div class="input_field_min">
                                    <input type="number" name="ami" placeholder="اقل مساحه" id="minAreaInput">
                                    <ul class="suggestion_min_area">
                                    </ul>
                                </div>
                                <span>-</span>
                                <div class="input_field_max">
                                    <input type="number" name="amx" placeholder="اكبر مساحه" id="maxAreaInput">
                                    <ul class="suggestion_max_area">
                                    </ul>
                                </div>
                            </div>
                            <div class="rest_area_input">إعادة ضبط</div>
                        </div>
                    </div>
                    <div class="submit_btn col-6 col-md-2">
                        <button type="submit" value=""><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
    <!-- End Landing -->
    <!-- start design-->
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
            <div class="widgets">
                <div class="property-body">
                    <div class="images-details">
                        <a href="<?php echo $prop_details ?>">
                            <img src="<?php echo $images ?>item1.jpg" alt="">
                        </a>
                        <div class="details-top">
                            <div class="details-type">
                                <div class="type1">تجارية</div>
                                <div class="buy">للبيع</div>
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


    <!-- Start footer -->
    <?php include $templates . 'footer.php' ?>
    <!-- End footer -->