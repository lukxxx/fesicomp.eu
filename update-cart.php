<?php

$productCode = $_POST["productCode"];
$quantity = $_POST["quantity"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

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
            $c->quantity = $quantity-1;
        }
    }
} else {
    foreach ($cart as $c)
    {
    if ($c->productCode == $productCode)
    {
        $c->quantity = $quantity;
    }
    }
}


setcookie("cart", json_encode($cart));
header("Location: template/cart.php");