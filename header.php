
<nav class="bg-black d-flex justify-content-between align-items-center p-3">
    <a href="./index.php" class="d-inline-block"><h3>Logo tu bedzie</h3></a>
    <h2>METZ shoes</h2>
    <div class="nav-item p-3 d-flex">
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["user_id"])) {

        }else{
            echo "<a href='login.php' class='nav-link px-2'>zaloguj się</a>";
        }
        ?>
    </div>
</nav>