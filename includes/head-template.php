<?php 
 $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
 $cart = json_decode($cart);
 require_once "../config.php";
// DATA GATHERING 
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
 $browser = 'Internet explorer';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
 echo 'Internet explorer';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
 $browser = 'Mozilla Firefox';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') !== FALSE)
 $browser = 'Microsoft Edge';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
 $browser = 'Google Chrome';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
 $browser = "Opera Mini";
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
 $browser = "Opera";
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
 $browser = "Safari";
else
 $browser = 'Else';

    $date = date('d.m.y');
    $datum = date_format (new DateTime($date), 'd.m.Y');
    $ip =  $_SERVER['REMOTE_ADDR'];
    
    $sth = $pdo->prepare("SELECT * FROM visitors WHERE ip_add = ?");
    $sth->execute(array($ip));
    if($sth->rowCount() == 1){
        
    } else {
        $sth = $pdo->prepare("INSERT INTO visitors (ip_add, browser, visit_date) VALUES (?, ?, ?)");
        $sth->execute(array($ip, $browser, $datum));
    }

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FESI comp, s.r.o</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/lightbox.js"></script>
    <link href="../assets/css/lightbox.css" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <script src="../assets/js/search-template.js" type="text/javascript"></script>



    




    <script src="../assets/js/bootstrap.js" type="text/javascript"></script>
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
