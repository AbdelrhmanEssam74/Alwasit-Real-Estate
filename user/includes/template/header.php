<?php include $function . 'function.php';
if (isset($_COOKIE['u']) && !isset($_SESSION['loggedIn'])) {
    $hashed_id = $_COOKIE['u'];
    include_once $config . 'config.php';
    include_once $config . 'loginTable.php';
    include_once $config . 'usersTable.php';
    // check if the user is still in the database, otherwise delete the cookie and redirect to login page
    $users_obj = new RegisterTable();
    $login_user_obj = new loginTable();
    $user_id = "";
    $AllUsers = $users_obj->getAll();
    foreach ($AllUsers as $user):
        if (password_verify($user['user_id'], $hashed_id)) {
            $user_id = $user['user_id'];
            break;
        } else {
            continue;
        }
    endforeach;
    // get the user's information from the users table using their id
    $user_data = $login_user_obj->getLoginUser($user_id);
    if (!empty($user_data)) {
        if ($user_data['expire_date'] < date("Y-m-d H:i:s")) {
            // update cookies and sesssions
            setcookie("rem", $user_data['token'], $user_data['expire_date'], '/');
            $_SESSION['loggedIn'] = true;
            $_SESSION['uID'] = $user_id;
            $_SESSION['email'] = $user_data['email'];
        }
    }
}
if (empty($_SESSION['loggedIn'])) {
    header("Location:" . APPURL);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main External Css file -->
    <link rel="stylesheet" href="<?php echo $css ?>user.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>
        <?php echo $pageTitel ?>
    </title>
</head>

<body>
    <!-- Button to top -->
    <span class="up"><i class="fa-regular fa-circle-up"></i></span>