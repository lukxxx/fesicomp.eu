<?php
if ($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs") {
    include $_SERVER['DOCUMENT_ROOT'] . "/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php";
}

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

?>
<script type='text/javascript'>
    function updateURLParameter(url, param, paramVal) {
        var TheAnchor = null;
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";

        if (additionalURL) {
            var tmpAnchor = additionalURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
            if (TheAnchor)
                additionalURL = TheParams;

            tempArray = additionalURL.split("&");

            for (var i = 0; i < tempArray.length; i++) {
                if (tempArray[i].split('=')[0] != param) {
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        } else {
            var tmpAnchor = baseURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];

            if (TheParams)
                baseURL = TheParams;
        }

        if (TheAnchor)
            paramVal += "#" + TheAnchor;

        var rows_txt = temp + "" + param + "=" + paramVal;
        window.location = baseURL + "?" + newAdditionalURL + rows_txt;
    }
</script>
<?php include $root_dir . "/includes/header.php" ?>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <?php include $root_dir . "/includes/category-list.php" ?>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
            <?php
            $stmt = $pdo->query("SELECT * FROM kategorie WHERE k_url LIKE '$kategorka'");
            while ($row = $stmt->fetch()) {
                $kid = $row['k_id'];
                $k_name = $row['k_nazov'];
            }
            ?>
            <!--<a style="color: black;" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span><i class="fas fa-arrow-left"></i> Krok späť</span></a>-->
            <h2><?php echo $k_name ?></h2>
            <hr>

            <div class="d-flex flex-wrap">
                <?php


                $name = "SELECT * FROM kategorie WHERE k_kid = '$kid' AND k_aktualni != '2' AND k_medzera ='0'  ORDER BY k_poradie";
                if ($stmt = mysqli_prepare($link, $name)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                ?>
                                <div class="col-sm-12 col-md-4 col-lg-3 ">
                                    <a class="category-link" href="<?php echo $root_url ?>/kategoria/<?php echo replaceAccents($row['k_nazov']) ?>">
                                        <div class="category-card d-flex justify-content-center" style="align-items: center; margin: 3% 0 3% 0">
                                            <span style="color: black; font-size: 17px;"> <?php echo $row['k_nazov'] ?></span>
                                        </div>
                                    </a>
                                </div>

                <?php
                            }
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                }
                ?>
            </div>
            <hr>
            <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------Neviem ako to chcete :D a skúšal som celý čas hľadať slider na nete ale nič schopné som za tých pol hodiny nenašiel bohužiaľ, Lukáš mi isto povie teraz, že nech sa naučím vyhľadávať veci na googli :D a dobrú chuť keď papate pizzu Alexovu------------------------------------------------------------------>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <span style="font-size: 20px; font-weight: bold;">Zoradiť cenu</span>
                    <div class="button-box" style="margin-top: 10px;">
                        <a href="#" onclick="updateURLParameter(window.location.href, 'cena','ASC' )" class="sort-btn" role="button">Najlacnejšie</a>
                        <a href="#" onclick="updateURLParameter(window.location.href, 'cena','DESC' )" class="sort-btn" role="button">Najdrahšie</a>
                    </div>
                </div>
            </div>
            <br>

            <!--       _
                        .__(.)< (kač kač)
                        \___)   
                ~~~~~~~~~~~~~~~~~~-->
            <!--------------------------------------------------------------------------------------------------------------------------------------------------------->




            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $no_of_records_per_page = 24;
            $offset = ($page - 1) * $no_of_records_per_page;
            $total_pages_sql = "SELECT COUNT(*) FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0'";
            $result = mysqli_query($link, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            ?>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <p>Počet nájdených položiek: <?php echo $total_rows ?></p>
                </div>
            </div>
            <div class="d-flex flex-wrap row">
                <?php
                if (isset($_GET['cena'])) {
                    $cena = $_GET['cena'];
                    //echo $cena;
                    $sql = "SELECT * FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0' and p_cena != '' ORDER BY p_cena $cena LIMIT $offset, $no_of_records_per_page  ";
                } else {
                    $sql = "SELECT * FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0' and p_cena != '' LIMIT $offset, $no_of_records_per_page";
                }
                if ($stmt = mysqli_prepare($link, $sql)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $obrazok = $row['p_img'];
                                $id_produktu = $row['p_id'];
                                $meno_produktu = $row['p_nazov'];
                                $path_R = $root_url;
                                $path = $path_R . "catalog/$id_produktu/$obrazok";
                                if (file_exists($path)) {
                                    $cesta = "<img loading='lazy' src='https://fesicomp.sitecult.sk/catalog/$id_produktu/$obrazok'   class='img-prod' style='max-width: 120px;max-height: 120px;'>";
                                } else {
                                    $cesta = "<img loading='lazy' src='https://fesicomp.sitecult.sk/assets/images/no-image.png'  class='img-prod' style='max-width: 120px;max-height: 120px;'>";
                                }
                ?>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <div class="product-card justify-content-md-center">
                                        <div class="discount">

                                        </div>
                                        <div class="product-img justify-content-md-center">
                                            <a href="<?php echo $root_url ?>/produkt/<?php echo replaceAccents($meno_produktu) ?>"><?php echo $cesta; ?></a>
                                        </div>
                                        <div class="product-name justify-content-md-center">
                                            <div class="heading">
                                                <a style="color: white;" href="<?php echo $root_url ?>/produkt/<?php echo replaceAccents($meno_produktu) ?>">
                                                    <h6 class="name-prod"><?php echo mb_strimwidth($meno_produktu, 0, 30, ""); ?></h6>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="product-bottom justify-content-md-center">
                                                <div class="add-to-cart justify-content-md-center">
                                                    <form method="POST" class="add-c" action="<?php echo $root_url?>/addcart">
                                                        <input type="hidden" class="add-quant" name="quantity" value="1">
                                                        <input type="hidden" class="add-pc" name="productCode" value="<?php echo $row['p_id']; ?>">
                                                        <button class="buy-btn" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                                                    </form>
                                                </div>
                                                <div class="price-tag align-self-center">
                                                    <div class="pricing" style="display: block;">
                                                        <span class="product-price-dph"><?php echo number_format($row['p_cena'] * 1.2, 2, '.', '') ?>€</span><br style="height: 1px;">
                                                        <span class="product-price-wdph">Bez DPH:<?php echo $row['p_cena'] ?>€</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                <?php
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                }

                ?>
            </div>
            <div class="row d-flex justify-content-center">
                <ul class="pagination ">
                    <?php if ($page > 1) : ?>
                        <li class="prev"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '<?php print($page - 1) ?>' )">Predchádzajúca</a></li>
                    <?php endif; ?>

                    <?php if ($page > 3) : ?>
                        <li class="start"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '1');return false;">1</a></li>
                        <li class="dots">...</li>
                    <?php endif; ?>

                    <?php if ($page - 2 > 0) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page - 2) ?> )"><?php echo $page - 2 ?></a></li><?php endif; ?>
                    <?php if ($page - 1 > 0) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page - 1) ?> )"><?php echo $page - 1 ?></a></li><?php endif; ?>

                    <li class="currentpage"><a href="?KID=<?php echo $kid ?>&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                    <?php if ($page + 1 < ceil($total_pages) + 1) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 1) ?> )"><?php echo $page + 1 ?></a></li><?php endif; ?>
                    <?php if ($page + 2 < ceil($total_pages) + 1) : ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 2) ?> )"><?php echo $page + 2 ?></a></li><?php endif; ?>

                    <?php if ($page < ceil($total_pages) - 2) : ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($total_pages) ?> )"><?php echo ceil($total_pages) ?></a></li>
                    <?php endif; ?>

                    <?php if ($page < ceil($total_pages)) : ?>
                        <li class="next"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php print($page + 1) ?> )">Ďalšia</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <br>
        </div>
    </div>
</div>
<?php include $root_dir . "/includes/footer.php"; ?>
<script src="<?php echo $root_url ?>/config.js"></script>
<script src="<?php echo $root_url ?>/assets/js/main.js"></script>
</body>

</html>