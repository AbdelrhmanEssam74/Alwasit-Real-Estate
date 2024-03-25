<?php
session_start();
$pageTitel = 'delete';
include 'init.php';
$user_id =  (isset($_POST['id']) && is_numeric($_POST['id'])) ? intval($_POST['id'])  : 0;
# Update page
// old version of the update code:
if ($_SERVER['REQUEST_METHOD'] === 'POST') :
    // variables From The Form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $pass  = (empty($_POST['newpassword'])) ? $_POST['oldpassword'] : password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
    // Validate The Form
    // $formErrors = array();
    // if (strlen($username) < 4) {
    //     $formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
    // }
    // if (strlen($username) > 30) {
    //     $formErrors[] = 'Username Cant Be More Than <strong>30 Characters</strong>';
    // }
    // if (empty($username)) {
    //     $formErrors[] = 'Username Cant Be <strong>Empty</strong>';
    // }
    // if (empty($full_name)) {
    //     $formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
    // }
    // if (empty($email)) {
    //     $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
    // }
    // if (empty($formErrors)) :
    // Update The Database With This Info
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, full_name = ? , password = ? WHERE user_id = ?");
    $r = $stmt->execute(array($username, $email, $full_name, $pass, $user_id));
    echo $r . "\n";
    echo  $stmt->rowCount();
// exit();
// endif;
else :
endif;
