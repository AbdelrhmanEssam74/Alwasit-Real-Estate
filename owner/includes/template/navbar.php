<?php
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
      <li>
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="profile.php">
          <i class="fa-regular fa-user fa-fw"></i>
          <span>Profile</span>
        </a>
      </li>
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
        <a class="d-flex sidebar__list-item align-center fs-14 c-black rad-6 p-10" href="create listing.php">
          <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
          <span>Create Listing</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="content w-full">
    <!-- Start Head -->
    <div class="head bg-white p-15 between-flex">
      <div class="search p-relative">
        <input class="p-10" type="search" placeholder="Type A Keyword" />
      </div>
      <div class="icons d-flex align-center">
        <span class="notification p-relative">
          <i class="fa-regular fa-bell fa-lg"></i>
        </span>
        <img src="<?php echo $images ?>avatar.png" alt="" />
      </div>
    </div>
    <!-- End Head -->