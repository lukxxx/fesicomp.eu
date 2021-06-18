<?php 

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

define("ROOT", __DIR__ ."/");

<<<<<<< HEAD
//$pdo = $pdo = new PDO("mysql:host=db.dw003.nameserver.sk;port=3306;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");
$pdo = new PDO("mysql:host=mariadb103.r1.websupport.sk;port=3313;dbname=compsnv_sk2", "compsnv_sk2", "Kajauhroba#2021");
=======
$pdo = new PDO("mysql:host=db.dw003.nameserver.sk;port=3306;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");
>>>>>>> f6c202ed44062eca57a4451612c48b60359319bf

$link = mysqli_connect("db.dw003.nameserver.sk", "compsnv_sk2", "iQ8sh2lz", "compsnv_sk2", 3306);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

