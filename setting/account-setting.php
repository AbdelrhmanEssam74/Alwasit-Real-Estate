<?php include 'init.php';
$DefultPage = '';
$pageTitel = 'الوسيط | Alwasit';
$setting_page  = '';
?>
<?php include  $templates . 'header.php' ?>
<!-- Start Header -->
<?php include  $templates . 'navbar.php' ?>
<!-- End Header -->
<div class="setting">
    <div class="container">
        <div class="parent">
            <nva class="sidebar">
                <a href="general-info.php" class="sidebar__list-item "> <i class="fa fa-user" aria-hidden="true"></i> General Info</a>
                <a href="account-setting.php" class="sidebar__list-item is_active"> <i class="fa fa-gear" aria-hidden="true"></i> Account Settings </a>
            </nva>
            <div class="">
                <div class="Password-info">
                    <h2>Change Password</h2>
                    <p>To change your account password, enter your current password, then enter your new password and confirm it.</p>
                    <div class="form">
                        <label for="profileImage">Current Password:</label>
                        <input type="password" id="password" name="input_oldpassword" required="required">
                        <input type="hidden" id="password" name="oldpassword" required="required">

                        <label for="username">New Password:</label>
                        <input type="password" id="password" name="newpassword" required="required">
                        <button type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $js ?>main.js"></script>
</body>

</html>