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
                <th scope="col">Request Date</th>
                <th scope="col">Controll</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $conn->prepare('SELECT * FROM users 
                      INNER JOIN onwer_requests ON users.user_id = onwer_requests.user_id
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
                  echo "<button class='ActiveBtn confirm btn btn-primary' data-UID='$row->user_id'type='button'></i>Send</button></td>";
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
    case 'Edit':
      //SECTION -  Logic of Edit Page 
    ?>
      <?php
      $user_id =  (isset($_GET['uID']) && is_numeric($_GET['uID'])) ? intval($_GET['uID'])  : 0;
      $stmt = $conn->prepare("SELECT *  FROM users  WHERE user_id = ?");
      $stmt->execute([$user_id]);
      $row = $stmt->fetchObject();
      $count = $stmt->rowCount();
      if ($count > 0) :
      ?>
        <!-- edit page -->
        <div class="container">
          <h1 class="text-primary-emphasis">Edit User</h1>
          <form class="form-horizontal" action="?action=Update" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user_id ?>" />
            <!-- Start Full Name Field -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Full Name</label>
              <div class="col-sm-10 col-md-6 input-container">
                <input type="text" name="full" value="<?php echo $row->full_name ?>" class="form-control" required="required" />
              </div>
            </div>
            <!-- End Full Name Field -->
            <!-- Start Username Field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10 col-md-6 input-container">
                <input type="text" name="username" class="form-control" value="<?php echo $row->username ?>" autocomplete="off" required="required" />
              </div>
            </div>
            <!-- End Username Field -->
            <!-- Start Password Field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10 col-md-6">
                <input type="hidden" name="oldpassword" value="<?php echo $row->password ?>" />
                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
              </div>
            </div>
            <!-- End Password Field -->
            <!-- Start Email Field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10 col-md-6 input-container">
                <input type="email" name="email" value="<?php echo $row->email ?>" class="form-control" required="required" />
              </div>
            </div>
            <!-- End Email Field -->
            <!-- Start Submit Field -->
            <div class="form-group form-group-lg">
              <div class="col-sm-offset-2 col-sm-10 mt-2">
                <button type="submit" data-UID="<?php echo $row->email ?>" class="btn updateBtn btn-primary btn-lg">Save</button>
              </div>
            </div>
            <!-- End Submit Field -->
          </form>
        </div>
      <?php
      // if there is no user with this id
      else :
        header("Location:users.php?action=Manage");
        exit;
      endif;
      break;
    case 'Update':
      //SECTION -  Update page
      // old version of the update code:
      if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        // variables From The Form
        $id = $_POST['userid'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $full_name = $_POST['full'];

        $pass  = (empty($_POST['newpassword'])) ? $_POST['oldpassword'] : password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        // Validate The Form
        $formErrors = array();
        if (strlen($username) < 4) {
          $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
        }
        if (strlen($username) > 30) {
          $formErrors[] = 'Username Cant Be More Than <strong>30 Characters</strong>';
        }
        if (empty($username)) {
          $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
        }
        if (empty($full_name)) {
          $formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
        }
        if (empty($email)) {
          $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
        }
        // Loop Into Errors Array And Echo It
        foreach ($formErrors as $error) {
          echo <<< _END
                        <div class='alert alert-danger'>$error</div>
                    _END;
        }
        if (empty($formErrors)) :
          // Update The Database With This Info
          $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, full_name = ? , password = ? WHERE user_id = ?");
          $r = $stmt->execute(array($username, $email, $full_name, $pass, $id));
          echo  $stmt->rowCount();
          // Echo Success Message
          header("Location:users.php?action=Manage");
          exit();
        endif;
      else :
        header("Location:users.php?action=Manage");
        exit();
      endif;
      break;
    case 'Add':
      //!SECTION Add New Member page
      ?>
      <div class="container">
        <h1 class="text-primary-emphasis">Add New Member</h1>
        <form class="form-horizontal" action="?action=insert" method="POST" enctype="multipart/form-data">
          <!-- Start Full Name Field -->
          <div class="form-group form-group-lg mb-3">
            <label class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10 col-md-6 input-container">
              <input type="text" name="full" class="form-control" required="required" placeholder="Full Name Appear In Your Profile Page" />
              <?php
              // if full name is blank 
              if (!empty($_SESSION['ErrorFullName']))
                echo "<div class='invalid-input'>" . $_SESSION['ErrorFullName'] . "</div>";
              unset($_SESSION['ErrorFullName']);

              ?>
            </div>
          </div>
          <!-- End Full Name Field -->
          <!-- Start Username Field -->
          <div class="form-group form-group-lg  mb-3">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10 col-md-6 input-container">
              <input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Shop" />
              <?php
              // if user already exists display error message
              if (!empty($_SESSION['UserExist']))
                echo "<div class='invalid-input'>" . $_SESSION['UserExist'] . "</div>";
              unset($_SESSION['UserExist']);

              ?>
              <?php
              // if username less than 4 characters or more than 30 characters or blank
              if (!empty($_SESSION['ErrorUsername']))
                echo "<div class='invalid-input'>" . $_SESSION['ErrorUsername'] . "</div>";
              unset($_SESSION['ErrorUsername']);
              ?>
            </div>
          </div>
          <!-- End Username Field -->
          <!-- Start Password Field -->
          <div class="form-group form-group-lg  mb-3">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10 col-md-6 input-container">
              <input type="password" name="password" class="password form-control" required="required" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" />
              <?php
              // if Password is blank
              if (!empty($_SESSION['ErrorPassword']))
                echo "<div class='invalid-input'>" . $_SESSION['ErrorPassword'] . "</div>";
              unset($_SESSION['ErrorPassword']);
              ?>
              <i class="show-pass fa fa-eye" aria-hidden="true"></i>
            </div>
          </div>
          <!-- End Password Field -->
          <!-- Start Email Field -->
          <div class="form-group   mb-3">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10 col-md-6 input-container">
              <input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid" />
              <?php
              // if Email is blank 
              if (!empty($_SESSION['ErrorEmail'])) {
                echo "<div class='invalid-input'>" . $_SESSION['ErrorEmail'] . "</div>";
              }
              unset($_SESSION['ErrorEmail']);
              ?>
            </div>
          </div>
          <!-- End Email Field -->
          <!-- Start Avatar Field -->
          <!-- <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label input-container">User Avatar</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="file" name="avatar" class="form-control" required="required" />
                        </div>
                    </div> -->
          <!-- End Avatar Field -->
          <!-- Start Submit Field -->
          <div class="form-group form-group-lg mt-2">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Add Member" class="btn btn-primary btn-lg" />
            </div>
          </div>
          <!-- End Submit Field -->
        </form>
      </div>
<?php
      break;
    case 'insert':
      //SECTION - insert page
      if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        // variables From The Form
        $username = $_POST['username'];
        $email = $_POST['email'];
        $full_name = $_POST['full'];
        $pass = $_POST['password'];
        $hash_pass = sha1($pass);
        // Validate The Form
        $formErrors = array();
        if (strlen($username) < 4) {
          $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
          $_SESSION['ErrorUsername'] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
        }
        if (strlen($username) > 30) {
          $formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
          $_SESSION['ErrorUsername'] = 'Username Cant Be More Than <strong>20 Characters</strong>';
        }
        if (empty($username)) {
          $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
          $_SESSION['ErrorUsername'] = 'Username Cant Be <strong>Empty</strong>';
        }
        if (empty($full_name)) {
          $formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
          $_SESSION['ErrorFullName'] = 'Full Name Cant Be <strong>Empty</strong>';
        }
        if (empty($pass)) {
          $formErrors[] = 'Password Cant Be <strong>Empty</strong>';
          $_SESSION['ErrorPassword'] = 'Password Cant Be <strong>Empty</strong>';
        }
        if (empty($email)) {
          $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
          $_SESSION['ErrorEmail'] = 'Email Cant Be <strong>Empty</strong>';
        }
        if (empty($formErrors)) :
          $check = checkItem("username", 'users', $username);
          if ($check) {
            $_SESSION['UserExist'] = 'Sorry This Username Is Exist.';
            header('Location:users.php?action=Add');
            exit();
          } else {
          }
          // Insert Into The Database With This Info
          $stmt = $conn->prepare("INSERT INTO 
                    users(username, password, email, full_name, reg_status , date)
                VALUES(:zuser, :zpass, :zmail, :zname, 1 ,now())");
          $stmt->execute(array(
            'zuser'     => $username,
            'zpass'     => $hash_pass,
            'zmail'     => $email,
            'zname'     => $full_name,
          ));
          if ($stmt->rowCount()) {
            header("Location:users.php?action=Manage");
            exit();
          }
        endif;
      else :
        header("Location:users.php?action=Manage");
        exit();
      endif;
      break;
  endswitch;
}
include $templates . 'footer.php';
