<?php
session_start();

unset($_SESSION["user"]);
$_SESSION["success"] = "Poprawnie wylogowano.";
header("Location: ../index.php");
?>