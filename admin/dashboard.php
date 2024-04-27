<?php
ob_start();
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'])) {
  header('Location: index.php');
  exit();
} else {
  $pageTitel = "Dashboard";
  include 'init.php';

  $numUsers = 3; // Number Of Latest Users
  $latestUsers = getLatest("*", "users", "user_id",  $numUsers); // Latest Users Array
  // $numItems = 6; // Number Of Latest Items
  // $latestItems = getLatest("*", 'items', 'Item_ID', $numItems); // Latest Items Array
  // $numComments = 4;
?>
  <!-- start Dashboard -->
  <div class="home-stats">
    <div class="container">
      <h1 class="text-primary-emphasis">Dashboard</h1>
      <div class="row">
        <div class="col-md-3 mb-2">
          <div class="stat st-members">
            <!-- <i class="fa fa-users"></i> -->
            <div class="info">
              Total Members
              <span>
                <a href="users.php?action=Manage-Members"><?php echo countItems('user_id', 'users', "reg_status") ?></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-2">
          <div class="stat st-pending">
            <!-- <i class="fa fa-user-plus"></i> -->
            <div class="info">
              Onwer Request
              <span>
                <a href="users.php?action=Manage&page=Pending"><?php echo checkItem('active', 'onwer_requests', 0) ?></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-2">
          <div class="stat st-items">
            <!-- <i class="fa fa-tag"></i> -->
            <div class="info">
              Total Properties
              <span>
                <a href="users.php?action=Properties"><?php echo checkItem('active', 'properties', 1) ?></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-2">
          <div class="stat st-items">
            <!-- <i class="fa fa-tag"></i> -->
            <div class="info">
              Pending Properties
              <span>
                <a href="users.php?action=Properties&page=Pending"><?php echo checkItem('active', 'properties', 0) ?></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-2">
          <div class="stat st-comments">
            <!-- <i class="fa fa-comments"></i> -->
            <div class="info">
              Total Comments
              <span>

              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="latest">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group latest-users">
                <li class="list-group-item active" aria-current="true">
                  <div class="panel-heading">
                    <i class="fa fa-users"></i>
                    Latest <?php echo $numUsers ?> Registerd Users
                    <span class="toggle-info pull-right">
                      <i class="fa fa-plus fa-lg"></i>
                    </span>
                  </div>
                </li>
                <?php
                if (!empty($latestUsers)) {
                  foreach ($latestUsers as $user) {
                    if ($user->reg_status == 1) :
                      echo <<< _END
                                        <li>
                                            $user->username
                                        </li>
                                        _END;
                    else :
                      continue;
                    endif;
                  }
                } else {
                  echo 'There\'s No Members To Show';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group latest-users">
                <li class="list-group-item active" aria-current="true">
                  <div class="panel-heading">
                    <i class="fa fa-tag"></i> Latest Items
                    <span class="toggle-info pull-right">
                      <i class="fa fa-plus fa-lg"></i>
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Start Latest Comments -->
      <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments"></i>
                            Latest Comments
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div> -->
      <!-- Start Latest Comments -->
    </div>
  </div>
  <!-- end Dashboard -->
<?php include $templates . 'footer.php';
}
ob_end_flush();
?>