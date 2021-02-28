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

</style>
<?php 

$error = "";


if(isset($_GET['set'])){
    $v_id = $_GET['set'];
                         $sth = $pdo->prepare("SELECT * FROM vyrobcovia WHERE v_id LIKE ?");
                         $sth->execute(array($v_id));
                         $row = $sth->fetch(PDO::FETCH_ASSOC);
                         $v_nazov = $row['v_nazov'];
                         $v_vytvorena = $row['v_vytvorena'];
                         $v_update = $row['v_update'];
                         $v_kod = $row['v_kod'];


    if(isset($_POST['save'])){
        if(empty($_POST['k_id'])){
           $id_kat = $kat_id; 
        } else {
            $id_kat = $_POST['k_id'];
        }
        if(empty($_POST['k_name'])){
            $k_name = $k_nazov;
        } else {
            $k_name = $_POST['k_name'];
        }
        if(empty($_POST['kat_sort'])){
            $kat_sort = "";
        } else {
            $kat_sort = $_POST['kat_sort'];
        }
        if(empty($_POST['kat_akt'])){
            $kat_akt = $k_akt;
        } else if($_POST['kat_akt'] == "1") {
            $kat_akt = $_POST['kat_akt'];
        } else {
            $kat_akt = $_POST['kat_akt'];
        }
        if(empty($_POST['kat_move'])){
            $kat_move = false;
        } else {
            $kat_move = $_POST['kat_move'];
        }
        $date = date('d.m.y');
        $datum = date_format (new DateTime($date), 'd.m.Y');

        $sql = "UPDATE vyrobcovia SET k_id=?, k_nazov=?, k_aktualni=? WHERE k_id=?";
        $stmt= $pdo->prepare($sql);
        if($stmt->execute([$id_kat, $k_name, $kat_akt, $kat_id])){
            $alert = '<div style="margin-top: 10px; padding: 5px !important;" class="alert alert-success" role="alert">Zmeny boli úspešné nahrané!</div>';
        } else {
            $error = '<div class="alert alert-success" role="alert">Zmeny sa nepodarilo nahrať na server!</div>';
        }

    }
?>
<body style="background-color: transparent">
    <h3 style="text-align: left;">Úprava výrobcu</h3>
    
    <form method="post" action="">
        <label>ID výrobcu:</label>
        <input style="border-radius: 10px;" class="form-control" value="<?php echo $v_id ?>" type="text" name="v_id">
        <label>Názov výrobcu:</label>
        <input style="border-radius: 10px;" class="form-control" value="<?php echo $v_nazov ?>" type="text" name="v_name">
        <label>Kód výrobcu:</label>
        <input style="border-radius: 10px;" class="form-control" value="<?php echo $v_kod ?>" type="text" name="v_name">
        <br>
        <span>Dátum vytvorenia: <b><?php echo date_format (new DateTime($v_vytvorena), 'd.m.Y'); ?></b></span><br>
        <span>Dátum poslednej úpravy: <b><?php echo date_format (new DateTime($v_update), 'd.m.Y'); ?></b></span><br><br>
        <div clas="justify-content-between text-right">
            <button style="margin-left: 7%" type="submit" name="save" onclick="submitform()" class="btn btn-dark">Uložiť</button>
        </div>
        
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
