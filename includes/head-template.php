<?php 
 $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
 $cart = json_decode($cart);

?>
<?php include "dir.php" ?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>FESI comp, s.r.o</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <script src="../assets/js/search-template.js" type="text/javascript"></script>
    
    <meta name="google-signin-client_id" content="238466960669-o9vmi5uorbemeudllt4f5chf5auq0kia.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" ></script>
    <script>
        gapi.load('auth2', function(){
            gapi.auth2.init();
        });
    </script>
    
</head>
<body>
<?php

?>
