<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koszyk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark hold-transition login-page text-light">
    <h1>Twój koszyk</h1>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=sklep_db", "root", "");

    if (isset($_SESSION['basket']) && sizeof($_SESSION['basket']) > 0) {
        foreach ($_SESSION['basket'] as $basketProductId) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute([
                'id' => $basketProductId
            ]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            echo <<< PRODUCT
                <div class="container">
                    <img src="{$product['photo']}" alt="{$product['name']}">
                    <p>{$product['name']}</p>
                    <p>{$product['price']}</p>
                    <form action="scripts/deleteFromBasket.php" method="post">
                        <input type="hidden" name="product_id" value="{$product['id']}">
                        <button>usuń</button>
                    </form>
                </div>
            PRODUCT;
        }
    } else {
        echo "<p>Brak przedmiotów w koszyku</p>";
    }
    ?>
    <div class="row my-3">
        <div class="col">
            <form action="order.php" method="get">
                <button type="submit" class="btn btn-primary btn-block">Płacę</button>
            </form>
        </div>
    </div>
</body>
</html>