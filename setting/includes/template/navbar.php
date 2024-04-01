<header>
  <div class="container">
    <?php
    if ((isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) || isset($_COOKIE['rem'])) :
    ?>
      <div class="dropdown">
        <button class="dropbtn">
          <img src='<?php echo $images ?>person1.jpg' alt='Profile Picture'>
        </button>
        <div class="dropMenuContainer">
          <div id="myDropdown" class="dropdown-content">
            <button class="checkOwner">Dashboard</button>
            <a href="<?php echo $setting_page ?>">Settings</a>
            <a href="<?php echo $auth ?>logout.php">Logout</a>
          </div>
        </div>
      </div>
    <?php
    else :
      if (isset($DefultPage))
    ?>
      <div class="login">
        <a class="LoginBtn" href='$login'>
          تسجيل الدخول
        </a>
      </div>
    <?php
  endif;
    ?>
    <nav class="navigation">
      <span id="menuicon"><i class="bx bx-menu toggle_menu black"></i></span>
      <ul id="menu" class="menu">
        <li><a href="<?php echo $main_link ?>تواصل_معنا.php ">تواصل معنا</a></li>
        <li> <a href="<?php echo $main_link ?>عنا.php">عنا</a></li>
        <li> <a href="<?php echo $main_link ?>عقارات_تجارية.php">تجاريه</a></li>
        <li> <a href="<?php echo $main_link ?>الطلاب.php">للطلاب</a></li>
        <li> <a href="<?php echo $main_link ?>عقارات_للإيجار.php">للإيجار</a></li>
        <li> <a href="<?php echo $main_link ?>عقارات_للبيع.php">للبيع</a></li>
      </ul>
      <div class="logo"><a href="<?php echo $main_link ?>index.php"><img src="<?php echo $images ?>logo.png" alt="Logo"></a></div>
    </nav>
  </div>
</header>