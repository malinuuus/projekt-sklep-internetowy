<?php
require_once "../scripts/checkAuth.php";
checkIfAdmin();
?>
<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="images/logo.png" alt="">
        </div>

        <span class="logo_name">CodingLab</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Panel administratora</span>
                </a></li>
            <li><a href="products.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Produkty</span>
                </a></li>
            <li><a href="orders.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Zamówienia</span>
                </a></li>

        </ul>

        <ul class="logout-mode">
            <li><a href="../scripts/logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Wyloguj</span>
                </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>