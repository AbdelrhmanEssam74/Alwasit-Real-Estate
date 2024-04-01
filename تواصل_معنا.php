<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | نواصل معنا';
$contactus_page = '';
?>
<?php include $templates . 'header.php' ?>
<!-- Start Header -->
<?php include $templates . 'navbar.php' ?>
<!-- End Header -->
<!-- Start Contact -->
<div class="modal-container overlay">
  <div class="modal-content">
    <label class="modal-close alert_close" for="modal-toggle">&#x2715;</label>
    <h2></h2>
    <hr />
    <p></p>
    <button class="modal-content-btn send-access-permission " for="modal-toggle"></button>
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
          <form action="">
            <input type="text" name="name" class="main-input" placeholder="الأسم">
            <input type="email" name="email" class="main-input" placeholder="البريد الإلكتروني">
            <textarea name="message" class="main-input" placeholder="نحن نستمع إليك"></textarea>
            <input type="submit" value="إرسال">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact -->
<?php include $templates . 'footer.php'; ?>