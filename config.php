<?php 
$hostname = "87.197.174.134";
$user = "root";
$pass = "";
$db_name = "compsnv_sk2";
$link = mysqli_connect($hostname, $user, $pass, $db_name);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

