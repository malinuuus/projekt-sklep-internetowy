<?php
session_start();
$search = array_search($_POST['product_id'], $_SESSION['basket']);
array_splice($_SESSION['basket'], $search, 1);

header("location: ../basket.php");
?>