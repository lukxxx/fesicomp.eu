<?php
require_once "config.php";

$quantity = $_GET["quantity"];
$productCode = $_GET["p_code"];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$result = mysqli_query($link, "SELECT p_id, p_nazov, p_kod_sklad, p_img, p_sklad, p_cena FROM produkty WHERE p_id = '" . $productCode . "'");
$product = mysqli_fetch_object($result); 

array_push($cart, array(
    "productCode" => $productCode,
    "quantity" => $quantity,
    "product" => $product
));

setcookie("cart", json_encode($cart));
header("Location: $root_url/kosik");
?>