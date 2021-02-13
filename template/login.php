<?php 
$db_host = "localhost";
$db_name = "compsnv";
$db_user = "root";
$db_pass = "";


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

$error = "";
$error_pass = "";
$error_pass2 = "";
$menicko = "";
$password = "";
$hesielko = "";


echo $password;
if(isset($_POST['bimbambum'])){
   
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sth = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $sth->execute(array($email));
    if($sth->rowCount() == 1){
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $password = $row['heslo'];
        $emailik = $row['email'];
    }
    if(empty($_POST['password'])){
        $error_pass = "<div class='alert alert-danger' role='alert'>Nezadal si heslo!</div>";    
    } else if(isset($_POST['password'])){
        
        if(password_verify($pass, $password)){
            $error_pass = ""; 
        } else {
        $error_pass = "<div class='alert alert-danger' role='alert'>Zlé heslo!</div>";
        } 
    }
    
    if(empty($_POST['email'])){
        $error = "<div class='alert alert-danger' role='alert'>Nezadal si meno!</div>";  
    } else if($email == $emailik){
        $error = "";
    } else {
        $error = "<div class='alert alert-danger' role='alert'>
        Neexistuje žiaden účet s týmto menom
        </div>";
    } 
    if($error == "" && $error_pass == ""){
        setcookie('user', $email, time() + 3600, "/");
        header("location: myaccount.php");
    }
}

?>
<?php include "../includes/head-template.php";?>
    <?php include "../includes/header-template.php" ?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="heading-login">
                    <h2 style="text-align: center">PRIHLÁSENIE</h2>
                </div>
                <div><?php echo $error ?></div>
                <div><?php echo $error_pass ?></div>
                <div class="login-form">
                    <div class="container" style="padding: 5% 25% 0% 25%">
                        <form method="post" action="">
                            <div class="form-group">
                                <input class="form-control" name="email" type="text" placeholder="e-mail..."><br>
                                <input class="form-control" name="password" type="password" placeholder="heslo...">
                                <div class="d-flex justify-content-center" style="padding: 5%">
                                    <button type="submit" name="bimbambum" class="btn btn-dark">Prihlásiť sa<i class="fas fa-sign-in-alt"></i></button>
                                </div>
                            </div>
                        </form>   
                        <h2 style="text-align: center">Alebo sa prihláste pomocou</h2>
                        <hr>
                        <div class="third-party-login d-flex" style="padding: 5% 25% 15% 25%">
                                <div class="g-signin2" data-onsuccess="onSignIn"></div>         
                        </div>
                        <h2 style="text-align: center">NIE STE ČLENOM?</h2>
                        <hr>
                            <div class="form-group">
                                <div class="d-flex justify-content-center" style="padding: 5%">
                                    <a href="register.php"><button class="btn btn-dark">Registrovať sa <i class="fas fa-user-plus"></i></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"?>
    <?php include "../includes/scripts.php"?>
    
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var name = profile.getName();
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        googleUser.disconnect();
            
        window.location.replace('http://localhost/fesicomp.eu/template/redirect.php?idtoken=' + id_token + "&name=" + name);
      }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</body>
</html>