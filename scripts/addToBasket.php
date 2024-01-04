<?php
session_start();
if (isset($_POST['variant_id'])) {
    if (isset($_SESSION['basket']) && in_array($_POST['variant_id'], $_SESSION['basket'])) {
        $_SESSION['error'] = 'Produkt znajduje się już w koszyku!';
    } else {
        $_SESSION['basket'][] = $_POST['variant_id'];
        $_SESSION['success'] = 'Dodano produkt do koszyka';
    }
} else {
    $_SESSION['error'] = "Wybierz wariant produktu!";
}

header("location: ../product.php?id=$_POST[product_id]");
?>