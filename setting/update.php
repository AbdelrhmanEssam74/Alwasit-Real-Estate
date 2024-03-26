<?php
// var_dump($_POST);
include_once 'init.php';
include_once $config . 'config.php';
include_once $config . 'loginTable.php';
include_once $config . 'usersTable.php';
$login_obj = new loginTable;
$user_obj = new RegisterTable;
echo ($_POST['id']) . "\n";
echo ($_POST['oldImg']) . "\n";

echo (isset ($_POST['newImg'])) ? $_POST['newImg'] . "\n" : 0 . "\n";
echo ($_POST['username']) . "\n";
echo ($_POST['first_name']) . "\n";
echo ($_POST['last_name']) . "\n";