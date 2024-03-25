<header>
    <div class="container">
        <div class="dropdown">
            <button class="dropbtn">
                <img src='<?php echo $images ?>person1.jpg' alt='Profile Picture'>
            </button>
            <div id="myDropdown" class="dropdown-content">
                <a href="owner/index.php">Dashboard</a>
                <a href="setting.php">Settings</a>
                <a href="$logout">Logout</a>
            </div>
        </div>
        <nav class="navigation">
            <span id="menuicon"><i class="bx bx-menu toggle_menu black"></i></span>
            <ul id="menu" class="menu">
                <li><a href="">تواصل معنا</a></li>
                <li> <a href="">عنا</a></li>
                <li> <a href="">تجاريه</a></li>
                <li> <a href="">للطلاب</a></li>
                <li> <a href="">للإيجار</a></li>
                <li> <a href="">للبيع</a></li>
            </ul>
            <div class="logo"><a href="index.php"><img src="<?php echo $images ?>logo.png" alt="Logo"></a></div>
        </nav>
    </div>
</header>