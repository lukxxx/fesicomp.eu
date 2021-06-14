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
                        $akcia = $row['akcia'];
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
                        $cesta = "<img loading='lazy' src='../../../assets/images/no-image-admin.png'  style='width: 100%;'>";
                    }
                }
                ?>
                <div class="main-vec">
                    <div class="row" style="padding: 5% 5%;">
                        <div class="col-sm-12 col-md-6 col-lg-6">

                            <div class="img-product" style="padding: 0 5vw;">
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
                                                echo "<b>Dostupnosť: </b><br><span style='font-weight: 600;' class='left'>(</span><span style=' font-weight: 600;' class='product_dost_span'>$pocet_ks </span><span style=' font-weight: 600;' class='right'>ks)</span>";
                                            } else {
                                                echo "<b>Dostupnosť: </b><br><span style=' font-weight: 600;' class='left'>(</span><span style=' font-weight: 600;' class='product_dost_span'>$pocet_ks </span><span style=' font-weight: 600;' class='right'>ks)</span>";
                                            } ?>
                                            <input class="form-search-control" style="padding: 0; display: none; font-size: 15px" type="text" name="product-dost" id="product_dost" value="">


                                            <div class="product_dost_sc" style="margin-top: 10px; display: none;">
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

                                    <div class="product-aktual" style="position: relative">
                                        <div class="product_aktual_div">

                                            <?php
                                            if ($aktualnost >= 1) {
                                                $aktualnost = "Áno";
                                                echo "<b>Aktuálny produkt: </b><span style='color: #149106; font-weight: 600;'
                                                 class='product_aktual_span'>$aktualnost </span>";
                                            } else {
                                                $aktualnost = "Nie";
                                                echo "<b>Aktuálny produkt: </b><span style='color: #C21800; font-weight: 600;' 
                                                class='product_aktual_span'>$aktualnost </span>";
                                            } ?>
                                            <select class="form-search-control" style="padding: 0; display: none; font-size: 15px" type="text" name="product-aktual" id="product_aktual" value="<?php echo $aktualnost ?>">
                                                <?php
                                                if ($aktualnost >= 1) {
                                                ?>
                                                    <option selected="selected">Áno</option>
                                                    <option>Nie</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option selected="selected">Nie</option>
                                                    <option>Áno</option>
                                                <?php
                                                }
                                                ?>

                                            </select>



                                            <div class="product_aktual_sc" style="margin-top: 10px; display: none;">
                                                <div class="edit-close p_aktual_close">
                                                    <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                </div>
                                                <div class="edit-save p_aktual_save">
                                                    <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="saved-msg" style="opacity: 0; height: 0px; width: 31%; position: relative;">
                                            <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                        </div>
                                        <div class="edit-small edit_aktual" style="position: absolute;top: 5px;right: 35px;display: none;">
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
                                                        <span class="product_cena_span"><?php echo $cena ?></span><span class="currency_cena">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;" type="text" name="product-cena" id="product_cena" value="">
                                                </div>



                                                <div class="product_cena_sc" style="margin-top: 10px; display: none; ">
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
                                                        <span class="product_odpo_span"><?php echo $cena_doporucena ?></span><span class="currency_odpo">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;" type="text" name="product-odpo" id="product_odpo" value="">
                                                </div>



                                                <div class="product_odpo_sc" style="margin-top: 10px; display: none; margin-left: 60%">
                                                    <div class="edit-close p_odpo_close">
                                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                    </div>
                                                    <div class="edit-save p_odpo_save">
                                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="saved-msg" style="opacity: 0; height: 0px; width: 4.8vw; position: relative; float: right;">
                                                <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                            </div>
                                            <div class="edit_odpo edit-small " style="position: absolute; top: 15px; right: 0px; display: none;">
                                                <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                            </div>
                                        </div>
                                        <div class="product-rabat" style="position: relative; width: 115%; padding-right: 40px;">
                                            <div class="product_rabat_div">

                                                <div class="product_rabat_cena" style="display: flex; justify-content: space-between; width: 100%">
                                                    <span style="margin-top: 3px"><b>Rabat:</b></span>
                                                    <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px;">
                                                        <span class="product_rabat_span"><?php echo $rabat ?></span><span class="currency_rabat">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;" type="text" name="product-rabat" id="product_rabat" value="">
                                                </div>



                                                <div class="product_rabat_sc" style="margin-top: 10px; display: none; margin-left: 60%">
                                                    <div class="edit-close p_rabat_close">
                                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                    </div>
                                                    <div class="edit-save p_rabat_save">
                                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="saved-msg" style="opacity: 0; height: 0px; width: 4.8vw; position: relative; float: right;">
                                                <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                            </div>
                                            <div class="edit_rabat edit-small " style="position: absolute; top: 15px; right: 0px; display: none;">
                                                <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                            </div>
                                        </div>

                                        <div class="product-poplatok" style="position: relative; width: 115%; padding-right: 40px;">
                                            <div class="product_poplatok_div">

                                                <div class="product_poplatok_cena" style="display: flex; justify-content: space-between; width: 100%">
                                                    <span style="margin-top: 3px"><b>Autorský poplatok:</b></span>
                                                    <span style="color: #B81600; font-size: 20px; font-weight: bold; padding-bottom: 10px;">
                                                        <span class="product_poplatok_span"><?php echo $autorsky_poplatok ?></span><span class="currency_poplatok">€</span></span>
                                                    <input class="form-search-control" style="padding: 0; display: none; font-size: 15px; float: right;" type="text" name="product-poplatok" id="product_poplatok" value="">
                                                </div>



                                                <div class="product_poplatok_sc" style="margin-top: 10px; display: none; margin-left: 60%">
                                                    <div class="edit-close p_poplatok_close">
                                                        <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                    </div>
                                                    <div class="edit-save p_poplatok_save">
                                                        <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="saved-msg" style="opacity: 0; height: 0px; width: 4.8vw; position: relative; float: right;">
                                                <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                            </div>
                                            <div class="edit_poplatok edit-small " style="position: absolute; top: 15px; right: 0px; display: none;">
                                                <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row" style="padding: 5% 5%;">
                        <div class="col-6">
                            <h3 style="text-align: left;"><b>Popis</b></h3>
                            <div class="product-popis" style="padding: 40px 20px 0 0;position: relative;">
                                <div class="product-popis-div">
                                    <p style="text-align: justify;" class="product_popis_span"><?php echo $popis ?></p>
                                    <textarea class="form-search-control" name="popis" id="product_popis" style="display: none;"></textarea>
                                    <div class="product_popis_sc" style="margin-top: 10px; display: none;">
                                        <div class="edit-close p_popis_close">
                                            <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                        </div>
                                        <div class="edit-save p_popis_save">
                                            <i class="fas fa-check" style="left: 2.4px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                        </div>
                                    </div>
                                    <div class="saved-msg" style="opacity: 0; height: 0px; width: 4.8vw; position: relative;">
                                        <span style="position: absolute; font-size: 14px; top: 0px; left: 18px;">Uložené!</span>
                                    </div>
                                    <div class="edit_popis edit-small " style="position: absolute;top: 20px;right: 0px;display: none;">
                                        <i class="fas fa-edit" style="left: 7px;top: 7px;position: absolute;font-size: 15px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 style="text-align: left;"><b>Akcia</b></h3>
                            <div class="akcia">
                                <?php
                                if ($akcia == null || $akcia == "") {
                                ?>
                                    <div class="error-akcia" style="display: flex; justify-content: center; align-items: center; height: 10vw; position: relative;">
                                        <span>Pre tento produkt neexistuje žiadna akcia. Pridajte nejakú!</span>
                                        <button class="btn btn-warning add-akcia-btn" style="position: absolute; top: 75%">Pridať akciu</button>
                                    </div>
                                    <div class="info-akcia" style="display: none; margin-top: 5%">
                                        <h6 style="text-align: left;"><b>Pridanie novej akcie:</b></h6>
                                        <div class="akcia-decision" style="display: flex; justify-content: center; align-items: center; height: 6vw">
                                            <button class="btn btn-secondary add-btn-cena" style="margin-right: 5%; background-color: #303030">Zadať cenu</button>
                                            <button class="btn btn-secondary add-btn-percenta" style="background-color: #303030">Zadať cenu v %</button>
                                        </div>
                                        <div class="akcia-edit" style="display: none;">
                                            <div class="akcia-cena">
                                                <input class="form-search-control" type="text" name="product-akcia-cena" id="product-akcia-cena" value="" style="padding: 0; font-size: 16px; width: 100%; margin-bottom: 3%" placeholder="Cena v € po zľavnení">
                                            </div>
                                            <div class="akcia-percenta">
                                                <input class="form-search-control" type="text" name="product-akcia-cena" id="product-akcia-cena" value="" style="padding: 0; font-size: 16px; width: 100%; margin-bottom: 3%" placeholder="Zľava v %">
                                            </div>
                                            <h6 style="text-align: left;"><b>Dátum zahájenia akcie:</b></h6>
                                            <div class="vyber-datumu d-flex" style="justify-content: space-between; margin-bottom: 3%;">
                                                <div style="width: 30%" class="left-text">
                                                    <select type='tel' id="den_pick" onchange="haha()" class='form-search-control new-input-den' name='pass' style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Deň</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                    </select>
                                                    <span class="den-s err-small"></span>
                                                </div>
                                                <div style="width: 30%;" class="left-text mesiac">
                                                    <select required id="mesiac_pick" disabled class="form-search-control new-input-mesiac" name="country-code" style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Mesiac</option>
                                                        <option value="Január">Január</option>
                                                        <option value="Február">Február</option>
                                                        <option value="Marec">Marec</option>
                                                        <option value="Apríl">Apríl</option>
                                                        <option value="Máj">Máj</option>
                                                        <option value="Jún">Jún</option>
                                                        <option value="Júl">Júl</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="Október">Október</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                    <span class="new-input-small mesiac-s err-small"></span>
                                                </div>
                                                <div style="width: 30%" class="rok-input left-text">
                                                    <select type='tel' id="rok_pick" onchange="rok()" disabled class='form-search-control new-input-rok' name='pass' placeholder='Rok' style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Rok</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2009">2009</option>
                                                        <option value="2008">2008</option>
                                                        <option value="2007">2007</option>
                                                        <option value="2006">2006</option>
                                                        <option value="2005">2005</option>
                                                        <option value="2004">2004</option>
                                                        <option value="2003">2003</option>
                                                        <option value="2002">2002</option>
                                                        <option value="2001">2001</option>
                                                        <option value="2000">2000</option>
                                                        <option value="1999">1999</option>
                                                        <option value="1998">1998</option>
                                                        <option value="1997">1997</option>
                                                        <option value="1996">1996</option>
                                                        <option value="1995">1995</option>
                                                        <option value="1994">1994</option>
                                                        <option value="1993">1993</option>
                                                        <option value="1992">1992</option>
                                                        <option value="1991">1991</option>
                                                        <option value="1990">1990</option>
                                                        <option value="1989">1989</option>
                                                        <option value="1988">1988</option>
                                                        <option value="1987">1987</option>
                                                        <option value="1986">1986</option>
                                                        <option value="1985">1985</option>
                                                        <option value="1984">1984</option>
                                                        <option value="1983">1983</option>
                                                        <option value="1982">1982</option>
                                                        <option value="1981">1981</option>
                                                        <option value="1980">1980</option>
                                                        <option value="1979">1979</option>
                                                        <option value="1978">1978</option>
                                                        <option value="1977">1977</option>
                                                        <option value="1976">1976</option>
                                                        <option value="1975">1975</option>
                                                        <option value="1974">1974</option>
                                                        <option value="1973">1973</option>
                                                        <option value="1972">1972</option>
                                                        <option value="1971">1971</option>
                                                        <option value="1970">1970</option>
                                                        <option value="1969">1969</option>
                                                        <option value="1968">1968</option>
                                                        <option value="1967">1967</option>
                                                        <option value="1966">1966</option>
                                                        <option value="1965">1965</option>
                                                        <option value="1964">1964</option>
                                                        <option value="1963">1963</option>
                                                        <option value="1962">1962</option>
                                                        <option value="1961">1961</option>
                                                        <option value="1960">1960</option>
                                                        <option value="1959">1959</option>
                                                        <option value="1958">1958</option>
                                                        <option value="1957">1957</option>
                                                        <option value="1956">1956</option>
                                                        <option value="1955">1955</option>
                                                        <option value="1954">1954</option>
                                                        <option value="1953">1953</option>
                                                        <option value="1952">1952</option>
                                                        <option value="1951">1951</option>
                                                        <option value="1950">1950</option>
                                                    </select>
                                                    <span class="new-input-small rok-s err-small"></span>
                                                </div>
                                            </div>
                                            <h6 style="text-align: left;"><b>Dátum ukončenia akcie:</b></h6>
                                            <div class="vyber-datumu d-flex" style="justify-content: space-between; margin-bottom: 3%">
                                                <div style="width: 30%" class="left-text">
                                                    <select type='tel' id="den_pick" onchange="haha()" class='form-search-control new-input-den' name='pass' style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Deň</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                    </select>
                                                    <span class="den-s err-small"></span>
                                                </div>
                                                <div style="width: 30%;" class="left-text mesiac">
                                                    <select required id="mesiac_pick" disabled class="form-search-control new-input-mesiac" name="country-code" style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Mesiac</option>
                                                        <option value="Január">Január</option>
                                                        <option value="Február">Február</option>
                                                        <option value="Marec">Marec</option>
                                                        <option value="Apríl">Apríl</option>
                                                        <option value="Máj">Máj</option>
                                                        <option value="Jún">Jún</option>
                                                        <option value="Júl">Júl</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="Október">Október</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                    <span class="new-input-small mesiac-s err-small"></span>
                                                </div>
                                                <div style="width: 30%" class="rok-input left-text">
                                                    <select type='tel' id="rok_pick" onchange="rok()" disabled class='form-search-control new-input-rok' name='pass' placeholder='Rok' style="padding: 0; font-size: 16px; width: 100%;">
                                                        <option selected hidden disabled value="">Rok</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2009">2009</option>
                                                        <option value="2008">2008</option>
                                                        <option value="2007">2007</option>
                                                        <option value="2006">2006</option>
                                                        <option value="2005">2005</option>
                                                        <option value="2004">2004</option>
                                                        <option value="2003">2003</option>
                                                        <option value="2002">2002</option>
                                                        <option value="2001">2001</option>
                                                        <option value="2000">2000</option>
                                                        <option value="1999">1999</option>
                                                        <option value="1998">1998</option>
                                                        <option value="1997">1997</option>
                                                        <option value="1996">1996</option>
                                                        <option value="1995">1995</option>
                                                        <option value="1994">1994</option>
                                                        <option value="1993">1993</option>
                                                        <option value="1992">1992</option>
                                                        <option value="1991">1991</option>
                                                        <option value="1990">1990</option>
                                                        <option value="1989">1989</option>
                                                        <option value="1988">1988</option>
                                                        <option value="1987">1987</option>
                                                        <option value="1986">1986</option>
                                                        <option value="1985">1985</option>
                                                        <option value="1984">1984</option>
                                                        <option value="1983">1983</option>
                                                        <option value="1982">1982</option>
                                                        <option value="1981">1981</option>
                                                        <option value="1980">1980</option>
                                                        <option value="1979">1979</option>
                                                        <option value="1978">1978</option>
                                                        <option value="1977">1977</option>
                                                        <option value="1976">1976</option>
                                                        <option value="1975">1975</option>
                                                        <option value="1974">1974</option>
                                                        <option value="1973">1973</option>
                                                        <option value="1972">1972</option>
                                                        <option value="1971">1971</option>
                                                        <option value="1970">1970</option>
                                                        <option value="1969">1969</option>
                                                        <option value="1968">1968</option>
                                                        <option value="1967">1967</option>
                                                        <option value="1966">1966</option>
                                                        <option value="1965">1965</option>
                                                        <option value="1964">1964</option>
                                                        <option value="1963">1963</option>
                                                        <option value="1962">1962</option>
                                                        <option value="1961">1961</option>
                                                        <option value="1960">1960</option>
                                                        <option value="1959">1959</option>
                                                        <option value="1958">1958</option>
                                                        <option value="1957">1957</option>
                                                        <option value="1956">1956</option>
                                                        <option value="1955">1955</option>
                                                        <option value="1954">1954</option>
                                                        <option value="1953">1953</option>
                                                        <option value="1952">1952</option>
                                                        <option value="1951">1951</option>
                                                        <option value="1950">1950</option>
                                                    </select>
                                                    <span class="new-input-small rok-s err-small"></span>
                                                </div>
                                            </div>
                                            <h6 style="text-align: left;"><b>Zákaznická skupina:</b></h6>
                                            <div class="akcia-zakaznici">
                                                <select class="form-search-control" name="zakaznicka-skupina" id="zakaznicka-skupina" style="padding: 0; font-size: 16px; width: 100%;">
                                                    <option value="all">Všetci zákazníci</option+>
                                                    <option value="registered">Registrovaní zákazníci</option>
                                                    <option value="google">Registrovaní zákazníci pomocou Googlu</option>
                                                    <option value="facebook">Registrovaní zákazníci pomocou Facebooku</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="akcia_sc" style="margin-top: 10px; display: flex">
                                                <div class="edit-close akcia_add">
                                                    <i class="fas fa-times" style="left: 4.4px;top: 3.5px;position: absolute;font-size: 13px;"></i><span class="close_text"></span>
                                                </div>
                                                <div class="edit-save akcia_add">
                                                    <i class="fas fa-plus" style="left: 3px;top: 3.5px;position: absolute;font-size: 13px;"><span class="save_text"></span></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="akcia-edit-percenta">

                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    
                                <?php
                                }
                                ?>
                            </div>
                            <hr style="margin: 10% 5%;">
                            <h3 style="text-align: left;"><b>Štatistiky</b></h3>
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