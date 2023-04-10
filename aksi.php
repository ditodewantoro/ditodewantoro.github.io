<?php 
if(isset($_POST["add_to_cart"])){
    if(isset($_SESSION["cart"])){
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        $item_index = array_search($_POST["id"], $item_array_id);
        if($item_index !== false){
            $_SESSION["cart"][$item_index]["item_quantity"] += $_POST["quantity"];
        } else{
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $_POST["id"],
                'product_name' => $_POST["name"],
                'product_price' => $_POST["price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["cart"][$count] = $item_array;
        }
    }else{
        $item_array = array(
            'product_id' => $_POST["id"],
            'product_name' => $_POST["name"],
            'product_price' => $_POST["price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["cart"][0] = $item_array;
    }
}


if(isset($_GET["action"])){
    if($_GET["action"]== "delete"){
        foreach($_SESSION["cart"] as $keys => $values){
            if($values["product_id"]==$_GET["id"]){
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Produk telah di hapus dari keranjang belanja.")<?script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
    if($_GET["action"] == "deleteall"){
        unset($_SESSION["cart"]);
        echo '<script>alert("keranjang belanja telah dikosongkan.")<?script>';
        echo '<script>window.location="cart.php"</script>';
    }
}

if(isset($_POST['action']) && $_POST['action']=="discard") {
    unset($_SESSION["cart"]);
}
?>