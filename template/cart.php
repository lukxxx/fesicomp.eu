<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
?>

<div class="container cart_desktop" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <a style="color: black; font-size: 18px; " href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><i class="fas fa-arrow-left"></i> Pokračovať v nákupe</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold;">KOŠÍK</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            <?php if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") { ?>
                <a style="color: black; text-align: right; font-size: 18px;" href="/kosik/dorucovacie-udaje">Pokračovať k objednávke <i class="fas fa-arrow-right"></i></a>
            <?php
            }
            ?>
        </div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="table">
                <?php
                if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") {
                    $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                    $cart = json_decode($cart);
                    $total = 0;
                    echo '<table class="table  table-bordered">';
                    echo '<thead class="thead-dark">';
                    echo '<tr>';
                    echo '<th scope="col">Produkt</th>';
                    echo '<th scope="col">Názov produktu</th>';
                    echo '<th scope="col" style="width: 10vw;">Množstvo</th>';
                    echo '<th scope="col">Dostupnosť</th>';
                    echo '<th scope="col">Cena</th>';
                    echo '<th scope="col"><i class="fas fa-trash-alt"></i></th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($cart as $c) {
                        $total += $c->product->p_cena * $c->quantity;
                ?>
                        <tr>
                            <th style="padding: 20px;"><?php echo "<img src='../catalog/" . $c->product->p_id . "/" . $c->product->p_img . "' width='50'>" ?></th>
                            <th style="padding: 20px;"><a style='color: black;' href="/<?php echo replaceAccents($c->product->p_nazov) ?>"><?php echo $c->product->p_nazov ?></a></th>
                            <th style="padding: 20px;">
                                <form method="post" action="../update-cart.php">
                                    <button type="submit" name="quantity-minus" style="all: unset; cursor: pointer;"><i class="fas fa-minus"></i></button>
                                    <input style="all: unset; width: 20%; margin-left: 15px;" type="text" id="quantity" name="quantity" min="1" value="<?php echo $c->quantity; ?>">
                                    <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                    <button type="submit" name="quantity-plus" style="all: unset; cursor: pointer;"><i class="fas fa-plus"></i></button>
                                </form>
                            </th>
                            <th style="padding: 20px;"><?php if ($c->product->p_sklad == 1) {
                                                            echo "<span style='color: #149106'>Skladom</span>";
                                                        }  ?></th>
                            <th style="padding: 20px;"><?php echo $c->product->p_cena * $c->quantity; ?>€</th>
                            <th style="padding: 20px 0px 20px 0px;">
                                <form method="POST" action="../delete-cart.php">
                                    <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                    <button type="submit" name="delete" style="all: unset; cursor: pointer;"><i style="color: #C21800;" class="fas fa-times fa-1x"></i></button>
                                </form>
                            </th>
                        </tr>

                <?php
                    }
                } else {
                    $total = 0;
                    echo "<span style='text-align: center; font-weight: bold;'>Nákupný košík je prázdny!</span>";
                }

                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 20px;">
        <div class="col-sm-12 col-sm-8 col-lg-8">
            <?php
            if (isset($total) && $total != 0) {
                $no_dph = ($total / 100) * 80;
                $nodph = number_format($no_dph, 2, ',', ' ');
            ?>
                <span>Uplatniť zľavový kód</span>
                <div class="d-flex input-code" style="padding-top: 10px;">
                    <form method="POST" action="#" style="display: flex;">
                        <input type="text" placeholder="FESI" name="code" class="form-control"><button style="background-color: #B81600; color: white; border-radius: 10px;
                     padding: 0px 20px 0px 20px; margin-left: 10px;" type="submit" class="btn">Uplatniť</button>
                    </form>
                </div>
            <?php
            } ?>
        </div>
        <div class="col-sm-12 col-sm-4 col-lg-4" style="text-align: right; ">
            <?php
            if (isset($total) && $total != 0) {
                $no_dph = ($total / 100) * 80;
                $nodph = number_format($no_dph, 2, ',', ' ');
            ?>
                <span><strong style="font-size: 24px; padding-right: 40px">Cena spolu: </strong><span style="font-size: 33px; font-weight: bold; color: #C5230D;"><?php echo $total . "€";  ?></span></span><br>
                <span style="color: #636363; padding-right: 90px; padding-top: 20px;">Cena bez DPH: </span><span style="color: #636363;"><?php echo $nodph . "€"; ?></span>
            <?php
            } ?>
        </div>
    </div>
</div>


