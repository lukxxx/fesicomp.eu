<?php 
require_once '../vendor/autoload.php';
$id_token = "";
if(isset($_GET['idtoken'])){
    $id_token = $_GET['idtoken'];
}
if(isset($_GET['name'])){
    $name = $_GET['name'];
}
if(isset($_GET['photo'])){
    $photo = $_GET['photo'];
}
if(isset($_GET['email'])){
    $email = $_GET['email'];
}
if(isset($_GET['fullname'])){
    $full_name = $_GET['fullname'];
}
$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
$payload = $client->verifyIdToken($id_token);
if ($payload) {
    $userid = $payload['sub'];
    setcookie('user', $name, time() + 3600, "/");
    setcookie('user-mail', $email, time() + 3600, "/");
    header("Location: myaccount.php?idtoken=".$id_token."&name=".$name."&photo=".$photo."&email=".$email."&fullname=".$full_name);
    //$domain = $payload['hd'];
} else {
  // Invalid ID token
}
