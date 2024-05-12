<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | تواصل معنا';
$contactus_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Contact -->
<p class="update-message"></p>
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
  </div>
</div>
<div class="modal-container-2 modal-overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn login" id="login-comment" for="modal-toggle"></button>
  </div>
</div>
<section class="background"></section>
<section class="main_section">
  <div class="container">
    <div class="contact">
      <div class="left">
        <div class="contact_img">
          <img src="<?php echo $images ?>Group 114.png" alt="">
        </div>
        <div class="info">
          <div class="box">
            <span><i class="fa-solid fa-envelope"></i></span>
            <a href="mailto:alwasit.real.estate@gmail.com">Alwasit.Real.Estate@gmail.com</a>
          </div>
          <div class="box">
            <span><i class="fa-brands fa-square-facebook"></i></span>
            <a href="https://www.facebook.com" target="_blank">Alwasit.Real.Estate</a>
          </div>
          <div class="box">
            <span><i class="fa-brands fa-linkedin"></i></span>
            <a href="https://www.linkedin.com" target="_blank">Alwasit.Real.Estate</a>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="text">
          <h2>ابق علي تواصل معنا</h2>
          <p>نحن هنا من اجلك ! كيف يمكن أن نساعدك</p>
        </div>
        <div class="content">
          <div role="form" id="form">
            <div class="input-control">
              <input type="text" id="fullName" name="name" class="main-input" value="<?php echo (isset($_SESSION['fullName'])) ? $_SESSION['fullName'] : "" ?>" placeholder="الأسم">
            </div>
            <div class="input-control">
              <input type="email" id="email" name="email" class="main-input" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : "" ?>" placeholder="البريد الإلكتروني">
            </div>
            <div class="input-control">
              <textarea name="message" id="message" class="main-input" placeholder="نحن نستمع إليك"></textarea>
            </div>
            <button class="send-message" type="submit" data-userID="<?php echo (isset($_SESSION['uID'])) ? $_SESSION['uID'] : "" ?>">إرسال</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact -->
<?php include $templates . 'footer.php'; ?>