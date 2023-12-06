<?php
session_start();
require_once "header.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>METZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark hold-transition login-page text-light">

<nav>
    <ul>
        <li><a class="menu active" href="#">KOBIETY</a></li>
        <li><a class="menu" href="#">MĘŻCZYŹNI</a></li>
    </ul>
</nav>


<?php

$dbname = "sklep_db";
$pdo = new PDO("mysql:host=localhost;dbname={$dbname}", "root", "");
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($products as $product) {
    echo <<< PRODUCT
            <div class="container">
              <div class="box">
                <div class="img">
                  <img src="{$product['photo']}" alt=""  >
                </div>
                <div class="text">
                  <h5>{$product['name']} </h5>
                  <p>{$product['color']}</p>
                  <p>{$product['price']}</p>
                </div>
                <div class="button">
                  <button>Dodaj do koszyka</button>
                </div>
                </div>
              </div>
            </div>

                  

PRODUCT;
}


?>

</body>
</html>