<?php
$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);
require_once "config.php";

// DATA GATHERING 
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    $browser = 'Internet explorer';
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
    echo 'Internet explorer';
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
    $browser = 'Mozilla Firefox';
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') !== FALSE)
    $browser = 'Microsoft Edge';
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
    $browser = 'Google Chrome';
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
    $browser = "Opera Mini";
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
    $browser = "Opera";
elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
    $browser = "Safari";
else
    $browser = 'Else';

$date = date('d.m.y');
$datum = date_format(new DateTime($date), 'd.m.Y');
$ip =  $_SERVER['REMOTE_ADDR'];

$sth = $pdo->prepare("SELECT * FROM visitors WHERE ip_add = ?");
$sth->execute(array($ip));
if ($sth->rowCount() == 1) {
} else {
    $sth = $pdo->prepare("INSERT INTO visitors (ip_add, browser, visit_date) VALUES (?, ?, ?)");
    $sth->execute(array($ip, $browser, $datum));
}
function replaceAccents($str) {
    $search = explode(",",
"á,ä,č,ď,dž,é,ě,í,ĺ,ľ,ň,ó,ô,ŕ,ř,š,ť,ú,ů,ý,ž,Á,Ä,Č,Ď,DŽ,É,Ě,Í,Ĺ,Ľ,Ň,Ó,Ô,Ŕ,Ř,Š,Ť,Ú,Ů,Ý,Ž");
    $replace = explode(",",
"a,a,c,d,dz,e,e,i,l,l,n,o,o,r,r,s,t,u,u,y,z,A,A,C,D,DZ,E,E,I,L,L,N,O,O,R,R,S,T,U,U,Y,Z");
    $newstring = str_replace($search, $replace, $str);
    $newstring = strtolower($newstring);
    $newstring = str_replace(' ', '-', $newstring);
    $newstring = str_replace(',', '-', $newstring);
    $newstring = str_replace('.', '', $newstring);
    $newstring = str_replace('/', '', $newstring);
    $newstring = str_replace('™', '', $newstring);
    $newstring = str_replace('+', '', $newstring);
    $newstring = str_replace('*', '', $newstring);
    $newstring = str_replace('"', '', $newstring);
    $newstring = str_replace(')', '', $newstring);
    $newstring = str_replace('(', '', $newstring);
    return $newstring;
}
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FESI comp, s.r.o</title>
    <link rel="stylesheet" href="https://fesicomp.sitecult.sk/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://fesicomp.sitecult.sk/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="shortcut icon" href="https://fesicomp.sitecult.sk/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <script src="https://fesicomp.sitecult.sk/assets/js/search.js" type="text/javascript"></script>

    <script src="https://fesicomp.sitecult.sk/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <meta name="google-signin-client_id" content="238466960669-o9vmi5uorbemeudllt4f5chf5auq0kia.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js"></script>
    <script>
        gapi.load('auth2', function() {
            gapi.auth2.init();
        });
    </script>
    <script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script>
    <script>
        window.start.init({
            Palette: "palette1",
            Theme: "block",
            Mode: "banner bottom",
            Time: "5",
            Message: "Naša webová stránka používa súbory cookies na zabezpečenie najlepšej funkcionality pre zákazníkov e-shopu",
            ButtonText: "Zavrieť",
            LinkText: "Prečítať viac",
            Location: "fesicomp.sitecult.sk/cookies",
        })
    </script>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0" nonce="MDfiPyPX"></script>