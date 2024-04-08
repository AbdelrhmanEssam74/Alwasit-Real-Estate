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
    case "Properties":
    ?>
      <p class="success-message"></p>
      <div class="container">
        <h1 class="text-primary-emphasis">Manage Properties</h1>
        <div class="table-responsive">

          <table class="table main-table table-bordered">
            <thead>
              <tr>
                <th scope="col">Owner Username</th>
                <th scope="col">Title</th>
                <th scope="col">City</th>
                <th scope="col">Address</th>
                <th scope="col">neighborhood</th>
                <th scope="col">Status</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Area</th>
                <th scope="col">Rooms</th>
                <th scope="col">Baths</th>
                <th scope="col">Building In</th>
                <th scope="col">Comments</th>
                <!-- <th scope="col">Favorates</th> -->
                <th scope="col">Reports</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET['page']) && $_GET['page'] == 'Pending') :
                $stmt = $conn->prepare('SELECT * FROM owners INNER JOIN properties ON owners.owner_id=properties.owner_id WHERE properties.active = 0');
              else :
                $stmt = $conn->prepare('SELECT * FROM owners INNER JOIN properties ON owners.owner_id=properties.owner_id WHERE properties.active = 1');
              endif;
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
              foreach ($rows as $row) {
                $fullDescription = $row->description;
                $desc = substr($fullDescription, 0, 20);
                echo <<< _END
                    <tr id="row_$row->property_id">
                        <td>$row->username</td>
                        <td>$row->title</td>
                        <td>$row->city</td>
                        <td>$row->address</td>
                        <td>$row->neighborhood</td>
                        <td>$row->status</td>
                        <td>$row->type</td>
                        <td>
                            <div class="description">$desc ....</div>
                            <button class="show-more" data-full-desc="$fullDescription">Show More</button>
                        </td>
                        <td>$row->price</td>
                        <td>$row->area m²</td>
                        <td>$row->rooms</td>
                        <td>$row->bath</td>
                        <td>$row->building_in</td>
                        <td>$row->comments_num</td>
                        <td>$row->reports</td>
                _END;
                if ($row->active == 0) {
                  echo <<< _END
                  <td><button class="btn btn-primary  active-prop" data-propID="$row->property_id" data-ownerID="$row->owner_id">Accept</button></td>
                  </tr>
              _END;
                } else
                  echo <<< _END
                        <td><button class="btn btn-danger confirm delete-prop">Delete</button></td>
                        <a href="users.php?action=Properties&page=Pending" class="btn btn-primary">Pending Properties</a>
                    </tr>
                _END;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
<?php
  endswitch;
}
include $templates . 'footer.php';
