<?php
session_start();
require_once "header.php";
require_once "scripts/dbConnect.php";

$stmt = $pdo->prepare("
    SELECT p.id, p.name, p.price, p.color, p.photo, b.name AS brand FROM products p 
    INNER JOIN brands b ON p.brand_id = b.id WHERE p.id = :id

");
$stmt->execute([
    'id' => $_GET['id']
]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM variants WHERE product_id = :productId");
$stmt->execute([
    'productId' => $product['id']
]);
$variants = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        .container {
            width: 500px;
            padding: 0;
            margin: 50px;
        }

        .container img {
            width: 100%;
        }

        .product-size {
            display: inline-block;
            margin-bottom: 20px;
        }

        .product-size .size {
            border: 1px solid #707070;
            padding: 10px 20px;
            cursor: pointer;
        }

        .product-size input {
            display: none;
        }

        .product-size input:checked + .size {
            border: 1px solid #fff;
        }

        .basket-btn {
            margin-top: 40px;
            border:  5px solid;
            padding: 10px;
        }

    </style>

</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
if (isset($_SESSION["error"])) {
    echo <<< ERROR
       <div class="fixed-top alert alert-danger alert-dismissible m-3"> 
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-ban"></i>Uwaga!</h5>
           $_SESSION[error]
       </div>
    ERROR;
    unset($_SESSION ["error"]);
}

if (isset($_SESSION["success"])) {
    echo <<< ERROR
       <div class="fixed-top alert alert-success alert-dismissible m-3"> 
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-check"></i>Komunikat!</h5>
           $_SESSION[success]
       </div>


    ERROR;
    unset($_SESSION["success"]);
}




?>



<div class="container">
    <div class="img">
        <img src="<?php echo $product['photo']; ?>" alt="">
    </div>
    <form action="scripts/addToBasket.php" method="post">
        <div class="text">
            <h5><?php echo $product['name']; ?></h5>
            <p><?php echo $product['color']; ?></p>
            <p><?php echo $product['price'] ?></p>

            <?php
            foreach ($variants as $variant) {
                echo <<< SIZE
                <div class="product-size">
                    <label for="{$variant['id']}">
                        <input type="radio" name="variant_id" id="{$variant['id']}" value="{$variant['id']}">
                        <span class="size">{$variant['size']}</span>
                    </label>
                </div>
            SIZE;
            }
            ?>

            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
            <button type="submit" class="basket-btn">Dodaj do koszyka</button>
        </div>
    </form>
</div>
</body>
</html>