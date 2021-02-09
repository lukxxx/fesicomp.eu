<!DOCTYPE html>
<html lang="sk">
<?php include "includes/head.php";?>
<body>
    <?php include "includes/header.php" ?>
    <?php include "includes/index-carousel.php"; ?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include "includes/category-list.php" ?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h2>Akciová ponuka</h2>
                <br>
                <div class="row">
                    
                        <?php 
                        include "config.php";
                        $sql = "SELECT * FROM produkty WHERE p_nazov LIKE '%asus%' LIMIT 3";
                        if($stmt = mysqli_prepare($link, $sql)){
                    
                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                                
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                                          
                                ?>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="product-card justify-content-md-center">
                                        <div class="discount">
                                        
                                        </div>
                                        <div class="product-img justify-content-md-center">
                                            <img src="catalog/<?php echo $row['p_id']?>/<?php echo $row['p_img']?>" width="159" class="img-prod" height="120">
                                        </div>
                                        <div class="product-name justify-content-md-center">
                                            <div class="heading">
                                                <h6 class="name-prod"><?php echo $row['p_nazov']?></h6>
                                            </div>
                                            
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="product-bottom justify-content-md-center">
                                                <div class="add-to-cart justify-content-md-center">
                                                    <button class="btn btn-dark" style="border-radius: 10px;" type="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                                </div>
                                                <div class="price-tag align-self-center">
                                                    <div class="pricing" style="display: block;">
                                                        <span class="product-price-dph"><?php echo $row['p_cena']?>€</span><br style="height: 1px;">
                                                        <span class="product-price-wdph">Bez DPH: 135.60€</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php                               
                                    } 
                                } else{
                                   echo "<span>POHUBENE</span>";

                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                            }
                        }?>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"?>
    <?php include "includes/scripts.php"?>
</body>
</html>