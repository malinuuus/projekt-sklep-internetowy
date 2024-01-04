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
require_once "../scripts/dbConnect.php";
$stmt = $pdo->prepare("SELECT COUNT(*) as allProducts FROM products ");
$stmt->execute();
$products = $stmt->fetch(PDO::FETCH_ASSOC);
$allProducts = $products['allProducts'];

$stmt = $pdo->prepare("select count(*) as allQuantity from orders");
$stmt->execute();
$product_orders = $stmt->fetch(PDO::FETCH_ASSOC);
$allQuantity = $product_orders['allQuantity'];
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
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Panel administratora</span>
            </div>

            <div class="boxes">
                <div class="box box1">
                    <i class="uil uil-shopping-bag"></i>
                    <span class="text">Ilość zamówień</span>
                    <span class="number"><?php echo $allQuantity; ?></span>
                </div>
                <div class="box box2">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="text">Ilość produktów</span>
                    <span class="number"><?php echo $allProducts;?></span>
                </div>
                <div class="box box3">
                    <i class="uil uil-smile"></i>
                    <span class="text">Zadowoleni klienci</span>
                    <span class="number">+120</span>
                </div>
            </div>
        </div
    </div>
</section>

<script src="script.js"></script>
</body>
</html>