<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola!";
        echo "<script>history.back();</script>";
        exit();
    }
}

$error = 0;

if (!isset($_POST["terms"])) {
    $_SESSION["error"] = "Zatwierdź regulamin!";
    $error++;
}

if ($_POST["pass1"] != $_POST["pass2"]) {
    $_SESSION["error"] = "Hasła są różne";
    $error++;
}else{
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
        $_SESSION["error"]  = "Hasło nie spełnia wymagań!";
        $error++;
    }
}

if ($_POST["email1"] != $_POST["email2"]) {
    $_SESSION["error"] = "Adresy email są różne";
    $error++;
}

if ($error != 0) {
    echo "<script>history.back();</script>";
    exit();
}

// require_once "./connect.php";

$pdo = new PDO("mysql:host=localhost;dbname=sklep_db", "root", "");
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'email' => $_POST['email1']
]);

if ($stmt->rowCount() != 0) {
    $_SESSION["error"] = "Mail $_POST[email1] jest juz używany!";
    echo "<script>history.back();</script>";
    exit();
}

$pass = password_hash($_POST["pass1"], PASSWORD_DEFAULT);
$dbname = "sklep_db";
$pdo = new PDO("mysql:host=localhost;dbname={$dbname}", "root", "");
$stmt = $pdo->prepare("INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES (:first_name, :last_name, :email, :password);");
$stmt->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email1'],
    'password' => $pass
]);

echo $stmt->rowCount();

if ($stmt->rowCount() == 1) {
    $_SESSION["success"] = "Dodano użytkownika $_POST[first_name] $_POST[last_name]";
} else {
    $_SESSION["error"] = "Nie udało sie dodać rekordu ";
}