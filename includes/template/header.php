<?php
include $function . 'function.php';
date_default_timezone_set('Europe/Sofia');

if (isset($_COOKIE['u']) && !isset($_SESSION['loggedIn'])) {
  $hashed_id = $_COOKIE['u'];
  include $config . 'config.php';
  include $config . 'loginTable.php';
  include $config . 'usersTable.php';

  $users_obj = new RegisterTable();
  $login_user_obj = new loginTable();
  $user_id = "";

  $AllUsers = $users_obj->getAll();
  foreach ($AllUsers as $user) {
    if (password_verify($user['user_id'], $hashed_id)) {
      $user_id = $user['user_id'];
      break;
    }
  }

  if (!empty($user_id)) {
    $user_data = $login_user_obj->getLoginUser($user_id);

    if (!empty($user_data) && $user_data['expire_date'] > date("Y-m-d H:i:s")) {
      setcookie("rem", $user_data['token'], strtotime($user_data['expire_date']), '/');
      $_SESSION['loggedIn'] = true;
      $_SESSION['uID'] = $user_id;
      $_SESSION['email'] = $user_data['email'];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Main External Css file -->

  <?php if (isset($setting_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <link rel="stylesheet" href="ar/css/setting.css">
  <?php } ?>

  <?php if (isset($main_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>home.css">
  <?php } ?>

  <?php if (isset($buy_page) || isset($rent_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
  <?php } ?>

  <?php if (isset($commercial_page) || isset($about_page) || isset($services_page) || isset($privacy_policy_Page) || isset($instructions_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent2.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
  <?php } ?>

  <?php if (isset($contactus_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>contactus.css">
  <?php } ?>

  <?php if (isset($prop_details_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>property_details.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
  <?php } ?>

  <?php if (isset($profile_page)) { ?>
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>profile.css">
    <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
  <?php } ?>

  <?php if (isset($login_page)) { ?>
    <link rel="stylesheet" href="<?php echo $css ?>login.css">
  <?php } ?>

  <?php if (isset($register_page)) { ?>
    <link rel="stylesheet" href="<?php echo $css ?>register.css">
  <?php } ?>
  <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>footer.css">
  <!-- Reader all elements nomarlly -->
  <link rel="stylesheet" href="<?php echo $css ?>normalize.css" />
  <!-- Font awesome library -->
  <link rel="stylesheet" href="<?php echo $css ?>all.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link rel="stylesheet" href="<?php echo $css ?>bootstrap.min.css"> -->
  <!-- animate text  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title><?php echo $pageTitel ?></title>
</head>

<body>
  <!-- Button to top -->
  <?php if (!isset($login_page) && !isset($register_page)) :
  ?>
    <span class="up"><i class="fa-regular fa-circle-up"></i></span>
  <?php endif; ?>