<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function checkUser(bool $ifUser) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] == $ifUser) {
        header("HTTP/1.0 403 Forbidden");
        die();
    }
}

function checkBasket() {
    if (!isset($_SESSION['basket'])) {
        header("HTTP/1.0 403 Forbidden");
        die();
    }
}

?>