<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola!";
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "dbConnect.php";

$sql = "SELECT id, password, is_admin FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'email' => $_POST['email']
]);

if ($stmt->rowCount() == 0) {
    $_SESSION["error"] = "Użytkownik o podanym emailu nie istnieje!";
    echo "<script>history.back();</script>";
    exit();
} else {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($_POST["pass"], $user["password"])) {

        $_SESSION["user"] = [
            'id' => $user["id"],
            'isAdmin' => $user['is_admin']
        ];

        if ($user['is_admin']) {
            header("location: ../admin/index.php");
        } else {
            $redirect = isset($_GET["redirect"]) ? $_GET["redirect"] : "../index.php";
            header("location: $redirect");
        }
    } else {
        $_SESSION["error"] = "Podano nieprawidłowe hasło!";
        echo "<script>history.back();</script>";
        exit();
    }
}

?>