<?php
session_start();

if (isset($_SESSION['basket']) && in_array($_POST['product_id'], $_SESSION['basket'])) {
    $_SESSION['error'] = 'Produkt znajduje się już w koszyku!';
} else {
    $_SESSION['basket'][] = $_POST['product_id'];
    $_SESSION['success'] = 'Dodano produkt do koszyka';
}

header('location: ../index.php');
?>