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
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark hold-transition login-page text-light">

<div class="container">



</div>
</body>
</html>