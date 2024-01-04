<?php
require_once "../scripts/checkAuth.php";
checkUser(false);
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>
<body>
<?php
require_once "menu.php";
?>

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Wyszukaj...">
        </div>

        <!--<img src="images/profile.jpg" alt="">-->
    </div>
    <div class="dash-content">
        <form action="../scripts/addProduct.php" method="post">
            <div class="my-3">
                <label for="color" class="form-label">Marka</label>
                <select class="form-control" name="brand_id">
                    <option value="" selected disabled>Wybierz markę</option>
                    <?php
                    session_start();
                    require_once "../scripts/dbConnect.php";
                    $stmt = $pdo->prepare("SELECT * FROM brands");
                    $stmt->execute();
                    $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($brands as $brand) {
                        echo "<option value=$brand[id]>$brand[name]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <label for="name" class="form-label">Nazwa</label>
                <input type="text" class="form-control" placeholder="Podaj nazwę" name="name" id="name">
            </div>

            <div class="my-3">
                <label for="price" class="form-label">Cena</label>
                <input type="text" class="form-control" placeholder="Podaj cenę" name="price" id="price">
            </div>

            <div class="my-3">
                <label for="size" class="form-label">Rozmiar</label>
                <input type="text" class="form-control" placeholder="Podaj rozmiar" name="size" id="size">
            </div>

            <div class="my-3">
                <label for="color" class="form-label">Kolor</label>
                <input type="text" class="form-control" placeholder="Podaj kolor" name="color" id="color">
            </div>

            <div class="row my-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Dodaj produkt</button>
                </div>
            </div>
        </form>

    </div>
</section>

<script src="script.js"></script>
</body>
</html>