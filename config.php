<?php 


define("ROOT", __DIR__ ."/");

$db_host = "db003.nameserver.sk";
$db_name = "compsnv_sk2";
$db_user = "compsnv_sk2";
$db_pass = "iQ8sh2lz";


// Create a connection to the MySQL database using PDO
$pdo = new pdo(
    "mysql:host={$db_host};dbname={$db_name}",
    $db_user,
    $db_pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => FALSE
    ]
);

$hostname = "db003.nameserver.sk";
$user = "compsnv_sk2";
$pass = "iQ8sh2lz";
$db_name = "compsnv_sk2";
$link = mysqli_connect($hostname, $user, $pass, $db_name);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

