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
                <a href="general-info.php" class="sidebar__list-item is_active"> <i class="fa fa-user" aria-hidden="true"></i> General Info</a>
                <a href="account-setting.php" class="sidebar__list-item"> <i class="fa fa-gear" aria-hidden="true"></i> Account Settings </a>
            </nva>
            <div class="">
                <div class="personal-info">
                    <h2>Your Personal Information</h2>
                    <div class="form">
                        <div class="img-box">
                            <img id="imagePreview" src="<?php echo $images ?>person1.jpg" alt="Image preview">
                        </div>
                        <label for="profileImage">Profile Image:</label>
                        <input type="file" id="profileImage" class="custom-file-input" name="profileImage" accept="image/*">

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                        <button type="submit">Save</button>
                    </div>
                </div>
                <div class="contact_info">
                    <h2>Your Contact Information</h2>
                    <div class="form">
                        <label for="email">Mobile Number:</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your Mobile Number" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
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