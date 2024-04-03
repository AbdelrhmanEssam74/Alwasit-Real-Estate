<?php include 'init.php'; ?>
<?php
// get user data
$user_id = isset($_SESSION['uID']) ? $_SESSION['uID'] : 0;
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ);
?>
<?php $pageTitel = "Dashboard | $data->F_Name "; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<h1 class="p-relative">Dashboard</h1>
<div class="wrapper d-grid gap-20">
  <!-- Start Welcome Widget -->
  <div class="welcome bg-white rad-10 txt-c-mobile block-mobile">
    <div class="intro p-20 d-flex space-between bg-eee">
      <div>
        <h2 class="m-0">Welcome</h2>
        <p class="c-grey mt-5"><?php echo $data->username ?></p>
      </div>
      <img class="hide-mobile" src="ar/images/welcome.png" alt="" />
    </div>
    <img src="ar/images/avatar.png" alt="" class="avatar" />
    <div class="body txt-c d-flex p-20 mt-20 mb-20 block-mobile">
      <div><?php echo $data->F_Name . ' ' . $data->L_Name ?> <span class="d-block c-grey fs-14 mt-10">Owner</span></div>
      <div>17 <span class="d-block c-grey fs-14 mt-10">Proparty</span></div>
      <div>5 <span class="d-block c-grey fs-14 mt-10">Clients</span></div>
    </div>
    <a href="profile.html" class="visit d-block fs-14 bg-blue c-white w-fit btn-shape">Profile</a>
  </div>
  <!-- End Welcome Widget -->
  <!-- Start Ticket Widget -->
  <div class="tickets p-20 bg-white rad-10">
    <p class="mt-0 mb-20 c-grey fs-15">Everything About Properties</p>
    <div class="d-flex txt-c gap-20 f-wrap">
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-home fa-2x mb-10 c-orange" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5">17</span>
        All Properties
      </div>
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-commenting fa-2x mb-10 c-blue" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5">14</span>
        Total Visitor Reviews
      </div>
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-heart fa-2x mb-10 c-green" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5">18</span>
        Total Favorites
      </div>
    </div>
  </div>
  <!-- End Ticket Widget -->
  <!-- Start Latest News Widget -->
  <div class="latest-news p-20 bg-white rad-10 txt-c-mobile">
    <h2 class="mt-0 mb-20">Latest properties loaded</h2>
    <a href="<?php echo $prop_details_page ?>?PId=" class="news-row d-flex align-center">
      <img src="<?php echo $images ?>news-01.png" alt="" />
      <div class="info">
        <h3>شقة للبيع حي الرمد</h3>
        <p class="m-0 fs-14 c-grey">3 غرف</p>
      </div>
      <div class="btn-shape bg-eee fs-13 label">3 Days Ago</div>
    </a>
  </div>
  <!-- End Latest News Widget -->
  <!-- Start Latest Post Widget -->
  <div class="latest-post p-20 bg-white rad-10 p-relative">
    <h2 class="mt-0 mb-25">Latest Comment</h2>
    <div class="top d-flex align-center">
      <img class="avatar mr-15" src="<?php echo $images ?>avatar.png" alt="" />
      <div class="info">
        <span class="d-block mb-5 fw-bold">User</span>
        <span class="c-grey">About 3 Hours Ago</span>
      </div>
    </div>
    <div class="post-content txt-c-mobile pt-20 pb-20 mt-20 mb-20">
      You can fool all of the people some of the time, and some of the people all of the time, but you can't
      fool all of the people all of the time.
    </div>
  </div>
  <!-- End Latest Post Widget -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>