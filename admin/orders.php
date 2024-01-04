<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>
<body>
<?php
require_once "menu.php";
?>

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Wyszukaj...">
        </div>

        <!--<img src="images/profile.jpg" alt="">-->
    </div>
    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-shopping-cart"></i>
                <span class="text">Zamówienia</span>
            </div>
        </div>

        <?php
        require_once "../scripts/dbConnect.php";
        $stmt = $pdo->prepare("
            SELECT o.id, o.status, o.created_at, u.first_name, u.last_name, u.email FROM orders o
            INNER JOIN users u ON o.user_id = u.id
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $order) {
            $stmt = $pdo->prepare("
                SELECT p.id, p.name, p.price, b.name AS brand, v.size FROM variant_orders o
                INNER JOIN variants v ON o.variant_id = v.id
                INNER JOIN products p ON v.product_id = p.id
                INNER JOIN brands b ON p.brand_id = b.id
                WHERE order_id = :orderId
            ");
            $stmt->execute([
                'orderId' => $order['id']
            ]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo <<< ORDER
                <div class="container">
                  <div class="box">
                    <div class="text">
                      <h3>Zamowienie nr {$order['id']} </h3>
                      <p>Status: {$order['status']}</p>
                      <p>Data złożenia zamówienia: {$order['created_at']}</p>
                      <p>Użytkownik: {$order['first_name']} {$order['last_name']} | {$order['email']}</p>
                    </div>
                  </div>
                </div>
                <p>Zamówione produkty:</p>
            ORDER;

            foreach ($products as $product) {
                echo <<< PRODUCT
                    <div>
                      <p>Nazwa produktu: {$product['brand']} {$product['name']}</p>
                      <p>Cena: {$product['price']}</p>
                      <p>Rozmiar: {$product['size']}</p>
                    </div>
                PRODUCT;
            }
        }
        ?>
    </div>
</section>

<script src="script.js"></script>
</body>
</html>