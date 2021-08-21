<?php 
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}

// if(!isset($_COOKIE['details'])){
//     header("Location: /kosik/dorucovacie-udaje");
// }
$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

$total = 0;

foreach ($cart as $c)
{
    $total += $c->product->p_cena * $c->quantity;
}
if(isset($_POST["summary"])){
    if(isset($_POST["platba"])){
        $platba = $_POST["platba"];
        if($platba == "hotovost"){
            $platba = "V hotovosti";
        } else if($platba == "kurier-dobierka"){
            $platba = "Dobierkou pri prevzatí od kuriéra";   
        } else {
            $platba = "Platba kartou online službou TrustPay";
        }
    } else {
        header("Location: /kosik");
    }
    if(isset($_POST["doprava"])){
        $doprava = $_POST["doprava"];
        if($doprava == "osobny-odber"){
            $doprava = "Osobný odber na predajni";
        } else {
            $doprava = "Slovenská pošta na adresu";
        }
    } else {
        header("Location: /kosik");
    }
}
foreach ($details as $d){
    $name = $d->name;
    $surname = $d->surname;
    $email_z = $d->email;
    $tel = $d->number;
    $city = $d->city;
    $street = $d->street;
    $psc = $d->psc;
}
include $root_dir."/includes/header.php" ?>


    <div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <a style="color: black; font-size: 18px;" href="/kosik/doprava-platba"><i class="fas fa-arrow-left"></i> Späť na dopravu a platbu</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold; text-transform: uppercase;">súhrn objednávky</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            
            
        </div>
    </div>
    <hr>
    <br>
    <div class="container" style="padding: 0% 25% 0% 25%">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span style="text-decoration: underline; font-size: 19px;">Produkty:</span><br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="table">
                    <?php
                    if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") {
                        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                        $cart = json_decode($cart);
                        $total = 0;
                        echo '<table class="table  table-bordered">';
                        echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">Produkt</th>';
                        echo '<th scope="col">Názov produktu</th>';
                        echo '<th scope="col">Cena</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($cart as $c) {
                            $total += $c->product->p_cena * $c->quantity;
                    ?>
                            <tr>
                                <th style="padding: 20px;"><?php echo "<img src='https://compsnv.sk/catalog/" . $c->product->p_id . "/" . $c->product->p_img . "' width='50'>" ?></th>
                                <th style="padding: 20px;"><a style='color: black;' href="<?php echo $root_url?>/produkt/<?php echo replaceAccents($c->product->p_nazov) ?>"><?php echo $c->product->p_nazov ?></a></th>
                                <th style="padding: 20px;"><span style="color: #B81600;"><?php echo number_format($c->product->p_cena * 1.2, 2, '.', '') ?>€</span></th>
                            </tr>

                    <?php
                        }
                    } else {
                        $total = 0;
                        echo "<span style='text-align: center; font-weight: bold;'>Nákupný košík je prázdny!</span>";
                    }

                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-sm-12 col-md-12 col-lg-12 summary-order-card" style="background-color: white; padding: 40px; border: 1px solid #e8e8e8 !important;">
                <span style="font-size: 20px; text-align: left; font-weight: bold;">Fakturačné údaje:</span>
                <hr>
                <div class="text-left">
                    <span style="font-size: 18px"><b>Meno a priezvisko: &nbsp&nbsp</b> <?php echo " ".$name." ".$surname ?> </span><br><br>
                    <span style="font-size: 18px"><b>Kontaktný email: &nbsp&nbsp</b> <?php echo " ".$email_z ?> </span><br><br>  
                    <span style="font-size: 18px"><b>Telefónne číslo: &nbsp&nbsp</b> <?php echo " ".$tel ?> </span><br><br>
                    <span style="font-size: 18px"><b>Adresa doručenia: &nbsp&nbsp</b> <?php echo " ".$city.", ".$street.", ".$psc ?> </span><br><br>    
                </div> 
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12" style="background: #e7e7e7; padding: 40px; border: 1px solid grey !important;">
                <span style="font-size: 20px; text-align: left; text-decoration: underline;">Doprava a platba:</span>
                <hr>
                <div class="text-left">
                    <span style="font-size: 18px"><b>Spôsob platby: &nbsp&nbsp</b> <?php echo " ".$platba; ?> </span><br><br>
                    <span style="font-size: 18px"><b>Spôsob dopravy: &nbsp&nbsp</b> <?php echo " ".$doprava; ?> </span><br>
                </div>
            </div>
        </div>
    </div>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
     
    </div>

    <?php include $root_dir."/includes/footer.php"?>
</body>
</html>