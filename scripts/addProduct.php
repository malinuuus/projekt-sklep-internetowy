<?php
session_start();
print_r($_POST);
require_once "dbConnect.php";
$stmt = $pdo->prepare("INSERT INTO products (name, price, size, brand_id, color) VALUES (:name, :price, :size, :brandId, :color)");
$stmt->execute([
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'size' => $_POST['size'],
    'brandId' => $_POST['brand_id'],
    'color' => $_POST['color']
]);

if ($stmt->rowCount() == 1) {
    echo "Pomyślnie dodano produkt.";
} else {
    echo "Nie udało się dodać produktu.";
}
header("location: ../admin/products.php");

?>

