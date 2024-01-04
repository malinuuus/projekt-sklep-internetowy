<?php
session_start();
require_once "dbConnect.php";

$stmt = $pdo->prepare("INSERT INTO orders (user_id, status) VALUES (:userId, :status)");
$stmt->execute([
    'userId' => $_SESSION['user_id'],
    'status' => 'zapłacone'
]);
$orderId = $pdo->lastInsertId();

foreach ($_SESSION['basket'] as $basketVariantId) {
    $stmt = $pdo->prepare("INSERT INTO variant_orders (variant_id, order_id, quantity) VALUES (:variantId, :orderId, :quantity)");
    $stmt->execute([
        'variantId' => $basketVariantId,
        'orderId' => $orderId,
        'quantity' => 1
    ]);
}

print_r($_POST);



unset($_SESSION['basket']);
header("location: ../summary.php");
?>