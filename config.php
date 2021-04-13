<?php 

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

define("ROOT", __DIR__ ."/");

$pdo = $pdo = new PDO("mysql:host=db.dw003.nameserver.sk;port=3306;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");

$link = mysqli_connect("db.dw003.nameserver.sk", "compsnv_sk2", "iQ8sh2lz", "compsnv_sk2", 3306);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

