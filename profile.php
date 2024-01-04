<?php
require_once "scripts/checkAuth.php";
checkUser(true);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>METZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <title>Mój profil</title>

</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
require_once "header.php";
?>

<h2>Mój profil</h2>

<?php

require_once "scripts/dbConnect.php";

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([
    'id' => $_SESSION['user']['id']
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user) {
    echo <<< USER
            <div class="user">
                <div class="text">
                  <h5> Imię: {$user['first_name']} </h5>
                  <h5>Nazwisko: {$user['last_name']} </h5>
                  <h5>Adres email: {$user['email']} </h5>
                </div>
            </div>
        USER;

}
?>

</body>
</html>