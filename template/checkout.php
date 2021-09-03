<?php
if ($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs") {
    include $_SERVER['DOCUMENT_ROOT'] . "/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php";
}
if (!isset($_COOKIE['details'])) {
    header("Location: $root_url/");
} else if (!isset($_COOKIE['details2'])) {
    header("Location: $root_url/");
} else if (!isset($_COOKIE['cart'])) {
    header("Location: $root_url/");
}
$total = 0;

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

$details2 = isset($_COOKIE["details2"]) ? $_COOKIE["details2"] : "[]";
$details2 = json_decode($details2);

//GET UNIQUE TOKEN FOR ORDER

if (isset($_GET['h'])) {
    $token = $_GET['h'];

    //------------------------------------------------------------------------------
    //GET LAST ORDER ID FROM DATABASE

    $get_id_zakazky = $pdo->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
    while ($row = $get_id_zakazky->fetch()) {
        $id_zakazky = $row['id'];
        $id_zakazky = $id_zakazky + 1;
    }
    //------------------------------------------------------------------------------
    //GET CURRENT DATE

    $date = date('d.m.Y h:i:s', time());
    //------------------------------------------------------------------------------

    //GET CART DETAILS
    foreach ($cart as $c) {
        $total += $c->product->p_cena * $c->quantity;
        $productcode = $c->productCode;
        $quantity = $c->quantity;
        $p_cena = $c->product->p_cena;
    }
    $total = number_format($total * 1.2, 2, '.', '');
    $p_cena = number_format($p_cena * 1.2, 2, '.', '');
    echo $p_cena;
    //OVEROVANIE ČI JE ZAKAZNIK ZAREGISTROVANY
    //AK JE TAK SA Z DATABAZY ZOBERIE ID ZAKAZNIKA ABY SA MOHLO PRIRADIŤ K OBJEDNÁVKE
    //PREJDE SA CEZ OBE COOKIE DETAILS ABY SME MALI HODNOTY KTORÉ ZÁKAZNIK ZADAL

    if (isset($_COOKIE['user']) || isset($_COOKIE['user-login'])) {
        foreach ($details as $d) {
            $email = $d->email;
            $company_name = $d->company_name;
        }
        foreach ($details2 as $d) {
            $platba = $d->platba;
            $doprava = $d->doprava;
        }
        if (isset($_COOKIE['user'])) {
            $get_g_user = $pdo->prepare("SELECT id FROM g_users WHERE email LIKE ?");
            $get_g_user->execute([$email]);
            while ($row = $get_g_user->fetch()) {
                $zakaznik = $row['id'] . "G";
            }
        } else if (isset($_COOKIE['user-login'])) {
            $get_user = $pdo->prepare("SELECT id FROM users WHERE email LIKE ?");
            $get_user->execute([$email]);
            while ($row = $get_user->fetch()) {
                $zakaznik = $row['id'] . "L";
            }
        }
        if ($company_name == "") {
            $firma = 0;
        } else {
            $firma = 1;
        }
        $registracia = 1;
        //AK ZAKAZNIK NEMA UČET ZOBERU SA O NOM UPLNE VSETKY UDAJE ABY SA MOHLI VLOZIT DO DATABAZY
    } else {
        $zakaznik = array();
        foreach ($details as $d) {
            $telefon = $d->number;
            $name = $d->name;
            $priezvisko = $d->surname;
            $email = $d->email;
            $city = $d->city;
            $psc = $d->psc;
            $street = $d->street;
            $company_name = $d->company_name;
            $company_street = $d->company_street;
            $company_city = $d->company_city;
            $company_psc = $d->company_psc;
            $company_ico = $d->$company_ico;
            $company_dic = $d->$company_dic;
            $company_ic_dph = $d->company_ic_dph;
        }
        foreach ($details2 as $d) {
            $platba = $d->platba;
            $doprava = $d->doprava;
        }
        array_push($zakaznik, array(
            $telefon, $name, $priezvisko, $email, $city, $psc, $street,
            $company_name, $company_street, $company_city, $company_psc, $company_ico, $company_dic, $company_ic_dph
        ));
        $registracia = 0;
        if ($company_name == "") {
            $firma = 0;
        } else {
            $firma = 1;
        }
    }
    //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\\
    // INSERT OBJEDNAVKY DO TABULKY ORDERS 
    $empty = "";
    $stav = "Vybavuje sa";
    $sql = "INSERT INTO orders (id,token,datum_vytvorenia,datum_vybavenia,cena_objednavky,stav_objednavky,email,zakaznik_registrovany, zakaznik, firma, sposob_dopravy, sposob_platby) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $pdo->prepare($sql)->execute([$id_zakazky, $token, $date, $empty, $total, $stav, $email, $registracia, $zakaznik, $firma, $doprava, $platba]);

    //INSERT INFO O PRODUKTOCH DO TABULKY PREDANE_PRODUKTY
    foreach ($cart as $c) {
        $sql = "INSERT INTO sold (id_produktu,id_faktury,cena_ks,pocet_ks) VALUES (?,?,?,?)";
        if ($pdo->prepare($sql)->execute([$productcode, $id_zakazky, $p_cena, $quantity])) {
            echo "DOBRE PRODUKT";
        }
    }
    //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||\\
    //TODO: ROZPOSIELANIE EMAILOV ZAKAZNIKOVI A PREDAJNI

    //UNSETOVANIE COOKIES PO ZREALIZOVANI OBJEDNAVKY 
    if (isset($_COOKIE['details'])) {
        unset($details);
        unset($_COOKIE['details']);
        setcookie('details', null, time() - 3600, "$root_url/");
    }
    if (isset($_COOKIE['details2'])) {
        unset($details2);
        unset($_COOKIE['details2']);
        setcookie('details2', null, time() - 3600, "$root_url/");
    }
    if (isset($_COOKIE['cart'])) {
        unset($cart);
        unset($_COOKIE['cart']);
        setcookie('cart', null, time() - 3600, "$root_url/");
    }
}
include $root_dir . "/includes/header.php";
?>



