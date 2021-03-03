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
    $faktura = $_GET['set'];
                         $sth = $pdo->prepare("SELECT id, id_zakaznika, meno, priezvisko, email, telefon, zaplatene, vybavene, zlava FROM faktury WHERE id LIKE '%$faktura%'");
                         if($sth->execute()){
                            $row = $sth->fetch(PDO::FETCH_ASSOC);
                                $id_objednavky = $row['id'];
                                        $id_zakaznika = $row['id_zakaznika'];
                                        $meno = $row['meno'];
                                        $priezvisko = $row['priezvisko'];
                                        $email = $row['email'];
                                        $telefon = $row['telefon'];
                                        $zaplatene = $row['zaplatene'];
                                        $vybavene = $row['vybavene'];
                                        $zlava = $row['zlava'];     
                         } else {
                             echo "zle je ";
                         }
                         

                        $sth = $pdo->prepare("SELECT * FROM predane_produkty WHERE id_faktury LIKE '%$faktura%'");
                        $sth->execute();
                        $row = $sth->fetch(PDO::FETCH_ASSOC);
                            $id_produktu = $row['id_produktu'];
                            $id_faktury = $row['id_faktury'];
                            $cena = $row['cena_ks'];
                            $pocet_ks = $row['pocet_ks'];
                        

    if(isset($_POST['update'])){
        $vybavene = $_POST['vybavene'];
        $zaplatene = $_POST['zaplatene'];
        $sth = $pdo->prepare("UPDATE faktury SET vybavene=?, zaplatene=? WHERE id=?");
        if($sth->execute(array($vybavene, $zaplatene, $id_objednavky))){
            $alert = "<div class='alert alert-success'>Zmeny boli úspešne uložené</div>";
        } else {
            $error = "<div class='alert alert-danger'>Zmeny sa neuložili!</div>";
        }
    }
?>
<body style="background-color: transparent">
    <h3 style="text-align: left;">Detail objednávky</h3>
    <h6>Základné informácie:</h6>
    <span style="margin-bottom: 10px;"><b>ID objednávky: </b> <?php echo $id_objednavky ?></span><br>
    <span><b>ID zakaznika: </b> <?php if($id_zakaznika == 0){ echo "Zákazník nakúpil bez registrácie alebo prihlásenia";} else { echo $id_zakaznika; } ?></span><br>
    <span><b>Meno: </b> <?php echo $meno ?></span><br>
    <span><b>Priezvisko: </b> <?php echo $priezvisko ?></span><br>
    <span><b>Email: </b> <?php echo $email ?></span><br>
    <span><b>Telefon: </b> <?php echo $telefon ?></span><br>
    <h6>Zakúpený tovar:</h6>

        <span><?php echo $id_produktu; ?></span>
    <h6>Celková cena objednávky:</h6>
    <h4 style="color: red;"><?php echo $cena; ?>€</h4>
    <h6>Stavy objednávky:</h6>
    <form method="post" action="">
    <label>Zaplatený stav</label>
    <select class="form-control" name="zaplatene">
        <option value="<?php echo $zaplatene?>">Objednávka je nezaplatená</option>
        <option value="1">Objednávka je zaplatená</option>
    </select>
    <label>Vybavený stav</label>
    <select class="form-control" name="vybavene">
        <option value="<?php echo $vybavene ?>">Objednávka je nevybavená</option>
        <option value="1">Objednávka vybavená</option>
    </select><br>
    <button class="btn btn-dark" type="submit" name="update">Uložiť</button>
    </form>
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