<!-- mobilny kosik -->
<div class="container cart_mobile" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3" style="margin: 0 25px;">
            <a style="color: black;" href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><i class="fas fa-arrow-circle-left"></i> Pokračovať v nákupe</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center" style="margin: 10px 0;">
            <h2 style="font-weight: bold;">KOŠÍK</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right; margin: 0 25px;">
            <?php if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") { ?>
                <a style="color: black; text-align: right;" href="data.php">Pokračovať k objednávke <i class="fas fa-arrow-circle-right"></i></a>
            <?php
            }
            ?>
            <hr>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">

            <?php
            if (isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]") {
                $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                $cart = json_decode($cart);
                $total = 0;
                foreach ($cart as $c) {
                    $total += $c->product->p_cena * $c->quantity;
            ?>
                    <div style="margin: 0 25px;">
                        <div class="d-flex justify-content-between">
                            <?php echo "<a style='color: black; font-size: 15px;' class='text-left' href='/".replaceAccents($row['p_nazov'])."'>" . $c->product->p_nazov . "</a>" ?>

                            <form method="POST" action="../delete-cart.php">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button type="submit" name="delete" style="all: unset; cursor: pointer;"><i style="color: #C21800; font-size: 30px; margin-right: 15px;" class="fas fa-times fa-1x"></i></button>
                            </form>
                        </div>

                        <p class="text-left"><?php if ($c->product->p_sklad == 1) {
                                                    echo "<span style='color: #149106'>Skladom</span>";
                                                } ?></p>

                        <div class="d-flex justify-content-between align-items-center">
                            <form method="post" action="../update-cart.php">
                                <button type="submit" name="quantity-minus" style="all: unset; cursor: pointer;"><i class="fas fa-minus"></i></button>
                                <input style="all: unset; width: 20%;" type="number" id="quantity" name="quantity" min="1" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button type="submit" name="quantity-plus" style="all: unset; cursor: pointer;"><i class="fas fa-plus"></i></button>
                            </form>

                            <span style="padding-right: 25px; font-size: 21px;"><strong style="color: #C21800;"><?php echo $c->product->p_cena * $c->quantity; ?>€</strong></span>
                        </div>


                        <hr>

                    </div>
            <?php
                }
            } else {
                $total = 0;
                echo "<span style='text-align: center; font-weight: bold;'>Nákupný košík je prázdny!</span>";
            }
            ?>
        </div>
    </div>
    <div class="row" style="margin: 20px 10px;">
        <div class="col-sm-12 col-sm-8 col-lg-8">
            <?php
            if (isset($total) && $total != 0) {
                $no_dph = ($total / 100) * 80;
                $nodph = number_format($no_dph, 2, ',', ' ');
            ?>
                <span style="font-weight: bold; font-size: 20px;">Uplatniť zľavový kód</span>
                <div class="d-flex input-code" style="padding-top: 10px;">
                    <form method="POST" action="#" style="display: flex;">
                        <input type="text" placeholder="FESI" name="code" class="form-control"><button style="background-color: #B81600; color: white; border-radius: 10px;
                     padding: 0px 20px 0px 20px; margin-left: 10px;" type="submit" class="btn">Uplatniť</button>
                    </form>
                </div>
            <?php
            } ?>
        </div>
        <div class="col-sm-12 col-sm-4 col-lg-4" style="text-align: right; ">
            <?php
            if (isset($total) && $total != 0) {
                $no_dph = ($total / 100) * 80;
                $nodph = number_format($no_dph, 2, ',', ' ');
            ?>
                <span style="margin-top: 10px;"><strong style="font-size: 18px; padding-right: 40px">Cena spolu: </strong><span style="font-size: 25px; font-weight: bold; color: #C5230D;"><?php echo $total . "€";  ?></span></span><br>
                <span style="color: #636363; padding-right: 90px; padding-top: 20px;">Cena bez DPH: </span><span style="color: #636363;"><?php echo $nodph . "€"; ?></span>
            <?php
            } ?>
        </div>
    </div>
</div>

<!-- END mobilny kosik -->




<div class="container">
    <div class="row" style="padding-top: 50px;">
        <?php
        if (isset($total) && $total != 0) {
            $no_dph = ($total / 100) * 80;
            $nodph = number_format($no_dph, 2, ',', ' ');
        ?>
            <div class="text-center">
                <h2 style="font-weight: bold; text-align: center; padding-left: 15px;">ZVÁŽTE AJ TIETO PRODUKTY:</h2>
            </div>
    </div>
    <div class="row" style="padding-top: 50px;">
        <?php
            include "../config.php";

            // get all products
            $result = mysqli_query($link, "SELECT * FROM produkty WHERE p_nazov LIKE '%xiaomi%' LIMIT 12");

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
            <div class="col-sm-12 col-md-2 col-lg-2">
                <div class="product-card justify-content-md-center">
                    <div class="discount">

                    </div>
                    <div class="product-img justify-content-md-center">
                        <a style="color: white;" href="/<?php echo replaceAccents($row->p_nazov) ?>"><img src="catalog/<?php echo $row->p_id ?>/<?php echo $row->p_img ?>" width="159" class="img-prod" height="120"></a>
                    </div>
                    <div class="product-name justify-content-md-center">
                        <div class="heading">
                            <a style="color: white;" href="/<?php echo replaceAccents($row->p_nazov) ?>">
                                <h6 class="name-prod"><?php echo mb_strimwidth($row->p_nazov, 0, 45, "") ?></h6>
                            </a>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="product-bottom">
                            <div class="add-to-cart">
                                <?php if ($flag) { ?>

                                    <!-- UPDATE CART -->

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
                                    <span class="product-price-wdph">Bez DPH: 135.60€</span>
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
        } ?>
    </div>
</div>
<script>
    $(".update-c").submit(function(e) {
        e.preventDefault();
        var quant = $(this).children('.up-quant').val();
        var p_code = $(this).children('.up-pc').val();
        location.href = '/updatecart?quantity=' + quant + '&p_code=' + p_code;
    });
</script>
<script>
    $(".add-c").submit(function(e) {
        e.preventDefault();
        var a_quant =  $(this).children('.add-quant').val();
        var a_p_code =  $(this).children('.add-pc').val();
        location.href = '/addcart?quantity=' + a_quant + '&p_code=' + a_p_code;
    });
</script>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>