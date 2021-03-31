<?php 

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

define("ROOT", __DIR__ ."/");

$db_host = "db003.nameserver.sk";
$db_name = "compsnv_sk2";
$db_user = "compsnv_sk2";
$db_pass = "iQ8sh2lz";


// Create a connection to the MySQL database using PDO
$pdo = $pdo = new PDO("mysql:host=db003.nameserver.sk;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");


$hostname = "db003.nameserver.sk";
$user = "compsnv_sk2";
$pass = "iQ8sh2lz";
$db_name = "compsnv_sk2";
$link = mysqli_connect("db003.nameserver.sk", "compsnv_sk2", "iQ8sh2lz", "compsnv_sk2");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

