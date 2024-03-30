<?php
include "connect.php";
##NOTE -  Routes
$templates  = 'include/template/';  // template directory
$func       = 'include/func/';      // function directory
$css        = 'ar/css/';            // css directory
$js         = 'ar/js/';             // js directory
$img        = 'ar/images/';         // images directory
$lang       = 'include/lang/';      // language directory
$libs       = '../libs/';           // language directory

if ($pageTitel != 'delete') {
  include $func . 'functions.php';
  include $lang . 'english.php';
  include $templates . 'header.php';
  if (!isset($noNavbar)) {
    include $templates . 'navbar.php';
  }
}
