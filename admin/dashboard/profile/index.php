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
                            <h4 style="font-size: 30px; font-weight: bold; padding-top: 1%; padding-bottom: 1%">Správa administrátorského účtu</h4>
                        </div>
                        
                    </div>
                    <div class="stats" style="border: 1px solid #E7E7E7; padding-left: 3%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
                        <div class="row">
                            <h6 style="font-size: 30px; font-weight: bold; padding-top: 1%">Hlavný účet</h6><br>
                            <?php 
                            $like = "%" . $_COOKIE['admin'] . "%";
                            $sth = $pdo->prepare("SELECT * FROM administracia WHERE admin_meno LIKE ?");
                            $sth->execute(array($like));
                            if($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                $admin_meno = $row['admin_meno'];
                            }
                            ?>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <span><b>Prihlasovacie meno: </b> <?php echo $admin_meno ?></span>
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