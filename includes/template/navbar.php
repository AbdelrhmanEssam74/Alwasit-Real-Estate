<?php
// user profile image

$img = $images . 'person1.jpg';
$setting_page = $setting . 'general-info.php';
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
                    <div class="dropMenuContainer">
                      <div id="myDropdown" class="dropdown-content">
                        <button class="checkOwner" >Dashboard</button>
                        <a href="$setting_page">Settings</a> 
                        <a href="$logout">Logout</a>
                      </div>
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
      <?php
      if (isset($contactus_page)) :
      ?>
        <div class="logo"><a href="index.php"><img src="<?php echo $images ?>logo_white.png" alt="Logo"></a></div>
      <?php
      else :
      ?>
        <div class="logo"><a href="index.php"><img src="<?php echo $images ?>logo.png" alt="Logo"></a></div>
      <?php
      endif;
      ?>
    </nav>
  </div>
</header>