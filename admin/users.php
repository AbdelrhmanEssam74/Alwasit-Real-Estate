<?php
session_start();
$pageTitel = 'Users';
if (!(isset($_SESSION['login']) && $_SESSION['login'])) {
  header('Location: index.php');
  exit();
} else {
  include 'init.php';
  $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
  //SECTION -  Manage Users
  switch ($action):
    case 'Manage':
?>
      <p class="success-message"></p>
      <div class="container">
        <h1 class="text-primary-emphasis">Manage Owners Requests</h1>
        <div class="table-responsive">
          <table class="table main-table table-bordered">
            <thead>
              <tr>
                <th scope="col">Owner ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col">Controll</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET['page']) && $_GET['page'] == 'Pending') {
                $stmt = $conn->prepare('SELECT * FROM users INNER JOIN onwer_requests ON users.user_id = onwer_requests.user_id
                              WHERE `active` = 0');
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
                if (empty($rows)) {
                  echo "<div class='alert alert-info'>No Requests</div>";
                } else {
                  foreach ($rows as $row) {;
                    echo <<< _END
                                        <tr id="row_$row->user_id" >
                                        <td scope="row">$row->user_id</td>
                                        <td>$row->F_Name  $row->L_Name</td>
                                        <td>$row->email</td>
                                        <td>$row->username</td>
                                        <td>$row->user_phone</td>
                                        <td>$row->request_date</td>
                                        <td>
                                        <button  class="acceptRequest  btn btn-primary" data-UID="$row->user_id" type='button'>
                                        Accept </button>
                                        <button class="RefuseBtn confirm btn btn-danger" data-UID="$row->user_id" type='button'>Refuse</button>
                                    _END;
                  }
                }
              } else {
                $stmt = $conn->prepare('SELECT * FROM users WHERE `is_owner` = 1');
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
                if (empty($rows)) {
                  echo "<div class='alert alert-info'>No Owners</div>";
                } else {
                  foreach ($rows as $row) {;
                    echo <<< _END
                                        <tr id="row_$row->owner_id" >
                                        <td scope="row">$row->owner_id</td>
                                        <td>$row->F_Name  $row->L_Name</td>
                                        <td>$row->email</td>
                                        <td>$row->username</td>
                                        <td>$row->user_phone</td>
                                        <td>$row->register_data</td>
                                        <td>
                                        <button class="deleteOwner confirm btn btn-danger" data-OID="$row->owner_id" type='button'>Delete</button>
                                    _END;
                  }
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php
      break;
    case 'Manage-Members':
    ?>
      <p class="success-message"></p>
      <div class="container">
        <h1 class="text-primary-emphasis">Manage Members</h1>
        <div class="table-responsive">
          <table class="table main-table table-bordered">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Register Date</th>
                <th scope="col">Active Email</th>
                <th scope="col">Owner ?</th>
                <th scope="col">Controll</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $conn->prepare('SELECT * FROM users WHERE `is_admin` = 0 AND `reg_status` = 1 ');
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
              foreach ($rows as $row) {;
                echo <<< _END
                                    <tr id="row_$row->user_id" >
                                    <td scope="row">$row->user_id</td>
                                    <td>$row->F_Name  $row->L_Name</td>
                                    <td>$row->email</td>
                                    <td>$row->username</td>
                                    <td>$row->user_phone</td>
                                    <td>$row->register_data</td>
                                    <td> 
                      _END;
                if ($row->email_active == 0) {
                  echo "Not Active </td> ";
                } else {
                  echo "Active </td> ";
                }
                if ($row->is_owner == 0) {
                  echo "<td> Not Owner</td> ";
                } else {
                  echo "<td> Owner</td> ";
                }
                echo <<< _END
                                    <td>
                                    <button class="deleteBtn confirm btn btn-danger" data-UID="$row->user_id" type='button'>Delete</button>
                      _END;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
<?php
      break;
  endswitch;
}
include $templates . 'footer.php';
