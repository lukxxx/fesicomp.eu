<?php 
$hostname = "localhost";
$user = "root";
$pass = "";
$db_name = "search";
$link = mysqli_connect($hostname, $user, $pass, $db_name);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php /*
$hostname = "localhost";
$user = "root";
$pass = "";
$db_name = "search";
$link = mysqli_connect($hostname, $user, $pass, $db_name);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>