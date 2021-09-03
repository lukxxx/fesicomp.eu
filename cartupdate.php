<?php 
require_once "config.php";

$quantity = $_POST["quantity"];
$productCode = $_POST["productCode"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$event = $_POST['evt'];

$result = mysqli_query($link, "SELECT p_id, p_nazov, p_kod_sklad, p_img, p_sklad, p_cena FROM produkty WHERE p_id = '" . $productCode . "'");
$product = mysqli_fetch_object($result); 

if($event == "plus"){
    foreach ($cart as $c)
{
    if ($c->productCode == $productCode)
    {
        $c->quantity = $quantity+1;
        echo $c->quantity;
    }
}
} else if($event == "minus"){
    foreach ($cart as $c)
    {
        if ($c->productCode == $productCode)
        {
            if($c->quantity == 1){
                $c->quantity = $quantity;
                echo $c->quantity;
            } else {
                $c->quantity = $quantity-1;
                echo $c->quantity;
            }
            
        }
    }
}
