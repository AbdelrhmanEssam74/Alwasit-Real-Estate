<?php
$noNavbar = "";
$pageTitel = 'login';
session_start();
if ((isset($_SESSION['login']) && $_SESSION['login'])) {
    header('Location: dashboard.php');
    exit();
}

include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);
    $stmt = $conn->prepare("SELECT user_id, username, Password FROM users  WHERE username = ? AND  Password = ? AND group_id = 1 LIMIT 1");
    $stmt->execute([$username, $hashedPass]);
    $row = $stmt->fetchObject();
    $count = $stmt->rowCount();

    if ($count > 0) {
        $_SESSION['Username'] = $username;
        $_SESSION['ID'] = $row->user_id;
        $_SESSION['login'] = true;
        header('Location: dashboard.php');
        exit();
    }
}
?>

<div class="container">
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h4 class="text-center">Admin Login</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off" />
        <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password" />
        <div class="d-grid gap-2">
            <input class="btn btn-primary btn-block" type="submit" value="Login" />
        </div>
    </form>
</div>

<?php include $templates . 'footer.php'; ?>