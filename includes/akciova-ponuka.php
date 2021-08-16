<style>
    .gallery {
        background: #EEE;
    }

    .gallery-cell {
        width: 38%;
        height: 200px;
        margin-right: 10px;
        background: #8C8;
        counter-increment: gallery-cell;
    }

    .gallery-cell.is-selected {
        background: #ED2;
    }

    /* cell number */
    .gallery-cell:before {
        display: block;
        text-align: center;
        content: counter(gallery-cell);
        line-height: 200px;
        font-size: 80px;
        color: white;
    }
    .flickity-viewport {
        padding: 15px 0 !important;
    }
</style>
<div class="main-gallery" style="width: 100%;">
<?php
require "config.php";
$result = mysqli_query($link, "SELECT * FROM produkty WHERE p_nazov LIKE '%apc%' LIMIT 8");

// get cookie cart
$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

// loop through all cart items
while ($row = mysqli_fetch_object($result)) {
    $popis = $row->p_popis;
?>
    <div class="product-card justify-content-md-center" style="width: 300px; margin-left: 15px">
        <div class="discount">
            <img src="assets/images/discount.png" alt="zlava" class="discount-img">
        </div>
        <div class="product-img justify-content-md-center">
            <a style="color: white;" href="/<?php echo replaceAccents($row->p_nazov) ?>"><img class="img-prod" loading="lazy" src="https://compsnv.sk/catalog/<?php echo $row->p_id ?>/<?php echo $row->p_img ?>" width=" auto" class="img-prod" height="120"></a>
        </div>
        <div class="product-name d-flex justify-content-center">
            <div class="heading">
                <a style="color: white;" href="/<?php echo replaceAccents($row->p_nazov) ?>">
                    <h6 class="name-prod"><?php echo mb_strimwidth($row->p_nazov, 0, 45, ""); ?></h6>
                </a>
            </div>
        </div>


        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="product-bottom" style="justify-content: flex-end">
                <div class="add-to-cart justify-content-md-center">
                    <form method="POST" class="add-c" action="<?php echo $root_url?>/addcart">
                        <input type="hidden" class="add-quant" name="quantity" value="1">
                        <input type="hidden" class="add-pc" name="productCode" value="<?php echo $row->p_id ?>">
                        <button class="buy-btn" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                    </form>
                </div>
                <div class="price-tag align-self-center">
                    <div class="pricing" style="display: block;">
                        <span class="product-price-dph"><?php echo number_format($row->p_cena * 1.2, 2, '.', '') ?>€</span><br style="height: 1px;">
                        <span class="product-price-wdph">Bez DPH: <?php echo $row->p_cena ?>€</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
</div>
<script>
    $('.main-gallery').flickity({
        // options
        cellAlign: 'center',
        wrapAround: true,
        autoPlay: true,
        pageDots: false,
        contain: true,
        resize: true,
        draggable: true
    });
</script>
<script src="<?php echo $root_url ?>/config.js"></script>
<script src="<?php echo $root_url ?>/assets/js/main.js"></script>