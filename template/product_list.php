<?php
include_once "../includes/head-template.php";
?>
<?php include (ROOT ."includes/header-template.php")?>
<div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9 ">
                <div class="row">
                    <h3><?php
                        if(isset($_GET['KID'])){
                            $kid = $_GET['KID'];
                            $sql = "SELECT * FROM produkty WHERE p_kid='$kid'";
                        }
                            if($stmt = mysqli_prepare($link,$sql)){
                                if(mysqli_stmt_execute($stmt)){
                                    $result = mysqli_stmt_get_result($stmt);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        ?>                                
                                            <div class="col-sm-12 col-md-4 col-lg-4 " >
                                                <div class="product-card justify-content-md-center">
                                                    <div class="discount">
                            
                                                    </div>
                                                    <div class="product-img justify-content-md-center">
                                                        <a href="item.php?ID=<?php echo $row['p_id']?>"><img src="catalog/<?php echo $row['p_id'] ?>/<?php echo $row['p_img'] ?>" 
                                                        width="159" class="img-prod" height="120"></a>
                                                    </div>
                                                    <div class="product-name justify-content-md-center">
                                                        <div class="heading">
                                                            <a style="color: white;" href="item.php?ID=<?php echo $row['p_id']?>"><h6 class="name-prod"><?php echo $row['p_nazov'] ?></h6></a>
                                                        </div>
                            
                                                    </div>
                            
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="product-bottom justify-content-md-center">
                                                            <div class="add-to-cart justify-content-md-center">
                                                                <button class="btn btn-dark" style="border-radius: 10px;" type="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Do košíka</button>
                                                            </div>
                                                            <div class="price-tag align-self-center">
                                                                <div class="pricing" style="display: block;">
                                                                    <span class="product-price-dph"><?php echo $row['p_cena'] ?>€</span><br style="height: 1px;">
                                                                    <span class="product-price-wdph">Bez DPH: 135.60€</span>
                                                                </div>
                            
                                                            </div>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                    echo "<p>Nič sme nenašli tu</p>";
                                    }
                                } else{
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                }
                            }
                    ?></h3>
                </div>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>