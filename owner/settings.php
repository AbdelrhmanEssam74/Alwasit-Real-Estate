<?php include 'init.php'; ?>
<?php
// get user owner_data
$user_id = isset($_SESSION['uID']) ? $_SESSION['uID'] : 0;
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$stmt->execute();
$owner_data = $stmt->fetch(PDO::FETCH_OBJ);
?>
<?php $pageTitel = "Settings | $owner_data->username "; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<h1 class="p-relative txt-r">الإعدادات</h1>
<div class="settings-page m-20 d-grid gap-20">
  <!-- Start Settings Box -->
  <div class="p-20 bg-white rad-10 d-flex flex-direction-column dir-r">
    <h2 class="mt-0 mb-10">General Info</h2>
    <p class="mt-0 mb-20 c-grey fs-15">General Information About Your Account</p>
    <div class="mb-15">
      <label class="fs-14 c-grey d-block mb-10" for="first">Full Name</label>
      <input class="b-none border-ccc p-10 rad-6 d-block w-full" type="text" value="<?php echo $owner_data->FullName ?>" id="first" placeholder="First Name" />
    </div>
    <div>
      <label class="fs-14 c-grey d-block mb-5" for="email">Email</label>
      <input class="email b-none border-ccc p-10 rad-6 w-full mr-10" id="email" value="<?php echo $owner_data->email ?>" type="email" value="o@nn.sa" disabled />
      <!-- <a class="c-blue" href="#">Change</a> -->
    </div>
    <button style="cursor:pointer;" class=" bg-blue p-10 rad-6 mt-10 b-none c-white ">Save</button>
  </div>
  <!-- End Settings Box -->
  <!-- Start Settings Box -->
  <div class="p-20 bg-white rad-10">
    <h2 class="mt-0 mb-10">Security Info</h2>
    <p class="mt-0 mb-20 c-grey fs-15">Security Information About Your Account</p>
    <div class="sec-box mb-15  flex-direction-column">
      <div>
        <span>Password</span>
      </div>
      <div class="mb-15">
        <label class="fs-14 c-grey d-block mb-10" for="first">Current Password</label>
        <input class="b-none border-ccc p-10 rad-6 d-block w-full" type="password" id="P_first" placeholder="Current Password" />
      </div>
      <div class="mb-15">
        <label class="fs-14 c-grey d-block mb-5" for="last">New Password</label>
        <input class="b-none border-ccc p-10 rad-6 d-block w-full" id="last" type="password" placeholder="New Password" />
      </div>
      <p class="button bg-blue c-white btn-shape w-fit">Save</p>
    </div>
  </div>
  <!-- End Settings Box -->
  <!-- Start Settings Box -->
  <div class="social-boxes p-20 bg-white rad-10">
    <h2 class="mt-0 mb-10">Social Info</h2>
    <p class="mt-0 mb-20 c-grey fs-15">Social Media Information</p>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-facebook-f center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Facebook Link" />
    </div>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-twitter center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Twitter Link" />
    </div>
    <div class="d-flex align-center mb-15">
      <i class="fa-brands fa-linkedin center-flex c-grey"></i>
      <input class="w-full" type="text" placeholder="Linkedin Link" />
    </div>
    <p class="button bg-blue c-white btn-shape w-fit">Save</p>
  </div>
  <!-- End Settings Box -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>