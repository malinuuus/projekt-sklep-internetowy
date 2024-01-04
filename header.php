
<nav class="bg-black d-flex justify-content-between align-items-center p-3">
    <a href="./index.php" class="d-inline-block">
        <img src="logo.webp" alt="">
    </a>

    <div class="nav-item p-3 d-flex">
        <a href='basket.php' class='nav-link px-2'>
            <i class="uil uil-shopping-basket"></i>
        </a>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["user_id"])) {
            echo "<i ></i>";
            echo "<a href='./scripts/logout.php' class='nav-link px-2'>Wyloguj się</a>";
        }else{
            echo "<a href='login.php' class='nav-link px-2'>Zaloguj się</a>";

        }
        ?>
    </div>
</nav>