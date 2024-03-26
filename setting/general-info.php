<?php include_once 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | Alwasit';
$setting_page = '';
?>
<?php include_once $templates . 'header.php' ?>
<!-- Start Header -->
<?php include_once $templates . 'navbar.php' ?>
<?php
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
// get all user information
$user_id = (isset ($_SESSION['uID'])) ? $_SESSION['uID'] : 0;
$users_obj = new RegisterTable;
$user_data = $users_obj->getAll($user_id)[0];
?>
<!-- End Header -->
<div class="setting">
    <div class="container">
        <div class="parent">
            <nva class="sidebar">
                <a href="general-info.php" class="sidebar__list-item is_active"> <i class="fa fa-user"
                        aria-hidden="true"></i> General Info</a>
                <a href="account-setting.php" class="sidebar__list-item"> <i class="fa fa-gear" aria-hidden="true"></i>
                    Account Settings </a>
            </nva>
            <div class="">
                <div class="personal-info">
                    <h2>Your Personal Information</h2>
                    <div class="form">
                        <div class="img-box">
                            <img id="imagePreview" src="<?php echo $images ?>person1.jpg" alt="Image preview">
                        </div class="form-control">
                        <label for="profileImage">Profile Image:</label>
                        <div>
                            <input type="file" id="newProfileImage" class="custom-file-input" name="newProfileImage"
                                accept="image/*">
                            <input type="hidden" class="oldimg" value="<?php echo $images ?>person1.jpg"
                                name="oldProfileImage">
                        </div>
                        <label for="username">Username:</label>
                        <div class="form-control">
                            <input type="text" id="username" name="username" value="<?php echo $user_data->username ?>"
                                placeholder="Enter your username" required="required">
                        </div>
                        <div class="full_name">
                            <div class="form-control">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name"
                                    value="<?php echo $user_data->F_Name ?>" placeholder="Enter your first name"
                                    required="required">
                            </div>
                            <div class="form-control">
                                <label for="last_name">Last Name:</label>
                                <input type="text" id="last_name" name="last_name"
                                    value="<?php echo $user_data->L_Name ?>" placeholder="Enter your last name"
                                    required="required">
                            </div>
                        </div>
                        <button class="personal_info_save_btn" data-UID="<?php echo $user_data->user_id; ?>"
                            type="submit">Save</button>
                    </div>
                </div>
                <div class="contact_info">
                    <h2>Your Contact Information</h2>
                    <div class="form">
                        <label for="email">Mobile Number:</label>
                        <div class="form-control">
                            <input type="tel" id="phone" name="phone" value="<?php echo $user_data->user_phone ?>"
                                placeholder="Enter your Mobile Number" required="required">
                        </div>
                        <label for="email">Email:</label>
                        <div class="form-control">
                            <input type="email" id="email" name="email" disabled value="<?php echo $user_data->email ?>"
                                placeholder="Enter your email">
                        </div>
                        <button class="contact_info_save_brn" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $js ?>main.js"></script>
</body>

</html>