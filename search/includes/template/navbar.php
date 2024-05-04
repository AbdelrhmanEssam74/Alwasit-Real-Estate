<?php
$user_id = '';
if (isset($_SESSION['uID'])) {
  $user_id = $_SESSION['uID'];
}
?>
<header>
  <div class="container">
    <?php
    if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) {
    ?>
      <div class="dropdown">
        <button class="dropbtn">
          <img src='<?php echo  $images . 'person1.jpg' ?>' alt='Profile Picture'>
        </button>
        <div class="dropMenuContainer">
          <div id="myDropdown" class="dropdown-content">
            <button class="checkOwner">لوحة التحكم </button>
            <a href="<?php echo $user . 'general-info.php' ?>">البيانات الشخصية</a>
            <a href="<?php echo $logout ?>">تسجيل الخروج</a>
          </div>
        </div>
      </div>
      <div class="favorite_page">
        <a data-saved="" data-uid="<?php echo $user_id ?>" href="<?php echo $user . "saved-properties.php" ?>">
          <i class="fa-regular fa-heart"></i>
        </a>
      </div>
    <?php
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
        <li> <a href="<?php echo $students ?>">مغتربين</a></li>
        <li> <a href="<?php echo $forRent ?>">للإيجار</a></li>
        <li> <a href="<?php echo $forBuy ?>">للبيع</a></li>
      </ul>
      <div class="logo"><a href="<?php echo $home ?>"><img src="<?php echo $images ?>logo.png" alt="Logo"></a></div>
    </nav>
  </div>
</header>