<script>
    $(".fa-arrow-right").click(function() {
        $(this).toggleClass("down");
    });

    $('.fa-bars').click(function() {
        $(this).toggleClass("fa-times");
    });
</script>

<div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold; text-transform: uppercase;">Ďakujeme za objednávku!</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">


        </div>
    </div>
    <hr>
    <br>
    <div class="container" style="padding: 0% 25% 0% 25%">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h5 style="text-align: center;">Vašu objednávku číslo <b><?php echo $id_zakazky ?></b> sme zaznamenali a začíname na nej pracovať!</h5><br><br>
                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-1">
                        <i class="fas fa-envelope fa-3x"></i>
                    </div>
                    <div class="col-sm-12 col-md-10 col-lg-11">
                        <h4 style="text-align: left; padding-bottom: 60px"> Na Váš email práve v tejto chvíli mieri potvrdzujúci e-mail v ktorom nájdete detaily svojej objednávky.</h4>
                    </div>
                </div>
                <?php
                if (isset($_COOKIE['user']) || isset($_COOKIE['user-login'])) { ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-11">
                            <h4 style="text-align: right; padding-bottom: 60px"> Taktiež na správe vášho účtu si môžete zobraziť detaily o vašej novej objednávke</h4>
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-1">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                    </div>
                <?php } ?>

                <div class="text-center" style="margin-bottom: 20%;">
                    <a href="../"><button class="btn btn-dark">Späť domov!</button></a>
                    <?php if (isset($_COOKIE['user']) || isset($_COOKIE['user-login'])) { ?>
                        <a href="<?php echo $root_url ?>/moj-ucet"><button class="btn btn-dark">Môj účet</button></a>
                    <?php } ?>
                </div>

            </div>


        </div>
    </div>
</div>
<?php include $root_dir . "/includes/footer.php" ?>
</body>

</html>