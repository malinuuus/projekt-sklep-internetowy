<?php
session_start();
require_once "dbConnect.php";
require_once "mailer.php";

$stmt = $pdo->prepare("INSERT INTO address (city, country, street, number, postal_code, phone_number) VALUES (:city, :country, :street, :number, :postal_code, :phone_number)");
$stmt->execute([
    'city' => $_SESSION['address']['city'],
    'country' => $_SESSION['address']['country'],
    'street' => $_SESSION['address']['street'],
    'number' => $_SESSION['address']['number'],
    'postal_code' => $_SESSION['address']['postal_code'],
    'phone_number' => $_SESSION['address']['phone_number']
]);
$addressId = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO orders (user_id, address_id, status) VALUES (:userId, :addressId, :status)");
$stmt->execute([
    'userId' => $_SESSION['user']['id'],
    'addressId' => $addressId,
    'status' => 'zapłacone'
]);
$orderId = $pdo->lastInsertId();
$products = [];

foreach ($_SESSION['basket'] as $basketVariantId) {
    $stmt = $pdo->prepare("INSERT INTO variant_orders (variant_id, order_id, quantity) VALUES (:variantId, :orderId, :quantity)");
    $stmt->execute([
        'variantId' => $basketVariantId,
        'orderId' => $orderId,
        'quantity' => 1
    ]);

    $stmt = $pdo->prepare("SELECT p.name, p.price, v.size FROM variants v INNER JOIN products p ON v.product_id = p.id WHERE v.id = :variantId");
    $stmt->execute([
        'variantId' => $basketVariantId
    ]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $products[] = $product;
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
    <table>
";

$sum = 9.9;

foreach ($products as $product) {
    $sum += $product['price'];
    $body .= "
        <tr>
            <td>{$product['name']}</td>
            <td>{$product['size']}</td>
            <td>{$product['price']} zł</td>
        </tr>
    ";
}
$body .= "
    <tr>
        <td></td>
        <td>Łącznie:</td>
        <td>$sum zł</td>
    </tr>
    </table>
";
$body .= "
    <p>Adres dostawy:</p>
    <p>{$_SESSION['address']['street']} {$_SESSION['address']['number']},</p>
    <p>{$_SESSION['address']['postal_code']} {$_SESSION['address']['city']}</p>
";

sendEmail($user['email'], $subject, $body);

unset($_SESSION['basket']);
unset($_SESSION['address']);
header("location: ../summary.php");
?>