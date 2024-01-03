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
    <style>
        .products-table, .products-table tr {
            border: 1px solid #707070;
        }

        .products-table td {
            padding: 15px;
        }

        .products-table img {
            width: 150px
        }
    </style>
</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
require_once "header.php";
?>
<h1>Twój koszyk</h1>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=sklep_db", "root", "");

if (isset($_SESSION['basket']) && sizeof($_SESSION['basket']) > 0) {
    echo "<table class='products-table'>";
    $sum = 9.9;

    foreach ($_SESSION['basket'] as $basketProductId) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([
            'id' => $basketProductId
        ]);

        // if ($stmt->rowCount() == 0) continue;

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $sum += $product['price'];

        echo <<< PRODUCT
                <tr>
                    <td>
                        <img src="{$product['photo']}" alt="{$product['name']}">                    
                    </td>
                    <td>{$product['name']}</td>
                    <td>{$product['price']}</td>
                    <td>
                        <form action="scripts/deleteFromBasket.php" method="post">
                            <input type="hidden" name="product_id" value="{$product['id']}">
                            <button>usuń</button>
                        </form>
                    </td>
                </tr>
            PRODUCT;
    }

    echo <<< TABLE
        <tr>
            <td></td>
            <td>Dostawa:</td>
            <td>9.90 zł</td>
        </tr>
        <tr>
            <td></td>
            <td>Łącznie:</td>
            <td>$sum zł</td>
        </tr>
        </table>
    TABLE;
} else {
    echo "<p>Brak przedmiotów w koszyku</p>";
}
?>
<div class="row my-3">
    <div class="col">
        <a href="order.php">
            <button type="submit" class="btn btn-primary btn-block">Płacę</button>
        </a>
    </div>
</div>
</body>
</html>