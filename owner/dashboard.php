<?php include 'init.php'; ?>
<?php
// get user data
$user_id = isset($_SESSION['uID']) ? $_SESSION['uID'] : 0;
$owner_id = isset($_SESSION['owner_id']) ? $_SESSION['owner_id'] : 0;
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$user_id'");
$stmt->execute();
$owner_data = $stmt->fetch(PDO::FETCH_OBJ);
?>
<?php $pageTitel = "لوحة التحكم | $owner_data->FullName "; ?>
<?php include $templates . 'header.php'; ?>
<?php include $templates . 'navbar.php'; ?>
<h1 class="p-relative txt-r">لوحة التحكم</h1>
<div class="wrapper d-grid gap-20">

  <!-- Start Ticket Widget -->
  <div class="tickets p-20 bg-white rad-10">
    <p class="mt-0 mb-20 c-grey fs-15 txt-r">كل شيء عن العقارات</p>
    <div class="d-flex txt-c gap-20 f-wrap">
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-commenting fa-2x mb-10 c-blue" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5 comments_nums"></span>
        إجمالي آراء الزوار
      </div>
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-home fa-2x mb-10 c-orange" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5"><?php echo getValue('property_num', 'owners',  "owner_id", $owner_id)['property_num']; ?></span>
        إجمالي العقارات
      </div>
      <div class="box p-20 rad-10 fs-13 c-grey">
        <i class="fa fa-heart fa-2x mb-10 c-green" aria-hidden="true"></i>
        <span class="d-block c-black fw-bold fs-25 mb-5"><?php echo countItems('fav_owner_id', 'favorites', $owner_id) ?></span>
        إجمالي العقارات المفضلة
      </div>
    </div>
  </div>
  <!-- End Ticket Widget -->
  <!-- Start Welcome Widget -->
  <div class="welcome bg-white rad-10 txt-c-mobile block-mobile">
    <div class="intro p-20 d-flex space-between bg-eee">
      <img class="hide-mobile" src="ar/images/welcome.png" alt="" />
      <div>
        <h2 class="m-0 txt-r">مرحباً</h2>
        <p class="c-grey mt-5"><?php echo $owner_data->FullName ?></p>
      </div>
    </div>
    <!-- <img src="ar/images/person1.jpg" alt="" class="avatar" /> -->
    <div class="body txt-c d-flex p-20 mt-20 mb-20 block-mobile">
      <div><?php echo getValue('property_num', 'owners', "owner_id", $owner_id)['property_num']; ?><span class="d-block c-grey fs-14 mt-10">العقارات</span></div>
      <div><?php echo ucwords($owner_data->FullName) ?> <span class="d-block c-grey fs-14 mt-10">مالك</span></div>
      <!-- <div>5 <span class="d-block c-grey fs-14 mt-10">Clients</span></div> -->
    </div>
    <!-- <a href="profile.php" class="visit d-block fs-14 bg-blue c-white w-fit btn-shape">Profile</a> -->
  </div>
  <!-- End Welcome Widget -->
  <!-- Start Latest News Widget -->
  <div class="latest-news p-20 bg-white rad-10 txt-c-mobile">
    <h2 class="mt-0 mb-20 txt-r">احدث العقارات المحملة</h2>
    <?php
    $properties = getLatest("*", "properties", "id", 3, "owner_id = " . "'$owner_id' AND deleted = 0");
    foreach ($properties as $property) {
      $imgs = explode(",", $property->img);
      $property_id = $property->property_id;
      $main_img = $imgs[0];
      $title = $property->title . " " . $property->neighborhood;
      $rooms = $property->rooms;
      $uploaded_at = $property->uploaded_at;
      $current_date = new DateTime(); // Current date and time
      $uploaded_date = new DateTime($uploaded_at); // Uploaded date and time
      $diff = $current_date->diff($uploaded_date); // Calculate the difference
      $days_ago = $diff->days; // Get the number of days
    ?>
      <a href="<?php echo $prop_details_page ?>?PId=<?php echo $property_id ?>" class="news-row d-flex align-center">
        <div class="btn-shape bg-eee fs-13 label"><?php echo $days_ago ?> Days Ago</div>
        <div class="info txt-r mr-10">
          <h3 class=""><?php echo $title ?></h3>
          <p class="m-0 fs-14 c-grey"><?php echo $rooms ?> غرف</p>
        </div>
        <img src="<?php echo $upload_dir . $owner_id . '/' . $property_id . '/' . $main_img ?>" alt="" />
      </a>
    <?php
    }
    ?>
  </div>
  <!-- End Latest News Widget -->
  <!-- Start Latest Post Widget -->
  <div class="latest-post p-20 bg-white rad-10 p-relative">
    <h2 class="mt-0 mb-25 txt-r">احدث التعليقات</h2>
    <?php
    $comments = getLatest("*", "comments", "comment_id", 3, "owner_id = " . "'$owner_id'");
    if (sizeof($comments)) :
      foreach ($comments as $comment) {
        $uploaded_at = $comment->timestamp;
        $current_date = new DateTime(); // Current date and time
        $uploaded_date = new DateTime($uploaded_at); // Uploaded date and time
        $diff = $current_date->diff($uploaded_date); // Calculate the difference
        $time_ago = $diff->h; // Get the number of days
        $content = $comment->content;
        // get the user who write the comment
        $user = getValue("*", "users", "user_id", $comment->user_id);
    ?>
        <div class="top d-flex align-center">
          <img class="avatar mr-15" src="<?php echo $images ?>avatar.png" alt="" />
          <div class="info">
            <span class="d-block mb-5 fw-bold"><?php echo ucwords($user['FullName']) ?></span>
            <span class="c-grey">About <?php echo $time_ago ?> Hours Ago</span>
          </div>
        </div>
        <div class="post-content txt-c-mobile pt-20 pb-20 mt-20 mb-20">
          <?php echo $content ?>
        </div>
    <?php
      }
    else :
      echo "<div class='txt-c-mobile c-grey txt-r'>لا يوجد تعليقات</div>";
    endif;
    ?>
  </div>
  <!-- End Latest Post Widget -->
</div>
</div>
</div>
<?php include $templates . 'footer.php'; ?>