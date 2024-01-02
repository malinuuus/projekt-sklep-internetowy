<?php
session_start();

unset($_SESSION["user_id"]);
$_SESSION["success"] = "Poprawnie wylogowano.";
header("Location: ../index.php");
?>