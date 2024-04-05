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
        <div class="icon_wrap" data-notify="5">
          <i class="far fa-bell"></i>
        </div>
        <div class="overlray">
          <div class="notification_dd">
            <ul class="notification_ul">
              <li class="starbucks success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="baskin_robbins failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="mcd success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="pizzahut failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="kfc success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="show_all">
                <p class="link">Show All Activities</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- <div class="profile">
        <div class="icon_wrap">
          <span class="name">John Alex</span>
          <i class="fas fa-chevron-down"></i>
        </div>
        <div class="profile_dd">
          <ul class="profile_ul">
            <li class="profile_li"><a class="profile" href="#"><span class="picon"><i class="fas fa-user-alt"></i>
                </span>Profile</a>
              <div class="btn">My Account</div>
            </li>
            <li><a class="address" href="#"><span class="picon"><i class="fas fa-map-marker"></i></span>Address</a></li>
            <li><a class="settings" href="#"><span class="picon"><i class="fas fa-cog"></i></span>Settings</a></li>
            <li><a class="logout" href="#"><span class="picon"><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
          </ul>
        </div>
      </div> -->
      <div class="popup">
        <div class="shadow"></div>
        <div class="inner_popup">
          <div class="notification_dd">
            <ul class="notification_ul">
              <li class="title">
                <p>All Notifications</p>
                <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
              </li>
              <li class="starbucks success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="baskin_robbins failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="mcd success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
              <li class="pizzahut failed">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Failed</p>
                </div>
              </li>
              <li class="kfc success">
                <div class="notify_icon">
                  <span class="icon"></span>
                </div>
                <div class="notify_data">
                  <div class="title">
                    Lorem, ipsum dolor.
                  </div>
                  <div class="sub_title">
                    Lorem ipsum dolor sit amet consectetur.
                  </div>
                </div>
                <div class="notify_status">
                  <p>Success</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Head -->