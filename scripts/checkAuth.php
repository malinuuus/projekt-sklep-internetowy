<?php
session_start();

function checkIfAdmin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] == 0) {
        header("HTTP/1.0 403 Forbidden");
        die();
    }
}

?>