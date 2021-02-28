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
    $kat_id = $_GET['set'];
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
                         $sth = $pdo->prepare("SELECT * FROM kategorie WHERE k_id LIKE ?");
                         $sth->execute(array($kat_id));
                         $row = $sth->fetch(PDO::FETCH_ASSOC);
                         $k_nazov = $row['k_nazov'];
                         $k_vytvorena = $row['k_vytvorena'];
                         $k_update = $row['k_update'];
                         $k_akt = $row['k_aktualni'];


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
            $kat_akt = 1;
        } else {
            $kat_akt = 0;
        }
        if(empty($_POST['kat_move'])){
            $kat_move = false;
        } else {
            $kat_move = $_POST['kat_move'];
        }
        $date = date('d.m.y');
        $datum = date_format (new DateTime($date), 'd.m.Y');

        $sql = "UPDATE kategorie SET k_id=?, k_nazov=?, k_aktualni=? WHERE k_id=?";
        $stmt= $pdo->prepare($sql);
        if($stmt->execute([$id_kat, $k_name, $kat_akt, $kat_id])){
            $alert = '<div style="margin-top: 10px; padding: 5px !important;" class="alert alert-success" role="alert">Zmeny boli úspešné nahrané!</div>';
        } else {
            $error = '<div class="alert alert-success" role="alert">Zmeny sa nepodarilo nahrať na server!</div>';
        }

    }
?>
<body style="background-color: transparent">
    <h3 style="text-align: left;">Úprava kategórie</h3>
    
    <form method="post" action="">
        <label>ID Kategórie</label>
        <input style="border-radius: 10px;" class="form-control" value="<?php echo $kat_id ?>" type="text" name="k_id">
        <label>Názov kategórie</label>
        <input style="border-radius: 10px;" class="form-control" value="<?php echo $k_nazov ?>" type="text" name="k_name">
        <label>Zaradiť kategóriu za:</label>
        <select style="border-radius: 10px;" name="kat_sort" class="form-control">
            <option>Vyberte</option>
        </select>
        <label>Aktuálna kategória:</label>
        <select style="border-radius: 10px;" name="kat_akt" class="form-control">
            <option value="1">Áno</option>
            <option value="0">Nie</option>
        </select>
        <label>Presun kategórie do inej kategórie:</label>
        <select style="border-radius: 10px;" name="kat_move" class="form-control">
            <option></option>
            <option>Nie</option>
        </select>
        <br>
        <span>Dátum vytvorenia: <b><?php echo date_format (new DateTime($k_vytvorena), 'd.m.Y'); ?></b></span><br>
        <span>Dátum poslednej úpravy: <b><?php echo date_format (new DateTime($k_update), 'd.m.Y'); ?></b></span><br><br>
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
