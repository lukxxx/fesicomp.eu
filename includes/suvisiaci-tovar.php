<?php
if (isset($id)) {
    $id = $id;
    $sql = "SELECT * FROM produkty WHERE p_id IN (SELECT s_kod_suvisiaci FROM suvisiaci where s_kod = (SELECT p_id FROM produkty WHERE p_id='$id')) LIMIT 3";
}
if ($stmt = mysqli_prepare($link, $sql)) {

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if (file_exists("catalog/" . $row['p_id'] . "/" . $row['p_img'] . "")) {
                    $cesta = "<img loading='lazy' src='catalog/" . $row['p_id'] . "/" . $row['p_img'] . " width='159' class='img-prod' height='120'>";
                } else {
                    $cesta = "<img loading='lazy' src='assets/images/no-image.png' width='140' class='img-prod' height='120'>";
                }
?>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="product-card justify-content-md-center">
                        <div class="discount">

                        </div>
                        <div class="product-img justify-content-md-center">
                            <a style="color: white;" href="<?php echo $root_url ?>/<?php echo replaceAccents($row['p_nazov']) ?>"><img src="catalog/<?php echo $row['p_id'] ?>/<?php echo $row['p_img'] ?>" width="" class="img-prod" height="120"></a>
                        </div>
                        <div class="product-name justify-content-md-center">
                            <div class="heading">
                                <a style="color: white;" href="<?php echo $root_url ?>/<?php echo replaceAccents($row['p_nazov']) ?>">
                                    <h6 class="name-prod"><?php echo $row['p_nazov'] ?></h6>
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
                                        <span class="product-price-dph"><?php echo $row['p_cena'] ?>€</span><br style="height: 1px;">
                                        <?php
                                        $no_dph = ($row['p_cena'] / 100) * 80;
                                        $nodph = number_format($no_dph, 2, ',', ' ');
                                        ?>
                                        <span class="product-price-wdph">Bez DPH:<?php echo $nodph; ?>€</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<?php
            }
        }
    } else {
        echo "<span>Pre tento produkt neexistujú žiadne súvisiace produkty</span>";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>