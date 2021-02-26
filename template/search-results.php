<?php 
require_once "../config.php";
include "../includes/head-template.php";
include "../includes/header-template.php";
?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include "../includes/category-list-temp.php" ?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <?php 
                    if(isset($_GET['search'])){
                        $termik = $_GET['search'];
                    }      
                ?>
                <h2>Výsledky vyhľadávania: <b><?php echo $termik ?></b></h2>
                <?php
                $like_day = "%" . $termik . "%";
                $sth = $pdo->prepare("SELECT * FROM produkty WHERE p_nazov LIKE ?");
                $sth->execute(array($like_day));
                    $rowcount_day = $sth->rowCount();
                    echo "Nájdených výsledkov: <b> ".$rowcount_day."</b>";
                while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                        $p_nazov = $row['p_nazov'];
                
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
                                    <input type="hidden" name="productCode" value="<?php echo $row->p_kod_sklad; ?>">
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
                <?php } ?>  
            </div>
        </div>
    </div>
  <?php include "../includes/footer.php"; ?>