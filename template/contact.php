<?php
$db_host = "localhost";
$db_name = "compsnv";
$db_user = "root";
$db_pass = "";
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="sk">
<?php include_once "../includes/head-template.php";?>
<body>
<?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 4%;">
        <div class="row d-flex justify-content-center">
            <div class="col-2 col-sm-9 col-md-3 col-lg-3"></div>
            <div class="col-8 col-sm-9 col-md-6 col-lg-6">
                <h2 class="text-center">Kontaktujte nás</h2>
                <br>
                <div class="contact-form">
                    <div class="container" style="padding: 3% 0 0 0">
                            <form method="post" action="">
                                <div class="form-group">
                                    <input style="margin: 1%; border-radius: 8px;" class="form-control" name="name" type="text" placeholder="Meno...">
                                    <input style="margin: 1%; border-radius: 8px;" class="form-control" name="email" type="password" placeholder="E-mail...">
                                    <textarea style="resize: none; margin: 1%; height: 25vh; border-radius: 8px;" name="message" class="form-control" rows="4" cols="50" placeholder="Vaša správa..."></textarea>
                                    <div class="d-flex justify-content-center" style="padding: 5%">
                                        <button type="submit" name="send_message" class="btn btn-dark">Odoslať <i class="fa fa-paper-plane-o"></i></button>
                                    </div>
                                </div>
                            </form>   
                    </div>
                </div>
            </div>
            <div class="col-2 col-sm-9 col-md-3 col-lg-3"></div>
        </div>


        <div style="margin-top: 3%;" class="row d-flex justify-content-center">
            <h2 class="text-center">Otváracie hodiny</h2>
        </div>
        <div class="row d-flex justify-content-center" style="margin-bottom: 5%; font-size: 15px;">
            <div class="col-sm-9 col-md-4 col-lg-4 text-left">
                <br>
                <br>
                <?php
                    $query_konstanty = "SELECT * FROM konstanty LIMIT 13";
                    $result = $link->query($query_konstanty);
                    $kluc = 0;
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                            {
                                echo "<span>".$row['k_konstanta']."</span>";
                                echo "<br>";
                            }
                    } else 
                        {
                        echo "Žiadny výsledok";
                        } 
                    $link ->close();
                ?>
            </div>
            <div class="col-sm-9 col-md-4 col-lg-4 text-center">
                <br>
                <br>
                <span>Otváracia doba: </span><br>
                <span>Pondelok - Piatok: od <strong>9.00</strong> do <strong>17.00</strong></span><br>
                <span>Sobota - zatvorené</span><br>
                <span>Nedeľa - zatvorené</span>
            </div>
            <div class="col-sm-9 col-md-4 col-lg-4 text-left">
                <br>
                <br>
                <span>Účtovné údaje:</span><br>
                <span><strong>IČO:</strong> 36597431</span><br>
                <span><strong>IČ DPH(DIČ):</strong> SK2022067322</span><br>
                <br>
                <span>Bankové spojenie:</span>
                <br>
                <span>Československá obchodná banka a.s. - ČSOB</span><br>
                <span>Účet: 4023752975/7500</span>
                <span>IBAN: SK11 7500 0000 0040 2375 2975</span>
                <span>SWIFT: CEKOSKBX</span>
            </div>
        </div>

    </div>
    <?php include (ROOT. "includes/footer.php") ?>

</body>
</html>