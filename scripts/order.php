<?php
session_start();
require_once "dbConnect.php";
require_once "mailer.php";

$stmt = $pdo->prepare("INSERT INTO orders (user_id, status) VALUES (:userId, :status)");
$stmt->execute([
    'userId' => $_SESSION['user']['id'],
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

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([
    'id' => $_SESSION['user']['id']
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$subject = "Zamówienie nr: ".$orderId;
$body = "
    <p>Hej {$user['first_name']} {$user['last_name']}!</p>
    <p>Przyjęto zamówienie nr: $orderId</p>
";
sendEmail($user['email'], $subject, $body);

unset($_SESSION['basket']);
header("location: ../summary.php");
?>