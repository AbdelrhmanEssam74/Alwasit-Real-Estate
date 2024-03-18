<?php
// user profile image
$img = $images . 'person1.jpg';
$user_id = '';
if (isset($_SESSION['uID'])) {
    $user_id = $_SESSION['uID'];
    # code...
}
?>
<header>
    <div class="container">
        <?php
        if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
            echo <<< _END
                <div class="dropdown"> 
                    <button  class="dropbtn">
                        <img src='$img' alt='Profile Picture'>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#">Edit Profile</a>
                        <a href="$logout?uID=$user_id=">Logout</a>
                    </div>
                </div>
            _END;
        } else {
            if (isset($DefultPage))
                echo <<< _END
            <div class="login">
                <a class="LoginBtn" href='$login'>
                    تسجيل الدخول
                </a>
            </div>
        _END;
        }

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