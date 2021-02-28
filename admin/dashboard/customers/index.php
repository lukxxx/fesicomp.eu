<?php 
require_once "../../includes/head-sub.php";
require_once "../../config.php";
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$date = date('d.m.y');
$nadpis = "Prehľad zákazníkov";
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
            <h6>Pre zobrazenie detailov o zákazníkovi kliknite na ozubené koliesko</h6>
            <div class="row" style="padding: 40px" >
                <div class="col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid black;">
                    <form method="post" action="">
                        <div class="form-group has-search search-box" style="position: relative;z-index: 2;">
                                        
                            <input style="border-radius:30px;  outline: 0 !important; padding: 20px;" 
                                type="text" name="search" class="form-control search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hľadať v kategóriách...'" autocomplete="off" placeholder="  Hľadať v kategóriách..." >
                            <div class="result" style="display: none; margin-top: 10px"></div>
                                        
                        </div>
                    </form>
                    <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
                    <div class="categories" style="border: 1px solid #E7E7E7; padding: 20px; margin-bottom: 10px; background-color: white; box-shadow: 2px 2px 10px -2px #616161; border-radius: 20px;">
                        <h5></h5>
                        <table class="table table-sm" style="border-radius: 20px;">
                            <thead style="background-color: #717171; color: white">
                                <tr style="border-radius: 20px;">
                                <th style="text-align: left">Email</th>
                                <th style="text-align: left">Meno</th>
                                <th style="text-align: left">Bydlisko</th>
                                <th style="text-align: center">Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sth = $pdo->prepare("SELECT email, meno, priezvisko, mesto FROM users UNION SELECT email, meno, priezvisko, mesto FROM g_users");
                                $sth->execute();
                                while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                                    $meno = $row['meno']." ".$row['priezvisko'];
                                    $email = $row['email'];
                                    $mesto = $row['mesto'];
                                    $m = $row['meno']
                                ?>
                                <tr style="text-align: left">
                                <th ><?php echo $email ?></th>
                                <td><?php echo $meno ?></td>
                                <td><?php echo $mesto ?></td>
                                <td style="text-align: center"><form method="post" action="" >
                                
                                <button type="submit" name="set" value="<?php echo $m; ?>" class="btn" style="all:unset; cursor: pointer;"><i style="font-size: 20px" class="fas fa-cog"></i></button>
                                </form></td>
                                </tr>
                            
                        
                        <?php } ?>       
                         </tbody>
                            </table>   
                        
                    </div>
                </div>           
                <div class="col-sm-6 col-md-6 col-lg-6" style="border-left: 1px solid black;">
                
                    <?php if(isset($_POST['set'])){
                        
                        echo '<iframe style="width: 100%;border:none; height: 100%;" id="setting" name="setting" src="setting.php?set='.$_POST['set'].'" >&#160;</iframe>';
                        echo '<div class="d-flex align-left" style="margin-top: 0px">';
                        echo '<form method="post" action="">';
                        echo '<button type="submit" name="close" style="margin-right: 20px" class="btn btn-danger"><i class="fas fa-times"></i></button>';
                        echo '</form>';
                        echo '</div>'; 
                        
                        
                    } else if(isset($_POST['close'])){
                        echo '<iframe style="width: 100%;border:none; height: 100%;" id="setting" name="setting" src="" >';
                    } else if(isset($_POST['save'])){
                        echo '<iframe style="width: 100%;border:none; height: 100%;" id="setting" name="setting" src="" >';
                    } else {
                        echo "";
                    }
                    ?>
                    
                </div>                   
            </div>
        </div>
    </div>


<?php } ?>