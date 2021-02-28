<?php 
include "../../includes/head-sub.php";


$date = date('d.m.y');

$date_day = date('d.m');
$date_mon = date('m');
$date_month = ".".$date_mon.".";
$date_year = date('y');


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
                        
                         

$nadpis = "FESICOMP.EU";
if(isset($_COOKIE['admin'])){
    if(isset($_POST['logout'])){
        header("Location: gdbay.php");
    }
}
if(!isset($_COOKIE['admin'])){
    header("Location: ../");
}
if(isset($_COOKIE['admin'])){ ?>
<div class="container-fluid">
    <div class="row">
        <div style="background-color: #303030; width: 100%; height: 1080px" class="col-sm-2 col-md-2 col-lg-2">
            <?php include "../../includes/side-panel.php"; ?>
        </div>
        
        <div  style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
            <?php include "../../includes/header-temp.php"; ?>               
            <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
            <div class="row" style="padding: 40px" >
                
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; margin-bottom: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                        <div class="row">
                            <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%; padding-bottom: 1%">Správa administrátorských účtov</h4>
                        </div>
                        
                    </div>
                    <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; padding-bottom: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php 
                                $like = "%" . $_COOKIE['admin'] . "%";
                                $sth = $pdo->prepare("SELECT * FROM administracia WHERE admin_login LIKE ?");
                                $sth->execute(array($like));
                                if($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                    $admin_meno = $row['admin_login'];
                                    $admin_heslo = $row['heslo'];
                                    $admin_level = $row['admin_level'];
                                    $meno_admin = $row['admin_meno'];
                                    $surname_admin = $row['admin_priezvisko'];
                                }
                                if(isset($_POST['update'])){
                                    if(empty($_POST['login'])){
                                        $error_login = "Login nemôže byť prázdny";
                                    } else {
                                        $login = $_POST['login'];
                                        $error_login = "";
                                    }
                                    if(empty($_POST['password'])){
                                        $pass_err = "Heslo nemôže byť prázdne";
                                    } else {
                                        $pass = $_POST['password'];
                                        $pass_err = "";
                                    }
                                    if(empty($_POST['meno'])){
                                        $meno_err = "Meno nemôže byť prázdne";
                                    } else {
                                        $meno = $_POST['meno'];
                                        $meno_err = "";
                                    }
                                    if(empty($_POST['priezvisko'])){
                                        $surname_err = "Priezvisko nemôže byť prázdne!";
                                    } else {
                                        $surname = $_POST['priezvisko'];
                                        $surname_err = "";
                                    }
                                    $level = $_POST['level'];

                                    if($error_login != "" || $pass_err != "" || $meno_err != "" || $surname_err != ""){
                                        $general_error = "Aktualizácia dát nebola úspešná!";
                                    } else {
                                        $sql = "UPDATE administracia SET admin_login=?, heslo=?, admin_meno=?, admin_priezvisko=?, admin_level=? WHERE admin_login=?";
                                        $stmt= $pdo->prepare($sql);
                                        $stmt->execute([$login, $pass, $meno, $surname, $level, $admin_meno]);
                                        $success_notice = "Aktualizácia dát prebehla úspešne";
                                    }
                                }

                                ?>
                                <h6 style="font-size: 30px; font-weight: bold; padding-top: 1%"><?php if($admin_level == "1"){ echo "Hlavný účet"; } else { echo "Sub-administrátorský účet"; } ?></h6><br>
                                
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-left" style="border-right: 1px solid black;">
                                    <h6 style="font-size: 30px; font-weight: bold; padding-top: 1%; text-align: center;">Vaše údaje</h6>
                                        <?php if(isset($_POST['update']) && isset($success_notice)){
                                            echo '<div class="alert alert-success" role="alert">'.$success_notice.'</div>';
                                        } else if(isset($_POST['update']) && isset($general_error)){
                                            echo '<div class="alert alert-danger" role="alert">'.$general_error.'</div>';
                                            if(isset($error_login) && $error_login != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$error_login.'</div>';
                                            } else {

                                            }
                                            if(isset($pass_err) && $pass_err != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$pass_err.'</div>';
                                            } else {

                                            }
                                            if(isset($meno_err) && $meno_err != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$meno_err.'</div>';
                                            } else {

                                            }
                                            if(isset($surname_err) && $surname_err !=""){
                                                echo '<div class="alert alert-danger" role="alert">'.$surname_err.'</div>';
                                            } else {
                                                
                                            }
                                        }
                                        ?>
                                        <script>
                                            setTimeout(function() {
                                                $('.alert').fadeOut('fast');
                                            }, 3000);
                                        </script>
                                        <form method="post" action="">
                                        <label style="font-weight: bold;">Prihlasovancie meno: </label>
                                        <input type="text" name="login" value="<?php echo $admin_meno ?>" class="form-control">
                                        <label style="font-weight: bold;">Bezpečnostné heslo: </label>
                                        <input type="password" name="password" value="<?php if(isset($admin_heslo)){ echo $admin_heslo; } else { echo "Nie je definované!"; } ?>" class="form-control">
                                        <label style="font-weight: bold;">Meno administrátora: </label>
                                        <input type="text" name="meno" value="<?php if(isset($meno_admin)){ echo $meno_admin; } else { echo "Nie je definované!"; } ?>" class="form-control">
                                        <label style="font-weight: bold;">Priezvisko administrátora: </label>
                                        <input type="text" name="priezvisko" value="<?php if(isset($surname_admin)){ echo $surname_admin; } else { echo "Nie je definované!"; } ?>" class="form-control">
                                        <label style="font-weight: bold;">Administratorská úroveň: </label>
                                        <select type="text" name="level" value="<?php if(isset($admin_level)){ echo $admin_level; } else { echo "Nie je definované!"; } ?>" class="form-control">
                                        <?php if($admin_level == "1"){
                                                echo '<option value="1">1</option>';
                                                echo '<option value="2">2</option>';
                                            } else {
                                                echo '<option value="1" disabled>1</option>';
                                                echo '<option value="2">2</option>';
                                            }
                                            ?>
                                        </select><br>
                                        <button class="btn btn-dark" name="update" type="submit"><i class="fas fa-sync"></i> Aktualizovať údaje</button>
                                        </form>
                                    </div>
                                    <?php
                                    if(isset($_POST['add'])){
                                    if(empty($_POST['login'])){
                                        $error_login = "Login nemôže byť prázdny";
                                    } else {
                                        $login = $_POST['login'];
                                        $error_login = "";
                                    }
                                    if(empty($_POST['password'])){
                                        $pass_err = "Heslo nemôže byť prázdne";
                                    } else {
                                        $pass = $_POST['password'];
                                        $pass_err = "";
                                    }
                                    if(empty($_POST['meno'])){
                                        $meno_err = "Meno nemôže byť prázdne";
                                    } else {
                                        $meno = $_POST['meno'];
                                        $meno_err = "";
                                    }
                                    if(empty($_POST['priezvisko'])){
                                        $surname_err = "Priezvisko nemôže byť prázdne!";
                                    } else {
                                        $surname = $_POST['priezvisko'];
                                        $surname_err = "";
                                    }
                                    $level = $_POST['level'];

                                    if($error_login != "" || $pass_err != "" || $meno_err != "" || $surname_err != ""){
                                        $general_error = "Aktualizácia dát nebola úspešná!";
                                    } else {
                                        $sql = "INSERT INTO administracia (admin_login,heslo,admin_meno,admin_priezvisko,admin_level) VALUES (?,?,?,?,?)";
                                        $stmt= $pdo->prepare($sql);
                                        $stmt->execute([$login, $pass, $meno, $surname, $level]);
                                        $success_notice = "Aktualizácia dát prebehla úspešne";
                                    }
                                }?>
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-left" style="padding-right: 3%">
                                    <?php if(isset($_POST['add']) && isset($success_notice)){
                                            echo '<div class="alert alert-success" role="alert">'.$success_notice.'</div>';
                                        } else if(isset($_POST['add']) && isset($general_error)){
                                            echo '<div class="alert alert-danger" role="alert">'.$general_error.'</div>';
                                            if(isset($error_login) && $error_login != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$error_login.'</div>';
                                            } else {

                                            }
                                            if(isset($pass_err) && $pass_err != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$pass_err.'</div>';
                                            } else {

                                            }
                                            if(isset($meno_err) && $meno_err != ""){
                                                echo '<div class="alert alert-danger" role="alert">'.$meno_err.'</div>';
                                            } else {

                                            }
                                            if(isset($surname_err) && $surname_err !=""){
                                                echo '<div class="alert alert-danger" role="alert">'.$surname_err.'</div>';
                                            } else {
                                                
                                            }
                                        }
                                        ?>
                                        <?php if($admin_level == "1"){ ?>
                                            <h6 style="font-size: 30px; font-weight: bold; padding-top: 1%; text-align: center;">Pridať užívateľa <i class="fas fa-user-plus"></i></h6>
                                        <form method="post" action="">
                                        <label style="font-weight: bold;">Prihlasovancie meno: </label>
                                        <input type="text" name="login" autofill="off" class="form-control">
                                        <label style="font-weight: bold;">Bezpečnostné heslo: </label>
                                        <input type="password" name="password" class="form-control">
                                        <label style="font-weight: bold;">Meno administrátora: </label>
                                        <input type="text" name="meno"  class="form-control">
                                        <label style="font-weight: bold;">Priezvisko administrátora: </label>
                                        <input type="text" name="priezvisko" class="form-control">
                                        <label style="font-weight: bold;">Administratorská úroveň: </label>
                                        <select type="text" name="level" class="form-control">
                                            <?php if($admin_level == "1"){
                                                echo '<option value="1" disabled>1</option>';
                                                echo '<option value="2">2</option>';
                                            } else {
                                                echo '<option value="1" disabled>1</option>';
                                                echo '<option value="2">2</option>';
                                            }
                                            ?>
                                            
                                        </select><br>
                                        <button class="btn btn-success" name="add" type="submit"><i class="fas fa-plus"></i> Pridať užívateľa</button>
                                        </form>
                                        
                                        <?php } else { ?>
                                            
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; padding-bottom: 3%; margin-bottom: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php 
                                $like = "%" . $_COOKIE['admin'] . "%";
                                $sth = $pdo->prepare("SELECT * FROM administracia");
                                $sth->execute();
                                ?>
                                <h6 style="font-size: 30px; font-weight: bold; padding-top: 1%">Prehľad administratorských účtov</h6><br>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 text-left" style="padding-right: 3%;">
                                        <table class="table">
                                            <thead class="thead-dark"> 
                                                <tr>
                                                    <th scope="col">Meno</th>
                                                    <th scope="col">Priezvisko</th>
                                                    <th scope="col">Úroveň</th>
                                                    <th scope="col">Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php 
                                           


                                            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                                $admin_meno = $row['admin_login'];
                                                $admin_heslo = $row['heslo'];
                                                $admin_level = $row['admin_level'];
                                                $meno_admin = $row['admin_meno'];
                                                $surname_admin = $row['admin_priezvisko'];

                                        ?>
                                            
                                               
                                            <tr>
                                            <th scope="row"><?php echo $admin_meno ?></th>
                                            <td><?php if(isset($meno_admin)){ echo $meno_admin; } else { echo "Nie je definované!"; } ?></td>
                                            <td><?php if(isset($admin_level)){ echo $admin_level; } else { echo "Nie je definované!"; } ?></td>
                                            <td>
                                                
                                                    <div class="d-flex justify-content-center">
                                                        <?php if($admin_level == 1){

                                                        } else {
                                                            echo '<form method="post" action="">';
                                                            echo '<button class="btn btn-danger" name="delete" value="'.$admin_meno.'" type="submit"><i class="fas fa-user-minus"></i></button>&nbsp;';
                                                            echo '</form>';
                                                        }
                                                        ?>
                                                    </div>
                                            </td>
                                            </tr>
                                        <?php }
                                             if(isset($_POST['delete'])){
                                                $sth=$pdo->prepare("DELETE FROM administracia WHERE admin_login LIKE ?");
                                                $sth->execute(array($admin_meno));
                                            }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div> 
               
            <div class="row" style="padding: 40px" >
                         
            </div> 
              
        </div>
    </div>
</div>
<script>

var span = document.getElementById('span');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}

setInterval(time, 1000);
</script>
<?php } ?>