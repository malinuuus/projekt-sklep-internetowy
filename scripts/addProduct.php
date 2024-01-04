<?php
session_start();
require_once "dbConnect.php";
/*
$stmt = $pdo->prepare("INSERT INTO products (name, price, brand_id, color) VALUES (:name, :price, :brandId, :color)");
$stmt->execute([
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'brandId' => $_POST['brand_id'],
    'color' => $_POST['color']
]);
*/
$productId = 1;

foreach (range(36, 45) as $size) {
    $stmt = $pdo->prepare("INSERT INTO variants (product_id, size) VALUES (:productId, :size)");
    $stmt->execute([
        'productId' => $productId,
        'size' => $size
    ]);
}

if ($stmt->rowCount() == 1) {
    echo "Pomyślnie dodano produkt.";
} else {
    echo "Nie udało się dodać produktu.";
}
header("location: ../admin/products.php");

?>

