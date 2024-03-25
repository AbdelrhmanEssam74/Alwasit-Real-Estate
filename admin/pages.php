<?php


$action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

// If The Page Is Main Page

if ($action == 'Manage') {

    echo 'Welcome You Are In Manage Category Page';
    echo '<a href="?action=Insert">Add New Category +</a>';
} elseif ($action == 'Add') {

    echo 'Welcome You Are In Add Category Page';
} elseif ($action == 'Insert') {

    echo 'Welcome You Are In Insert Category Page';
} else {

    echo 'Error There\'s No Page With This Name';
}
