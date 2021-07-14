<?php

$productCode = $_GET["p_code"];
$quantity = $_GET["quantity"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

if(isset($_GET['quantity-plus'])){
    foreach ($cart as $c)
{
    if ($c->productCode == $productCode)
    {
        $c->quantity = $quantity+1;
    }
}
} else if(isset($_GET['quantity-minus'])){
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
        $c->quantity = $quantity+1;
    }
    }
}


setcookie("cart", json_encode($cart));
header("Location: /kosik");