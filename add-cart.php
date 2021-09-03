<?php
require_once "config.php";

$quantity = $_POST["quantity"];
$productCode = $_POST["productCode"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$quantity_plus = $_POST["qplus"];
$quantity_minus = $_POST["qminus"];

echo $quantity;
echo $productCode;
echo $quantity_minus;
echo $quantity_plus;

$result = mysqli_query($link, "SELECT p_id, p_nazov, p_kod_sklad, p_img, p_sklad, p_cena FROM produkty WHERE p_id = '" . $productCode . "'");
$product = mysqli_fetch_object($result); 


if($quantity_plus == "plus"){
    foreach ($cart as $c)
{
    if ($c->productCode == $productCode)
    {
        echo $c->quantity = $quantity+1;
        
    }
}
} else if($quantity_minus == "minus"){
    foreach ($cart as $c)
    {
        if ($c->productCode == $productCode)
        {
            if($c->quantity == 1){
                echo $c->quantity = $quantity;
            } else {
                echo $c->quantity = $quantity-1;
            }
            
        }
    }
} else if(isset($_POST['productCode'])) {
    foreach ($cart as $c)
    {
    if ($c->productCode == $productCode)
    {
        echo $c->quantity = $quantity+1;
    }
        
    
}

array_push($cart, array(
    "productCode" => $productCode,
    "quantity" => $quantity,
    "product" => $product
));

}

setcookie("cart", json_encode($cart));
header("Location: $root_url/kosik");
?>