<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>METZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .product {
            display: block;
            width: 200px;
            text-decoration: none;
            color: #fff;
            background: #707070;
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .products {
            margin: 50px 0;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 50px;
            justify-items: center;
        }

        .categories {
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding-top: 10px;
        }

        .category a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
require_once "header.php";
require_once "scripts/dbConnect.php";
?>
<nav>
    <ul class="categories">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            echo <<< CATEGORY
                <li class="category"><a href="#">{$category['name']}</a></li>
            CATEGORY;
        }
        ?>

    </ul>
</nav>
<?php

if (isset($_SESSION['error'])) {
    echo <<< ERROR
        <div>
            <p>{$_SESSION['error']}</p>
        </div>
    ERROR;
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo <<< ERROR
        <div>
            <p>{$_SESSION['success']}</p>
        </div>
    ERROR;
    unset($_SESSION['success']);
}

$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='products'>";
foreach ($products as $product) {
    echo <<< PRODUCT
            <a href="product.php?id=$product[id]" class="product">
                <div class="img">
                  <img src="{$product['photo']}" alt=""  >
                </div>
                <div class="text">
                  <h5>{$product['name']} </h5>
                  <p>{$product['price']} zł</p>
                </div>
              </a>
        PRODUCT;
}
echo "</div>";

?>
<script src="./js/closeAlert.js"></script>
</body>
</html>
