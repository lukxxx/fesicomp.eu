<?php
require_once "config.php";
$result = mysqli_query($link, "SELECT * FROM produkty WHERE p_nazov LIKE '%msi%' LIMIT 4");

// get cookie cart
$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

// loop through all cart items
while ($row = mysqli_fetch_object($result)) {
    // check if product already exists in cart
    $flag = false;
    foreach ($cart as $c) {
        if (($c->productCode == $row->p_id)) {
            $flag = true;
            break;
        }
    }
?>
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="product-card justify-content-md-center">
            <div class="discount">

            </div>
            <div class="product-img justify-content-center">
                <a style="color: white;" href="<?php echo $root_url?>/<?php echo replaceAccents($row->p_nazov) ?>"><img class="img-prod" loading="lazy" src="catalog/<?php echo $row->p_id ?>/<?php echo $row->p_img ?>" width="" class="img-prod" height="120"></a>
            </div>
            <div class="product-name justify-content-md-center">
                <div class="heading">
                    <a style="color: white;" href="<?php echo $root_url?>/<?php echo replaceAccents($row->p_nazov) ?>">
                        <h6 class="name-prod"><?php echo $row->p_nazov ?></h6>
                    </a>
                </div>

            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="product-bottom justify-content-flex-end" style="height: 60px;">
                    <div class="add-to-cart justify-content-md-center">
                        <?php

                        if ($flag) { ?>

                            <!-- add to cart -->

                            <form method="POST" class="update-c" style="float: right;">
                                <input type="hidden" name="quantity" class="up-quant" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" class="up-pc" value="<?php echo $c->productCode; ?>">
                                <button class="buy-btn" name="quantity-plus" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                            </form>

                        <?php } else { ?>

                            <!-- add to cart -->

                            <form method="POST" class="add-c">
                                <input type="hidden" class="add-quant" name="quantity" value="1">
                                <input type="hidden" class="add-pc" name="productCode" value="<?php echo $row->p_id; ?>">
                                <button class="buy-btn" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="price-tag align-self-center">
                        <div class="pricing" style="display: block;">
                            <span class="product-price-dph"><?php echo $row->p_cena ?>€</span><br style="height: 1px;">
                            <?php
                            $no_dph = ($row->p_cena / 100) * 80;
                            $bezdph = number_format($no_dph, 2, ',', ' ');
                            ?>
                            <span class="product-price-wdph">Bez DPH: <?php echo $bezdph; ?>€</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>
<script src="<?php echo $root_url ?>/config.js"></script>
<script src="<?php echo $root_url ?>/assets/js/main.js"></script>
