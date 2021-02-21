<?php include "../includes/head-template.php";
include "../includes/header-template.php";
?>

<div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <a style="color: black;" href="../index.php"><i class="fas fa-arrow-left"></i> Pokračovať v nákupe</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold;">KOŠÍK</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            <a style="color: black; text-align: right;" href="../index.php">Pokračovať k objednávke <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center" sty>
            <div class="<table class="table">       
    <?php
    if(isset($_COOKIE['cart']) && $_COOKIE['cart'] != "[]"){
        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);

        $total = 0;
        echo '<table class="table  table-bordered">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th scope="col">Kód tovaru</th>';
        echo '<th scope="col">Názov produktu</th>';
        echo '<th scope="col" style="width: 10vw;">Množstvo</th>';
        echo '<th scope="col">Dostupnosť</th>';
        echo '<th scope="col">Cena</th>';
        echo '<th scope="col" style="text-align: center;"><i class="fas fa-trash-alt"></i></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($cart as $c)
        {
            $total += $c->product->p_cena * $c->quantity;
            ?>  
                    <tr >
                        <th style="padding: 20px;"><?php echo $c->product->p_kod_sklad; ?></th>
                        <th style="padding: 20px;"><?php echo $c->product->p_nazov; ?></th>
                        <th style="padding: 20px;">
                            <form method="POST" action="../update-cart.php" style="float: right;">
                            <button type="submit" name="quantity-minus" style="all: unset; cursor: pointer;"><i class="fas fa-minus"></i></button>
                                <input style="all: unset; width: 20%; margin-left: 15px;" type="number" name="quantity" min="1" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button type="submit" name="quantity-plus" style="all: unset; cursor: pointer;"><i class="fas fa-plus"></i></button>
                            </form>
                        </th>
                        <th style="padding: 20px;"><?php if($c->product->p_sklad == 1){ echo "<span style='color: #149106'>Skladom</span>"; }  ?></th>
                        <th style="padding: 20px;"><?php echo $c->product->p_cena * $c->quantity; ?>€</th>
                        <th style="padding: 20px 20px 20px 0px;  text-align: center;">
                            <form method="POST" action="../delete-cart.php" style="float: right; margin-left: 10px; text-align:center;">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">
                                    x
                                </button>
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
             if(isset($total) && $total != 0){ 
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
            }?>
        </div>
        <div class="col-sm-12 col-sm-4 col-lg-4" style="text-align: right; ">
            <?php 
            if(isset($total) && $total != 0){ 
            $no_dph = ($total / 100) * 80; 
            $nodph = number_format($no_dph, 2, ',', ' ');
            ?>
            <span><strong style="font-size: 24px; padding-right: 40px">Cena spolu: </strong><span style="font-size: 33px; font-weight: bold; color: #C5230D;"><?php echo $total."€";  ?></span></span><br>   
            <span style="color: #636363; padding-right: 90px; padding-top: 20px;">Cena bez DPH: </span><span style="color: #636363;"><?php echo $nodph."€"; ?></span>
            <?php 
            }?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="padding-top: 50px;">
    <?php 
             if(isset($total) && $total != 0){ 
                $no_dph = ($total / 100) * 80; 
                $nodph = number_format($no_dph, 2, ',', ' ');
                ?>
        <div class="text-center">
            <h2 style="font-weight: bold; text-align: center; padding-left: 15px;">ZVÁŽTE AJ TIETO PRODUKTY:</h2>
        </div>       
    </div>
    <div class="row" style="padding-top: 50px;">
    <?php
        // connect with database
        $conn = mysqli_connect("localhost", "root", "", "compsnv");
        
        // get all products
        $result = mysqli_query($conn, "SELECT * FROM produkty WHERE p_nazov LIKE '%xiaomi%' LIMIT 4");

        // get cookie cart
        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);

        // loop through all cart items
        while ($row = mysqli_fetch_object($result))
        {
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
                            <a style="color: white;" href="item.php?ID=<?php echo $row->p_id ?>"><img src="catalog/<?php echo $row->p_id ?>/<?php echo $row->p_img ?>"
                             width="159" class="img-prod" height="120"></a>
                        </div>
                        <div class="product-name justify-content-md-center">
                            <div class="heading">
                            <a style="color: white;" href="item.php?ID=<?php echo $row->p_id ?>"><h6 class="name-prod"><?php echo $row->p_nazov ?></h6></a>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="product-bottom justify-content-md-center">
                                <div class="add-to-cart justify-content-md-center">
                                <?php if ($flag) { ?>

                                <!-- UPDATE CART -->

                                <form method="POST" action="../update-cart.php" style="float: right;">
                                <input type="hidden" name="quantity" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button class="btn btn-dark" name="quantity-plus" style="border-radius: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                </form>
                                <?php } else { ?>

                                <!-- add to cart -->

                                <form method="POST" action="../add-cart.php">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="productCode" value="<?php echo $row->p_kod_sklad; ?>">
                                    <button class="btn btn-dark" style="border-radius: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
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
            }?>   
    </div>
</div>
    

</div>

<?php include "../includes/footer.php";?>

