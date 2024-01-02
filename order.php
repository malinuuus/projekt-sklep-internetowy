<?php
session_start();
require_once "header.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zamówienie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark hold-transition login-page text-light">
<?php
if (isset($_SESSION["error"])) {
    echo <<< ERROR
       <div class="fixed-top alert alert-danger alert-dismissible m-3"> 
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-ban"></i>Uwaga!</h5>
           $_SESSION[error]
       </div>
    ERROR;
    unset($_SESSION ["error"]);
}

if (isset($_SESSION["success"])) {
    echo <<< ERROR
       <div class="fixed-top alert alert-success alert-dismissible m-3"> 
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           <h5><i class="icon fas fa-check"></i>Komunikat!</h5>
           $_SESSION[success]
       </div>
    ERROR;
    unset($_SESSION["success"]);
}
?>
<div>
    <?php require_once "header.php"; ?>
    <div class="card-body">
        <form action="payment.php" method="post" class="p-3 mx-5">
            <h3 class="login-box-msg mb-4">Finalizacja zamówienia</h3>

            <div class="my-3">
                <label for="street" class="form-label">Ulica</label>
                    <input type="text" class="form-control" placeholder="Podaj ulicę">

            </div>

            <div class="my-3">
                <label for="number" class="form-label">Numer domu</label>
                <input type="text" class="form-control" placeholder="Podaj numer domu">
            </div>


            <div class="my-3">
                <label for="kod_pocztowy" class="form-label">Kod pocztowy</label>
                <input type="text" class="form-control" placeholder="Podaj kod pocztowy">
            </div>

            <div class="my-3">
                <label for="city" class="form-label">Miasto</label>
                <input type="text" class="form-control" placeholder="Podaj miasto">
            </div>

            <div class="my-3">
                <label for="country" class="form-label">Kraj</label>
                <input type="text" class="form-control" placeholder="Podaj kraj">
            </div>

            <div class="my-3">
                <label for="phonenumber" class="form-label">Telefon</label>
                <input type="text" class="form-control" placeholder="Podaj numer telefonu">
            </div>

            <div class="row my-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Zamów i zapłać</button>
                </div>
            </div>
    </div>
</body>
</html>