<?php
include "../../includes/head-sub.php";
include "../../config.php";
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$date = date('d.m.y');
$nadpis = "Správa produktov";

if (isset($_COOKIE['admin'])) {
    if (isset($_POST['logout'])) {
        header("Location: gdbay.php");
    }
}
if (!isset($_COOKIE['admin'])) {
    header("Location: ../");
}


if (isset($_COOKIE['admin'])) { ?>
    <div class="container-fluid">
        <div class="row">
            <div style="background-color: #303030; width: 100%; height: 1080px" class="col-sm-2 col-md-2 col-lg-2">
                <?php include "../../includes/side-panel.php"; ?>
            </div>

            <div style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
                <?php include "../../includes/header-main.php"; ?>

                <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
                <h3 style="margin-bottom: 6vw">Detail produktu</h3>
                <?php
                if (isset($_GET['PID'])) {

                    $id = $_GET['PID'];
                    $sql = "SELECT * FROM produkty WHERE p_id='$id'";
                    $result = mysqli_query($link, $sql) or die("Bad query");
                    while ($row = mysqli_fetch_array($result)) {
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
                        $aktualnost = $row['p_aktualni'];
                        $dopredaj = $row['p_dopredaj'];
                        $vyrobca = $row['p_vyrobca'];
                        $zaruka = $row['p_zaruka'];
                        $kod_sklad = $row['p_kod_sklad'];
                        $kod_kategorie_sklad = $row['p_kid_sklad'];
                        $typ = $row['p_typ'];
                        $cena_doporucena = $row['p_cena_doporucena'];
                        $rabat = $row['p_rema'];
                        $autorsky_poplatok = $row['p_autorsky_poplatok'];
                    }

                    if (isset($id_kat)) {
                        $sqlko = "SELECT * FROM kategorie WHERE k_id='$id_kat'";
                        $resultik = mysqli_query($link, $sqlko) or die("Bad query");
                        $rowko = mysqli_fetch_array($resultik);
                        $kategoria = $rowko['k_nazov'];
                    }
                    if (file_exists("../../../catalog/$id_produktu/$obrazok")) {
                        $cesta = "<a href='../../../catalog/$id_produktu/$obrazok' data-lightbox='set' ><img loading='lazy' src='../../../catalog/$id_produktu/$obrazok' style='width: 100%;'></a>";
                    } else {
                        $cesta = "<img loading='lazy' src='../assets/images/no-image.png'  style='width: 100%;'>";
                    }
                }
                ?>
                <div class="main-vec">
                    <div class="row" style="padding: 5% 5%;">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <span style="font-size: 10px; color: grey;">Kód produktu: <?php echo $kod ?></span>
                            <div class="img-product" style="padding: 5vw">
                                <?php echo $cesta ?>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="product-name-heading" style="padding: 10px 0;">
                                <h3 class="p_name_heading" style="font-weight: bold; text-align: left;"><?php echo $nazov ?></h3>
                                <input class="form-search-control" style="padding: 0; display: none;" type="text" name="product-name" id="product_name" value="">
                                <div class="product_name_sc" style="margin-top: 10px; display: none">
                                    <div class="edit-close p_name_close">
                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                    </div>
                                    <div class="edit-save p_name_save">
                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                    </div>
                                </div>
                                <div class="saved-msg" style="opacity: 0; height: 0px">
                                    <span>Uložené!</span>
                                </div>
                                <div class="edit edit_h" style="display: none;">
                                    <i class="fas fa-edit" style="left: 12px; top: 11px;position: absolute;"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: left;">
                                    <div class="product-code">
                                        <div class="product_code_div">

                                            <b style="margin-right: 5px;">Produktové číslo: </b><br><span class="product_code_span"><?php echo $produkt_cislo ?></span>
                                            <input class="form-search-control" style="padding: 0; display: none; font-size: 15px" type="text" name="product-code" id="product_code" value="">


                                            <div class="product_code_sc" style="margin-top: 10px; display: none">
                                                <div class="edit-close p_code_close">
                                                    <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                </div>
                                                <div class="edit-save p_code_save">
                                                    <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                            <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                        </div>
                                        <div class="edit-small edit_pc" style="display: none; position: absolute; top: 9px; left: 150px;">
                                            <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                        </div>
                                    </div>
                                    <?php if ($dostupnost == 1 && $pocet_ks >= 1) {
                                        echo "<span style='color: #149106; font-weight: 600;'>Na sklade ($pocet_ks ks)</span>";
                                    } else {
                                        echo "<span style='color: #C21801; font-weight: 600;'>Nie je na sklade</span>";
                                    } ?>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6" style="display: flex; justify-content: flex-end; align-items: center;">
                                    <span style="color: #B81600; font-size: 30px; font-weight: bold; padding-bottom: 10px;"><?php echo $cena ?>€</span><br>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="padding: 5% 5%;">
                        <div class="col-6">
                            <div class="text">
                                <p style="text-align: justify;"><?php echo $popis ?></p>
                            </div>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <div class="save-close d-flex">
                        <span class="msg-svcl">Pre uloženie prejdite sem</span>
                        <i class="fas fa-angle-up save-close-arrow "></i>
                        <button class="close-btn">Zavrieť </button>
                        <button class="save-btn btn-success">Uložiť </button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>