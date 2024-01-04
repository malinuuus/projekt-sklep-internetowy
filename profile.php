<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Mój profil</title>
</head>
<body>
<?php
require_once "header.php";
?>

<h2>Mój profil</h2>

<?php

if (isset($_SESSION['error'])) {
    echo <<< ERROR
        <div>
            <p>{$_SESSION['error']}</p>
        </div>
    ERROR;
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo <<< ERROR
        <div>
            <p>{$_SESSION['success']}</p>
        </div>
    ERROR;
    unset($_SESSION['success']);
}

require_once "scripts/dbConnect.php";

$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='products'>";
foreach ($users as $user) {
    echo <<< USER
            <a href="user.php?id=$user[id]" class="user">
                <div class="text">
                  <h5>{$user['first_name']} </h5>
                  <h5>{$user['last_name']} </h5>
                  <h5>{$user['email']} </h5>
                  <h5>{$user['password']} </h5>
                </div>
              </a>
        USER;
}
echo "</div>";

?>

</body>
</html>