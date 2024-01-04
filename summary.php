<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podsumowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .header {
            text-align: center;
            margin: 30px;
        }

        .header a {
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
require_once "header.php";
?>
<div class="header">
    <h4>DZIĘKUJEMY ZA ZAKUPY</h4>
    <a href="index.php">Powrót na stronę główną</a>
</div>
</body>
</html>