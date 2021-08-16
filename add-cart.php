<?php
require_once "config.php";

$quantity = $_POST["quantity"];
$productCode = $_POST["productCode"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$result = mysqli_query($link, "SELECT p_id, p_nazov, p_kod_sklad, p_img, p_sklad, p_cena FROM produkty WHERE p_id = '" . $productCode . "'");
$product = mysqli_fetch_object($result); 


if(isset($_POST['quantity-plus'])){
    foreach ($cart as $c)
{
    if ($c->productCode == $productCode)
    {
        $c->quantity = $quantity+1;
    }
}
} else if(isset($_POST['quantity-minus'])){
    foreach ($cart as $c)
    {
        if ($c->productCode == $productCode)
        {
            if($c->quantity == 1){
                $c->quantity = $quantity;
            } else {
                $c->quantity = $quantity-1;
            }
            
        }
    }
} else if(isset($_POST['productCode'])) {
    foreach ($cart as $c)
    {
    if ($c->productCode == $productCode)
    {
        $c->quantity = $quantity+1;
        $drb = 1;
    }
        
    
}
if($drb == 1){
    echo "hehe";
} else {
    array_push($cart, array(
        "productCode" => $productCode,
        "quantity" => $quantity,
        "product" => $product
    ));
}

}

setcookie("cart", json_encode($cart));
header("Location: $root_url/kosik");
?>