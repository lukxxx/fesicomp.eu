<?php 
require_once "config.php";
$login = "";
$login_err = "";
$pass = "";
$pass_err = "";

if(isset($_COOKIE['admin'])){
    header("Location: ./dashboard");
}

if(!isset($_COOKIE['admin'])) {
    if(isset($_POST['submit'])){
         $pass = $_POST['heslo'];
         $login = $_POST['login'];

        $sth = $pdo->prepare("SELECT * FROM administracia WHERE admin_login = ?");
        $sth->execute(array($login));
        if($sth->rowCount() == 1){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $password = $row['heslo'];
            $admin_login = $row['admin_login'];
        } else {
            $admin_login = "";
            $password = "";
        }
        if(empty($_POST['login'])){
            $login_err = "<div class='alert alert-danger' role='alert'>Nezadal si meno!</div>";  
        } else if($login == $admin_login){
            $login_err = "";
        } else {
            $login_err = "<div class='alert alert-danger' role='alert'>
            Neexistuje žiaden účet s týmto menom
            </div>";
        } 
        if(empty($_POST['heslo'])){
            $pass_err = "<div class='alert alert-danger' role='alert'>Nezadal si heslo!</div>";    
        } else if(isset($_POST['heslo'])){
            
            if($pass == $password){
                $pass_err = ""; 
            } else if($pass != $password) {
                $pass_err = "<div class='alert alert-danger' role='alert'>Zlé heslo!</div>";
            } 
        }
        if($login_err == "" && $pass_err == "" && $try < 3){
            setcookie('admin', $login, time() + 3600, "/");
            header("Location: ./dashboard");
        } else if($login_err != "" || $pass_err != "" || $try == 3){
            $error = "<div class='alert alert-danger' role='alert'>Neplatné meno alebo heslo. Skúste znova!</div>";
        } 
    }
}


?>


<!DOCTYPE html>
<html lang="sk">
    <?php include($_SERVER['DOCUMENT_ROOT']."admin/includes/head.php")?>
<body class="login-bg ">
    <div class="justify-content-center d-flex align-items-center align-items-center">
        <div class="container-login ">
            <img src="assets/images/logo.png" alt="logo" width="100px" style="margin: 0px 15px 15px 0px; float: left;">
            <h2 style="color:white">Admin</h2>
            <h2 style="color:white">Login</h2><br>
            <?php if(isset($error)){
                echo $error;
            } ?>
            <form class="" method="post" action="#">
                <div class="form-group">
                    <input class="form-control input-lg" type="text" name="login" id="login" placeholder="login" />
                </div>
                <div class="form-group">
                    <input class="form-control input-lg" type="password" name="heslo" placeholder="heslo" />
                </div>
                <div class="form-group text-center ">
                    <input type="submit" name="submit" class="login-button" value="Prihásiť sa" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>