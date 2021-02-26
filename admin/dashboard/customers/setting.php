<?php 
require_once "../../includes/head-sub.php";
require_once "../../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>setting.php</title>
</head>
<style>
form {
    text-align: left;
}
body {
    text-align: left;
}
h6 {
    color: #919191;
    font-size: 20px;
    font-weight: bold;
    padding: 10px 0px 10px 0px;
}
span {
    
}
</style>
<?php 

$error = "";


if(isset($_GET['set'])){
    $meno = $_GET['set'];
    $db_host = "db003.nameserver.sk";
                        $db_user = "compsnv_sk2";
                        $db_pass = "iQ8sh2lz";
                        $db_name = "compsnv_sk2";
                            
                        
                        
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
                         $sth = $pdo->prepare("SELECT email, meno, priezvisko, mesto, psc, ulica FROM users WHERE meno LIKE '%$meno%' UNION SELECT email, meno, priezvisko, mesto, psc, ulica FROM g_users WHERE meno LIKE '%$meno%'");
                         $sth->execute();
                         if($row = $sth->fetch(PDO::FETCH_ASSOC)){
                            $meno = $row['meno'];
                            $priezvisko = $row['priezvisko'];
                            $email = $row['email'];
                            $mesto = $row['mesto'];
                            $psc = $row['psc'];
                            $ulica = $row['ulica'];    
                         }
                         

    if(isset($_POST['save'])){
        
    }
?>
<body style="background-color: transparent">
    <h3 style="text-align: left;">Detail zákazníka</h3>
    <h6>Základné informácie:</h6>
    <span style="margin-bottom: 10px;"><b>Meno: </b> <?php echo $meno ?></span><br>
    <span><b>Priezvisko: </b> <?php echo $priezvisko ?></span><br>
    <span><b>Email: </b> <?php echo $email ?></span><br>
    <h6>Dodacie údaje:</h6>
    <span><b>Mesto: </b> <?php echo $mesto ?></span><br>
    <span><b>PSČ: </b> <?php echo $psc ?></span><br>
    <span><b>Ulica: </b> <?php echo $ulica ?></span><br>
    <?php 
    if(isset($alert)){
        echo $alert;
    } else if(isset($error)) {
        echo $error;
    }
    ?>
</body>
<?php } ?>
</html>
