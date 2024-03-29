<?php 
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}

// if(!isset($_COOKIE['details'])){
//     header("Location: $root_url/kosik/dorucovacie-udaje");
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

$platba = "";
$doprava = "";
$term = "";
$term_err = "";
$platba_err = "";
$doprava_err = "";

$show = "display: block;";
$hide = "display: none;";


include $root_dir."/includes/header.php" ?>

    <div class="container final-desktop" style="margin-top: 50px;">
        <div class="row d-flex">
            <div class="col-sm-12 col-md-3 col-lg-3" style="margin: 0 25px">
                <a style="color: black; font-size: 18px;" href="<?php echo $root_url ?>/kosik/dorucovacie-udaje"><i class="fas fa-arrow-left"></i> Späť na údaje</a>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 text-center" style="margin: 0 25px">
                <h2 style="font-weight: bold; text-transform: uppercase;">spôsob dopravy a platby</h2>
            </div>
        </div>
    </div>

    <div class="container final-mobile" style="margin-top: 50px;">
        <div class="row d-flex">
            <div class="col-sm-12 col-md-3 col-lg-3" style="margin: 0 25px">
                <a style="color: black; font-size: 18px;" href="<?php echo $root_url ?>/kosik/dorucovacie-udaje"><i class="fas fa-arrow-circle-left"></i> Späť na údaje</a>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 text-center" style="margin: 0 25px">
                <h2 style="font-weight: bold; text-transform: uppercase;">spôsob dopravy a platby</h2>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <div class="container final-desktop" style="padding: 0% 25% 0% 25%">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span style="text-decoration: underline; font-size: 19px;">Spôsob dopravy:</span><br>
                <form method="post" action="<?php echo $root_url ?>/kosik/suhrn-objednavky">
                    <?php if($doprava_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $doprava_err ?>
                    </div>
                    <?php } ?>
                    <div class="form-group d-flex" >
                        <img src="https://www.posta.sk/subory/37861/zakladne-logo-sp-na-stiahnutie-jpg.jpg" width="50" height="50" alt="posta-logo"><label style="padding: 2% 0% 2% 2%"><input  type="radio" name="doprava" value="posta"> Slovenská pošta </label>
                    </div>
                    <div class="form-group d-flex">
                        <i style="padding-left: 2%;" class="fas fa-box fa-2x"></i><label style="padding: 1px 0px 5px 18px"><input  type="radio" name="doprava" value="osobny-odber"> Osobný odber </label>
                    </div>
                    <?php if($platba_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $platba_err ?>
                    </div>
                    <?php } ?>
                    <span style="text-decoration: underline; font-size: 19px;">Spôsob platby:</span><br>
                    <div class="form-group d-flex" >
                        <img src="../assets/images/trustpay.jpg" width="100" height="50"><label style="padding: 2% 0% 2% 3.5%"><input disabled type="radio" name="platba" value="trustpay"> Platba kartou online (Pripravujeme pre Vás)</label>
                    </div>
                    <div class="form-group d-flex">
                        <i style="padding-left: 2%;" class="fas fa-truck fa-2x"></i><label style="padding: 1px 0px 5px 18px"><input  type="radio" name="platba" value="kurier-dobierka"> Platba dobierkou - platba pri prevzatí tovaru od kuriéra</label>
                    </div>
                    <div class="form-group d-flex">
                    <i style="padding-left: 2%;" class="fas fa-cash-register fa-2x"></i><label style="padding: 1px 0px 5px 25px"><input  type="radio" name="platba" value="hotovost"> V hotovosti (alebo platobnou kartou) osobne na predajni</label>
                    </div>
                    <hr>
                    <?php if($term_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $term_err ?>
                    </div>
                    <?php } ?>
                    <div class="form-group d-flex">
                       <label style="padding: 1px 0px 5px 25px"><input  type="checkbox" name="podmienky" required> Suhlasím s podmienkami s <a href="obchodne-podmienky.php" >obchodnými podmienkami</a></label>
                    </div>
                    <div class="submit text-center">
                        <button class="btn btn-dark" style="margin: 10px 10px 80px 10px;" type="submit" name="summary">Súhrn objednávky</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <div class="container final-mobile">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="margin: 0 25px;">
                <span style="text-decoration: underline; font-size: 19px;">Spôsob dopravy:</span><br>
                <form method="post" action="<?php echo $root_url ?>/kosik/suhrn-objednavky">
                    <?php if($doprava_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $doprava_err ?>
                    </div>
                    <?php } ?>
                    <div class="form-group d-flex" >
                        <img src="https://www.posta.sk/subory/37861/zakladne-logo-sp-na-stiahnutie-jpg.jpg" width="50" height="50" alt="posta-logo"><label style="padding: 2% 0% 2% 2%"><input  type="radio" name="doprava" value="posta"> Slovenská pošta </label>
                    </div>
                    <div class="form-group d-flex">
                        <i style="padding-left: 2%;" class="fas fa-box fa-2x"></i><label style="padding: 1px 0px 5px 18px"><input  type="radio" name="doprava" value="osobny-odber"> Osobný odber </label>
                    </div>
                    <?php if($platba_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $platba_err ?>
                    </div>
                    <?php } ?>
                    <span style="text-decoration: underline; font-size: 19px;">Spôsob platby:</span><br>
                    <div class="form-group d-flex" >
                        <img src="../assets/images/trustpay.jpg" width="100" height="50"><label style="padding: 2% 0% 2% 3.5%"><input disabled type="radio" name="platba" value="trustpay"> Platba kartou online (Pripravujeme pre Vás)</label>
                    </div>
                    <div class="form-group d-flex">
                        <i style="padding-left: 2%;" class="fas fa-truck fa-2x"></i><label style="padding: 1px 0px 5px 18px"><input  type="radio" name="platba" value="kurier-dobierka"> Platba dobierkou - platba pri prevzatí tovaru od kuriéra</label>
                    </div>
                    <div class="form-group d-flex">
                    <i style="padding-left: 2%;" class="fas fa-cash-register fa-2x"></i><label style="padding: 1px 0px 5px 25px"><input  type="radio" name="platba" value="hotovost"> V hotovosti (alebo platobnou kartou) osobne na predajni</label>
                    </div>
                    <hr>
                    <?php if($term_err != ""){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $term_err ?>
                    </div>
                    <?php } ?>
                    <div class="form-group d-flex">
                       <label style="padding: 1px 0px 5px 25px"><input  type="checkbox" name="podmienky" required> Suhlasím s podmienkami s <a href="obchodne-podmienky.php" >obchodnými podmienkami</a></label>
                    </div>
                    <div class="submit text-center">
                        <button class="btn btn-dark" style="margin: 10px 10px 80px 10px;" type="submit" name="summary">Súhrn objednávky</button>
                    </div>
                    
                </form>
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