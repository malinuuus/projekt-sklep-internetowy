<?php
session_start();
require_once "dbConnect.php";

$stmt=$pdo->prepare("UPDATE products SET name = :name, price = :price, brand_id = :brandId, color = :color WHERE id = :id");
$stmt->execute([
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'brandId' => $_POST['brand_id'],
    'color' => $_POST['color']
]);

echo $stmt->rowCount();
if($stmt->rowCount()==1){
    $_SESSION["success"] = "Prawidłowo zaktualizowano produkt.";
}else {
    $_SESSION["error"] = "Nie udało się zaktualizować produktu";
}
header("location: ../admin/products.php");

?>