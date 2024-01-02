<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola!";
        echo "<script>history.back();</script>";
        exit();
    }
}

$dbname = "sklep_db";
$pdo = new PDO("mysql:host=localhost;dbname={$dbname}", "root", "");

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

        $_SESSION["user_id"] = $user["id"];

        if ($user['is_admin']) {
            header("location: ../admin.php");
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