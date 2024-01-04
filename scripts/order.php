<?php
session_start();
require_once "dbConnect.php";

$stmt = $pdo->prepare("INSERT INTO orders (user_id, status) VALUES (:userId, :status)");
$stmt->execute([
    'userId' => $_SESSION['user_id'],
    'status' => 'zapłacone'
]);
$orderId = $pdo->lastInsertId();

foreach ($_SESSION['basket'] as $basketProductId) {
    $stmt = $pdo->prepare("INSERT INTO product_orders (product_id, order_id, quantity) VALUES (:productId, :orderId, :quantity)");
    $stmt->execute([
        'productId' => $basketProductId,
        'orderId' => $orderId,
        'quantity' => 1
    ]);
}

print_r($_POST);



unset($_SESSION['basket']);
header("location: ../summary.php");
?>