<?php
session_start();
require_once "dbConnect.php";
$stmt = $pdo->prepare("DELETE FROM products WHERE id = :productId");
$stmt->execute([
    'productId' => $_POST['product_id']
]);
if ($stmt->rowCount() == 1) {
    echo "Pomyślnie usunięto produkt.";
} else {
    echo "Nie udało się usunąć produktu.";
}

header("location: ../admin/products.php");

?>