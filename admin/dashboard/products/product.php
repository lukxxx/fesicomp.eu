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
                        $rabat = $row['p_rabat'];
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
                                <div class="col-sm-5 col-md-5 col-lg-5" style="text-align: left;">
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

                                    <div class="product-kod" style="position: relative">
                                        <div class="product_kod_div">

                                            <b style="margin-right: 5px;">Kód produktu: </b><br><span class="product_kod_span"><?php echo $kod ?></span>
                                            <input class="form-search-control" style="padding: 0; display: none; font-size: 15px" type="text" name="product-kod" id="product_kod" value="">


                                            <div class="product_kod_sc" style="margin-top: 10px; display: none">
                                                <div class="edit-close p_kod_close">
                                                    <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                </div>
                                                <div class="edit-save p_kod_save">
                                                    <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                            <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                        </div>
                                        <div class="edit-small edit_kod" style="position: absolute; top: 15px; left: 115px; display: none;">
                                            <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                        </div>
                                    </div>
                                    <div class="product-dost" style="position: relative">
                                        <div class="product_dost_div">

                                            <?php if ($dostupnost == 1 && $pocet_ks >= 1) {
                                                echo "<b style='color: #149106;'>Dostupnosť: </b><br><span style='color: #149106; font-weight: 600;' class='left'>(</span><span style='color: #149106; font-weight: 600;' class='product_dost_span'>$pocet_ks </span><span style='color: #149106; font-weight: 600;' class='right'>ks)</span>";
                                            } else {
                                                echo "<b>Dostupnosť: </b><br><span style='color: #149106; font-weight: 600;' class='left'>(</span><span style='color: #149106; font-weight: 600;' class='product_dost_span'>$pocet_ks </span><span style='color: #149106; font-weight: 600;' class='right'>ks)</span>";
                                            } ?>
                                            <input class="form-search-control" style="padding: 0; display: none; font-size: 15px" type="text" name="product-dost" id="product_dost" value="">


                                            <div class="product_dost_sc" style="margin-top: 10px; display: none">
                                                <div class="edit-close p_dost_close">
                                                    <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                </div>
                                                <div class="edit-save p_dost_save">
                                                    <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                            <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                        </div>
                                        <div class="edit-small edit_dost" style="position: absolute; top: 15px; left: 100px; display: none;">
                                            <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7" style="margin-top: -3px">
                                    <div class="ceny">
                                        <div class="product-cena" style="position: relative; width: 115%; padding-right: 40px;">
                                            <div class="product_cena_div">

                                                <div class="product_cena_cena" style="display: flex; justify-content: space-between;">
                                                    <span style="margin-top: 3px"><b>Cena produktu:</b></span>
                                                    <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px; text-decoration: underline;">
                                                    <span  class="product_cena_span"><?php echo $cena ?></span><span class="currency_cena">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;" type="text" name="product-cena" id="product_cena" value="">
                                                </div>



                                                <div class="product_cena_sc" style="margin-top: 10px; display: none">
                                                    <div class="edit-close p_cena_close">
                                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                    </div>
                                                    <div class="edit-save p_cena_save">
                                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                                <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                            </div>
                                            <div class="edit_cena edit-small " style="position: absolute; top: 15px; right: 0px; display: none;">
                                                <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                            </div>
                                        </div>
                                        <div class="product-odpo" style="position: relative; width: 115%; padding-right: 40px;">
                                            <div class="product_odpo_div">

                                                <div class="product_odpo_cena" style="display: flex; justify-content: space-between;">
                                                    <span style="margin-top: 3px"><b>Odporúčaná cena:</b></span>
                                                    <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px;">
                                                    <span  class="product_odpo_span"><?php echo $cena_doporucena ?></span><span class="currency_odpo">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;"
                                                    type="text" name="product-odpo" id="product_odpo" value="">
                                                </div>



                                                <div class="product_odpo_sc" style="margin-top: 10px; display: none">
                                                    <div class="edit-close p_odpo_close">
                                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                    </div>
                                                    <div class="edit-save p_odpo_save">
                                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                                <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                            </div>
                                            <div class="edit_odpo edit-small " style="position: absolute; top: 15px; right: 0px; display: none;">
                                                <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="cena" style="display: flex; justify-content: space-between;">
                                            <span style="margin-top: 3px; font-size: 15px"><b>Rabat:</b></span>
                                            <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px;"><?php echo $rabat ?>€</span>
                                        </div>
                                        <div class="cena" style="display: flex; justify-content: space-between;">
                                            <span style="margin-top: 3px; font-size: 15px"><b>Autorský poplatok:</b></span>
                                            <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px;"><?php echo $autorsky_poplatok ?>€</span>
                                        </div>
                                    </div>
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