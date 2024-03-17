<header>
    <div class="container">
        <?php
        if (isset($DefultPage))
            echo <<< _END
            <div class="login">
                <a class="LoginBtn" href='$login'>
                    تسجيل الدخول
                </a>
            </div>
        _END;
        ?>
        <nav class="navigation">
            <span id="menuicon"><i class="bx bx-menu toggle_menu black"></i></span>
            <ul id="menu" class="menu">
                <li><a href="<?php echo $contactus ?>">تواصل معنا</a></li>
                <li> <a href="<?php echo $about ?>">عنا</a></li>
                <li> <a href="<?php echo $commercial ?>">تجاريه</a></li>
                <li> <a href="<?php echo $students ?>">للطلاب</a></li>
                <li> <a href="<?php echo $forRent ?>">للإيجار</a></li>
                <li> <a href="<?php echo $forBuy ?>">للبيع</a></li>
            </ul>
        </nav>
        <a href="index.php" class="logo"><img src="<?php echo $images ?>logo.png" alt="Logo"></a>
    </div>
</header>