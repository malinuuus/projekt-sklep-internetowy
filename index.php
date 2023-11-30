<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$dbname = "sklep_db";
$pdo = new PDO("mysql:host=localhost;dbname={$dbname}", "root", "");
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo <<< PRODUCT
            <div>
                <p>{$product['name']}</p>
                <button>Kup</button>
            </div>
PRODUCT;

}

//$stmt=$pdo->prepare("INSERT INTO products (id,name,price,size, brand_id, color)");
?>
</body>
</html>