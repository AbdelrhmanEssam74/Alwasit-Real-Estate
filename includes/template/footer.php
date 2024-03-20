    <!-- Start Footer -->
    <div class="footer_container">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col">
                        <h4>الوسيط</h4>
                        <ul>
                            <li><a href="<?php echo $about ?>">عنا</a></li>
                            <li><a href="<?php echo $services ?>">خدماتنا</a></li>
                            <li><a href="<?php echo $privacy_policy ?>">سياسة الخصوصية</a></li>
                            <li><a href="login/index.php">إنضم الينا</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>احصل عل المساعده</h4>
                        <ul>
                            <li><a href="<?php echo $instructions ?>">التعليمات</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>تابعنا</h4>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Footer -->
    <?php
    if (isset($prop_details_page)) :
    ?>
        <script src="<?php echo $js ?>property_details.js"></script>
    <?php
    else :
    ?>
        <script src="<?php echo $js ?>contactus.js"></script>
        <script src="<?php echo $js ?>main.js"></script>
        <script src="<?php echo $js ?>rent.js"></script>
    <?php
    endif;
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- propery_details page js links -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFHz-7hKCyzYx2kWfY-S_kSi6Hm8pZ8jk&callback=initMap"></script>
    </body>

    </html>