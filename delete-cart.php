<?php

$productCode = $_POST["productCode"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$new_cart = array();
foreach ($cart as $c)
{
    if ($c->productCode != $productCode)
    {
        array_push($new_cart, $c);
    }
}

setcookie("cart", json_encode($new_cart));
header("Location: template/cart.php");

?>