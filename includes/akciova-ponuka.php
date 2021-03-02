<?php
require_once "config.php";
        $result = mysqli_query($link, "SELECT * FROM produkty WHERE p_nazov LIKE '%macbook air 13%' LIMIT 4");

        // get cookie cart
        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);

        // loop through all cart items
        while ($row = mysqli_fetch_object($result))
        {
            $popis = $row->p_popis;
            // check if product already exists in cart
            $flag = false;
            foreach ($cart as $c)
            {
                if (($c->productCode == $row->p_kod_sklad))
                {
                    $flag = true;
                    break;
                }
            }
            
            ?>
            <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="product-card justify-content-md-center">
                        <div class="discount">

                        </div>
                        <div class="product-img justify-content-md-center">
                            <a style="color: white;" href="template/item.php?ID=<?php echo $row->p_id ?>"><img src="catalog/<?php echo $row->p_id ?>/<?php echo $row->p_img ?>"
                             width="" class="img-prod" height="120"></a>
                        </div>
                        <div class="product-name justify-content-md-center">
                            <div class="heading">
                            <a style="color: white;" href="template/item.php?ID=<?php echo $row->p_id ?>"><h6 class="name-prod"><?php echo $row->p_nazov ?></h6></a>
                            </div>
                        </div>
                        

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="product-bottom justify-content-md-center">
                                <div class="add-to-cart justify-content-md-center">
                                <?php
                            
                                if ($flag) { ?>

                                <!-- show delete button if already exists -->

                                <form method="POST" action="update-cart.php" style="float: right;">
                                <input type="hidden" name="quantity" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button class="btn btn-dark" name="quantity-plus" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                                </form>
                                <?php } else { ?>

                                <!-- add to cart -->

                                <form method="POST" action="add-cart.php">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="productCode" value="<?php echo $row->p_id; ?>">
                                    <button class="btn btn-dark" style="border-radius: 10px; margin-top: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
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