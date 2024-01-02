<?php
session_start();
print_r($_POST);

// dokończyć
$search = array_search($_POST['product_id'], $_SESSION['basket']);
print_r($search);
print_r($_SESSION['basket']);
// array_splice($_SESSION['basket'], $_POST['product_id'], 1);
?>