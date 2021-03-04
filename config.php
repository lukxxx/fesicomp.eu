<?php 

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

define("ROOT", __DIR__ ."/");

$db_host = "mariadb103.websupport.sk";
$db_name = "compsnv_sk2";
$db_user = "compsnv_sk2";
$db_pass = "iQ8sh2lz";


// Create a connection to the MySQL database using PDO
$pdo = $pdo = new PDO("mysql:host=mariadb103.websupport.sk;port=3313;dbname=compsnv_sk2", "compsnv", "Kajauhroba#2021");


$hostname = "mariadb103.websupport.sk";
$user = "compsnv_sk2";
$pass = "iQ8sh2lz";
$db_name = "compsnv_sk2";
$link = mysqli_connect("mariadb103.websupport.sk", "compsnv", "Kajauhroba#2021", "compsnv_sk2", 3313);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

