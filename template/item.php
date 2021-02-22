<?php
include_once "../includes/head-template.php";

if(isset($_COOKIE["cart"])){
    $cart = $_COOKIE['cart'];
    $cart = json_decode($cart);   
}


if(isset($_GET['ID'])){
    
    $id = $_GET['ID'];
    $sql = "SELECT * FROM produkty WHERE p_id='$id'";
    $result = mysqli_query($link, $sql) or die("Bad query");
    $row = mysqli_fetch_array($result);

    $id_produktu = $row['p_id'];
    $id_kat = $row['p_kid'];
    $nazov = $row['p_nazov'];
    $kod = $row['p_kod_sklad'];
    $popis = $row['p_popis'];
    $cena = $row['p_cena'];
    $produkt_cislo = $row['p_pn'];
    $dostupnost = $row['p_sklad'];
    $pocet_ks = $row['p_dostup'];
    $obrazok = $row['p_img'];
    }
    if(isset($id_kat)){
        $sqlko = "SELECT * FROM kategorie WHERE k_id='$id_kat'";
        $resultik = mysqli_query($link, $sqlko) or die("Bad query");
        $rowko = mysqli_fetch_array($resultik);
        $kategoria = $rowko['k_nazov'];    
    }
    if(file_exists("../catalog/$id_produktu/$obrazok")){
        $cesta = "<img src='../catalog/$id_produktu/$obrazok' style='width: 100%;'>";
    } else {
        $cesta = "<img src='../assets/images/no-image.png'  style='width: 100%;'>";
    }
?>
    <style>
        


		ul.tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
            
		}
		ul.tabs li{
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			cursor: pointer;
		}

		ul.tabs li.current{
			background: #ededed;
			color: #222;
		}

		.tab-content{
			display: none;
			background-color: #ededed;
			padding: 15px;
            
		}

		.tab-content.current{
			display: block;
		}


    </style>


    <script>
    $(document).ready(function(){
	
        $('ul.tabs li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })
    </script>
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h3><?php echo $kategoria; ?></h3>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <span style="font-size: 10px; color: grey;">Kód produktu: <?php echo $kod ?></span>
                        <div class="img-product" style="padding: 5vw">
                            <?php echo $cesta ?>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <h3 style="font-weight: bold;"><?php echo $nazov ?></h3>
                        <div class="text">
                            <p><?php echo $popis ?></p>
                        </div>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <span style="font-size: 10px; color: grey;">Produktové číslo: <?php echo $produkt_cislo ?></span>
                                <br><br><br>
                                <?php if($dostupnost == 1 && $pocet_ks >= 1 )
                                {echo "<span style='color: #149106; font-weight: 600;'>Na sklade ($pocet_ks ks)</span>";
                                } else {
                                    echo "<span style='color: #C21801; font-weight: 600;'>Nie je na sklade</span>"; 
                                }?>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <span style="color: #B81600; font-size: 30px; font-weight: bold; padding-bottom: 10px;"><?php echo $cena ?>€</span><br>
                                <?php                // check if product already exists in cart
                                $flag = false;
                                foreach ($cart as $c)
                                {
                                    if (($c->productCode == $kod))
                                    {
                                        $flag = true;
                                        break;
                                    }
                                }
                            
                                if ($flag) { ?>

                                <!-- show delete button if already exists -->

                                <form method="POST" action="../update-cart.php" style="float: right;">
                                <input type="hidden" name="quantity" value="<?php echo $c->quantity; ?>">
                                <input type="hidden" name="productCode" value="<?php echo $c->productCode; ?>">
                                <button class="btn btn-dark" name="quantity-plus" style="border-radius: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                </form>
                                <?php } else { ?>

                                <!-- add to cart -->

                                <form method="POST" action="../add-cart.php">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="productCode" value="<?php echo $kod; ?>">
                                    <button class="btn btn-dark" style="border-radius: 10px;" type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                </form>

                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <hr>
                <div class="row">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">Popis</li>
                        <li class="tab-link" data-tab="tab-2">Technické parametre</li>
                        <li class="tab-link" data-tab="tab-3">Súvisiace produkty</li>
                    </ul>

                    <div id="tab-1" class="tab-content current">
                        <?php echo $popis ?>
                    </div>
                    <div id="tab-2" class="tab-content">
                        
                    </div>
                    <div id="tab-3" class="tab-content">
                        <div class="related"  style="display: flex;">
                            <?php include (ROOT."includes/suvisiaci-tovar.php");?>
                        </div>
                        
                    </div>      
                </div>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>