<?php
include "init.php";
echo (isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : 0);
