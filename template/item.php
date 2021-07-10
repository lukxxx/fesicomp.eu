<?php
include($_SERVER['DOCUMENT_ROOT'] . "/includes/head.php");

if (isset($_COOKIE["cart"])) {
    $cart = $_COOKIE['cart'];
    $cart = json_decode($cart);
}


if (isset($id)) {

    $id = $id;
    
    $stmt = $pdo->query("SELECT * FROM produkty WHERE p_url LIKE '$id'");
    while ($row = $stmt->fetch()) {
        $id_produktu = $row['p_id'];
        $id_kat = $row['p_kid'];
        $nazov = $row['p_nazov'];
        $kod = $row['p_id'];
        $popis = $row['p_popis'];
        $cena = $row['p_cena'];
        $produkt_cislo = $row['p_pn'];
        $dostupnost = $row['p_sklad'];
        $pocet_ks = $row['p_dostup'];
        $obrazok = $row['p_img'];
    }
}
// if(isset($id_kat)){
//     $sqlko = "SELECT * FROM kategorie WHERE k_id='$id_kat'";
//     $resultik = mysqli_query($link, $sqlko) or die("Bad query");
//     $rowko = mysqli_fetch_array($resultik);
//     $kategoria = $rowko['k_nazov'];    
// }
if (file_exists("catalog/$id_produktu/$obrazok")) {
    $cesta = "<a href='catalog/$id_produktu/$obrazok' data-lightbox='set' ><img loading='lazy' src='../catalog/$id_produktu/$obrazok' class='obrazok_item'></a>";
} else {
    $cesta = "<img loading='lazy' src='assets/images/no-image.png' class='obrazok_item'>";
}
?>
<style>
    ul.tabs {
        margin: 0px;
        padding: 0px;
        list-style: none;

    }

    ul.tabs li {
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
    }

    ul.tabs li.current {
        background: #ededed;
        color: #222;
    }

    .tab-content {
        display: none;
        background-color: #ededed;
        padding: 15px;

    }

    .tab-content.current {
        display: block;
    }



</style>


<script>
    $(document).ready(function() {

        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })

    })
</script>


<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"); ?>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">
            <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/category-list.php"); ?>

        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 item_section">
            <?php


            $poloha_kategoria = $id_kat;
            $cesta_kat = array();
            while (true) {
                $vyssia_kategoria = "SELECT k_id, k_kid,k_nazov FROM kategorie WHERE k_id='$poloha_kategoria'";
                if ($stmt = mysqli_prepare($link, $vyssia_kategoria)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                array_push($cesta_kat, '<i class="fas fa-chevron-right"></i><a  style="padding-left: 8px;padding-right: 8px; color: #2B2B2B;" href="/kategoria/' . replaceAccents($row["k_nazov"]) . '">' . $row["k_nazov"] . '</a>');
                                $poloha_kategoria = $row['k_kid'];
                            }
                        } else {
                            $cesta_kat = array_reverse($cesta_kat);
                            foreach ($cesta_kat as $value) {
                                echo $value;
                            }
                            break;
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                }
            }
 
            ?>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <span style="font-size: 10px; color: grey;">Kód produktu: <?php echo $kod ?></span>
                    <div class="img-product" style="padding: 5vw">
                        <?php echo $cesta ?>
                    </div>

                </div>
                <div class="col-sm-12 col-md-6 col-lg-6" style="margin-top: 10%;">
                    <h3 style="font-weight: bold;"><?php echo $nazov ?></h3>
                    <div class="text">
                        <p style="text-align: justify;"><?php echo $popis ?></p>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <span style="font-size: 10px; color: grey;">Produktové číslo: <?php echo $produkt_cislo ?></span>
                            <br><br><br>
                            <?php if ($dostupnost == 1 && $pocet_ks >= 1) {
                                echo "<span style='color: #149106; font-weight: 600;'>Na sklade ($pocet_ks ks)</span>";
                            } else {
                                echo "<span style='color: #C21801; font-weight: 600;'>Nie je na sklade</span>";
                            } ?>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                            <span style="color: #B81600; font-size: 30px; font-weight: bold; padding-bottom: 10px;"><?php echo number_format($cena * 1.2, 2, '.', '') ?>€</span><br>
                            <span class="product-price-wdph">Bez DPH:<?php echo $cena ?>€</span>
                            <?php                // check if product already exists in cart
                            $flag = false;
                            foreach ($cart as $c) {
                                if (($c->productCode == $kod)) {
                                    $flag = true;
                                    break;
                                }
                            }

                            if ($flag) { ?>

                                <!-- show delete button if already exists -->

                                <form method="POST" action="../update-cart.php" style="float: right;">
                                    <input type="hidden" name="quantity" value="<?php echo $c->quantity; ?>">
                                    <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                    <button class="buy-btn" name="quantity-plus" style="border-radius: 10px;left: unset;right: 10px;bottom: -5px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                </form>
                            <?php } else { ?>

                                <!-- add to cart -->

                                <form method="POST" action="../add-cart.php">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="productCode" value="<?php echo $kod; ?>">
                                    <button class="buy-btn" style="border-radius: 10px;left: unset;right: 10px;bottom: -5px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                </form>

                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <hr>

            <div class="row">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">Popis</li>
                    <li class="tab-link" data-tab="tab-2">Technické parametre</li>
                    <li class="tab-link" data-tab="tab-3">Súvisiace produkty</li>
                </ul>


                <div id="tab-1" class="col-12 tab-content current">
                    <p><?php
                    if($popis == ""){
                        echo "K tomuto produktu ešte neexistuje žiaden popis. Robíme všetko preto aby sme ho čo najskôr dodali!";
                    } else {
                        echo nl2br($popis);
                    }
                     ?></p>
                </div>
                <div id="tab-2" class="col-12 tab-content">
                    <div class="row">
                        <div class="col-12">
                            <?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/parameters.php"); ?>
                        </div>

                    </div>
                </div>
                <div id="tab-3" class="col-12 tab-content">
                    <div class="related" style="display: flex;">

                    </div>

                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); ?>

</body>

</html>