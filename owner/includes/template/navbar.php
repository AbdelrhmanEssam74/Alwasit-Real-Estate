<?php
$owner_id = $_SESSION['owner_id'];
$stmt2 = $conn->prepare("SELECT * FROM `notifications` WHERE `read_status` = 0 AND `receive_id` = ?");
$stmt2->execute([$owner_id]);
$notifications_num = ($stmt2->rowCount() > 0) ? $stmt2->rowCount() : " ";
?>
<div class="page d-flex">
  <div class="sidebar bg-white p-20 p-relative">
    <h3 class="p-relative txt-c mt-0"><a href="<?php echo APPURL ?>">Alwasit</a></h3>
    <ul>
      <li>
        <a class="sidebar__list-item  d-flex align-center fs-14 c-black rad-6 p-10" href="dashboard.php">
          <i class="fa-regular fa-chart-bar fa-fw"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="settings.php">
          <i class="fa-solid fa-gear fa-fw"></i>
          <span>Settings</span>
        </a>
      </li>
      <!-- <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="profile.php">
          <i class="fa-regular fa-user fa-fw"></i>
          <span>Profile</span>
        </a>
      </li> -->
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="My Properties.php">
          <i class="fa fa-building fa-fw" aria-hidden="true"></i>
          <span>My Properties</span>
        </a>
      </li>
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="Offers.php">
          <i class="fa-solid fa-message fa-fw"></i>
          <span>Offers</span>
        </a>
      </li>
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="create listing.php?action=create">
          <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
          <span>Create Listing</span>
        </a>
      </li>
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="<?php echo $logout ?>">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="content w-full">
    <!-- Start Head -->
    <div class="head bg-white p-15 between-flex">
      <div class="notifications">
        <div class="icon_wrap" data-owerID="<?php echo $owner_id ?>" data-notify="<?php echo $notifications_num ?>">
          <i class="fa-solid fa-bell"></i>
        </div>
        <div id="overloay">
        </div>
        <div class="notification_dd">
          <ul class="notification_ul">
            <?php
            $notifications = $conn->prepare("SELECT * FROM `notifications` WHERE `receive_id` = '$owner_id' ORDER BY `id` DESC");
            $notifications->execute();
            $data = $notifications->fetchAll(PDO::FETCH_OBJ);
            if ($notifications->rowCount() > 0) {
              foreach ($data as $info) :
            ?>
                <li class="starbucks success">
                  <div class="notify_data">
                    <div class="title">
                      <?php echo $info->notification_type ?>
                    </div>
                    <div class="sub_title">
                      <?php echo $info->notification_content ?>
                    </div>
                  </div>
                  <div class="notify_status">
                    <p> <?php echo $info->Timestamp ?></p>
                  </div>
                </li>
            <?php endforeach;
            } ?>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Head -->