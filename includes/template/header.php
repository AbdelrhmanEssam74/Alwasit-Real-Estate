<?php include $function . 'function.php'; ?>
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

    <?php
    // assign rent stylesheet to rent page and buy page
    if (isset($main_page)) {
    ?>
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>home.css">
    <?php
    }
    if (isset($buy_page) || isset($rent_page)) :
    ?>
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent.css">
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <?php
    endif;
    ?>
    <?php
    // assign rent2 stylesheet to 
    if (isset($commercial_page) || isset($about_page) || isset($services_page) || isset($privacy_policy_Page) || isset($instructions_page)) :
    ?>
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>rent2.css">
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">
    <?php
    endif;
    ?>
    <?php
    // assign rent2 stylesheet to rent commercial page
    if (isset($contactus_page)) :
    ?>
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>contactus.css">
    <?php
    endif;
    ?>
    <?php
    // assign rent2 stylesheet to 
    if (isset($prop_details_page)) :
    ?>
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>property_details.css">
        <link rel="stylesheet" id="stylesheet" href="<?php echo $css ?>main.css">

    <?php
    endif;
    ?>
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
    <span class="up"><i class="fa-regular fa-circle-up"></i></span>