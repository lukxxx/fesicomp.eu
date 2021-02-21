<?php

$conn = mysqli_connect("localhost", "root", "", "compsnv");

$quantity = $_POST["quantity"];
$productCode = $_POST["productCode"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$result = mysqli_query($conn, "SELECT * FROM produkty WHERE p_kod_sklad = '" . $productCode . "'");
$product = mysqli_fetch_object($result);

array_push($cart, array(
    "productCode" => $productCode,
    "quantity" => $quantity,
    "product" => $product
));

setcookie("cart", json_encode($cart));
header("Location: template/cart.php");
?>