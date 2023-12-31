<?php
require_once "../scripts/checkAuth.php";
checkUser(false);
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
    <style>
        .alert {
            position: fixed;
            top: -20px;
            z-index: 2;
            margin: 80px;
            padding: 30px;
        }

        .alert-danger {
            background: #e77676;
        }

        .alert-success {
            background: #90ee90;
        }
    </style>
</head>
<body>
<?php
require_once "menu.php";
if (isset($_SESSION["error"])) {
    echo <<< ERROR
       <div class="fixed-top alert alert-danger alert-dismissible m-3 my-5"> 
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

<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Wyszukaj...">
        </div>

        <!--<img src="images/profile.jpg" alt="">-->
    </div>
    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-clock-three"></i>
                <span class="text">Produkty</span>
                <a href="product.php">
                    <i class="uil uil-plus"></i>
                </a>
            </div>
        </div>

        <?php
        require_once "../scripts/dbConnect.php";
        $stmt = $pdo->prepare("SELECT p.id, p.name, p.price, p.color, p.photo, b.name AS brand FROM products p INNER JOIN brands b ON p.brand_id = b.id ORDER BY name");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $imagePath = $product['photo'] ?: 'imagePlaceholder.png';

            echo <<< PRODUCT
            <div class="product">
                <div class="product-details">
                    <div class="product-img">
                        <img src="../$imagePath" alt=""  >
                    </div>
                    <div class="text">
                        <h5>{$product['brand']} | {$product['name']}</h5>
                        <p>{$product['color']}</p>
                        <p>{$product['price']} zł</p>
                    </div>
                </div>
                <div class="options">
                    <form action="product.php" method="get">
                        <input type="hidden" name="id" value="{$product['id']}">
                        <button type="submit">
                            <i class="uil uil-edit"></i>
                            <span>Edytuj </span>
                        </button>
                    </form>
                    <form action="../scripts/deleteProduct.php" method="post">
                        <input type="hidden" name="product_id" value="{$product['id']}">
                        <button type="submit">
                            <i class="uil uil-trash-alt"></i>
                            <span>Usuń</span>
                        </button>
                    </form>
                    </a>
                </div>
            </div>    
            
        PRODUCT;
        }
        ?>
    </div>
</section>

<script src="script.js"></script>
<script src="../js/closeAlert.js"></script>
</body>
</html>