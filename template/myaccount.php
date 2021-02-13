<?php 
include "../includes/head-template.php";

if(isset($_POST['logout'])){
    unset($_COOKIE['user']);
    unset($_COOKIE['G_AUTHUSER_H']);
    unset($_COOKIE['G_ENABLED_IDPS']);
    setcookie('user', null, -1, "/");
    setcookie('G_AUTHUSER_H', null, -1, "/");
    setcookie('G_ENABLED_IDPS', null, -1, "/");
    header("Location: ../index.php");
}
include "../includes/header-template.php";
?>
<script>
function signOut(){
    gapi.auth2.getAuthInstance().signOut().then(()=>console.log('ODHLASENY'));
}
function onLoad(){
    gapi.load('auth2',function(){
        gapi.auth2.init();
    })
}
</script>
<form method="post" action="#">
<input type="submit" name="logout" value="odhlasiť">
</form>
<script src="https://apis.google.com/js/platform.js"></script>