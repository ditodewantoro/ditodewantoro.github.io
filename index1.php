<?php
session_start();
include "aksi.php";
include "list_produk.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <title>BukBuk</title>
</head>

<body>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">BukBuk</h1>
            <p class="lead">Beli buku, ya di BUKBUK aja</p>
            <hr class="my-4">
        </div>
    </div>
    <div class="container" id="content">
        <div class="row ">
            <div class="col" >
                    <h4><b>Produk</b></h4><hr>
                    <?php
                    foreach($products as $product):
                    ?>
                    <div class="card-group" style="width: 250px" >
                        <img class="card-img-top" src="./img/<?php echo $product["img"];?>" alt="Card image cap">
                        <div class="card-body text-center">
                        <form method="post">
                        <input type="hidden" name="id" value="<?php echo $product["id"];?>">
                        <input type="hidden" name="name" value="<?php echo $product["name"];?>">
                        <input type="hidden" name="price" value="<?php echo $product["price"];?>">
                            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                            <p class="card-text"><?php echo $product["price"]; ?></p>
                            <input type="number" name="quantity" value="1" min="1" max="10"><br><br>
                            <input type="submit" name="add_to_cart" class="btn btn-primary" value="Tambah ke keranjang">
                        </form>
                        </div>
                    </div><br>
                    <?php endforeach; ?>
                    <br>
            </div>
            <div class="col-4">
                <h4><b>Keranjang Belanja</b></h4>
                <hr>
                <p>Klik produk untuk membatalkan.</p>
                <ul class="list-group">
                    <?php
                    if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach($_SESSION["cart"] as $key => $value){
                    ?>
                    <a href="index1.php?action=delete&id=<?php echo $value["product_id"]; ?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $value["product_name"];?> - Rp.<?php echo number_format($value["product_price"] * $value["item_quantity"],0); ?>
                        <span class="badge badge-primary badge-pill"><?php echo $value["item_quantity"]; ?></span>
                    </a>
                    <?php
                    $total = $total + ($value["product_price"] * $value["item_quantity"]);}
                    ?>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total = Rp.<?php  echo $total?>
                    </li>
                </ul>
                <br>
                <form method="post">
                    <input type="hidden" name="action" value="discard">
                    <input type="submit" class="btn btn-warning btn-lg" value="Discard Cart">
                </form>
                <?php
                } else {
                ?>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Keranjang masih kosong.
                    </li>
                </ul>
                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>