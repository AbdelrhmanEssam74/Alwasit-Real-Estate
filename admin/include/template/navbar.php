<nav class="navbar  bg-dark  navbar-expand-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="categories.php"><?php echo lang('CATEGORIES') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="users.php?action=Properties"><?php echo lang('ITEMS') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="users.php"><?php echo lang('Owners') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="users.php?action=Manage-Members"><?php echo lang('MEMBERS') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><?php echo lang('COMMENTS') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><?php echo lang('LOGS') ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['Username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="users.php?action=Edit&uID=<?php echo $_SESSION['admin_id'] ?>">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>