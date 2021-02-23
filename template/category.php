<?php
    include_once "../includes/head-template.php";
?>
    
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h3 class="d-flex flex-wrap"><?php
                    
                    $kid = $_GET['KID'];
                    $name = "SELECT * FROM kategorie WHERE k_kid = '$kid' AND k_aktualni != '2' AND k_medzera ='0'  ORDER BY k_poradie";
                    if($stmt = mysqli_prepare($link,$name)){
                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
                                    ?>     
                                        <div class="col-sm-12 col-md-4 col-lg-3 category-card justify-content-md-center" >      
                                            <a href="category.php?KID=<?php echo $row['k_id']?>"> <h4 style="color: black"> <?php echo $row['k_nazov']?></h4> <a>
                                        </div>
                                        
                                <?php
                                }
                            }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    }
                 ?></h3>

                    <div class="d-flex flex-wrap row">
                <?php
                    $kid = $_GET['KID'];
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $no_of_records_per_page = 28;
                    $offset = ($page-1) * $no_of_records_per_page; 
                
                    $total_pages_sql = "SELECT COUNT(*) FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0'";
                    $result_page = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result_page)[0];;
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                        $sql = "SELECT * FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0' LIMIT $offset,$no_of_records_per_page";
                        if($stmt = mysqli_prepare($link,$sql)){
                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    ?>                                
                                        <div class="col-sm-12 col-md-6 col-lg-4">
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
                                    ?>
                                    <ul class="pagination">
                                        <li><a href="?KID=<?php echo $row['k_id']?>&page=1">First</a></li>
                                        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
                                            <a href="?KID=<?php echo $row['k_id']?><?php if($page <= 1){ echo '#'; } else { echo "&page=".($page- 1); } ?>">Prev</a>
                                        </li>
                                        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                                            <a href="?KID=<?php echo $row['k_id']?><?php if($page >= $total_pages){ echo '#'; } else { echo "&page=".($page+ 1); } ?>">Next</a>
                                        </li>
                                        <li><a href="?KID=<?php echo $row['k_id']?>&page=<?php echo $total_pages; ?>">Last</a></li>
                                    </ul>
                                    <?php
                                } else {
                                    echo "<p>Nič sme nenašli tu</p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                            }
                        }
                    ?>
                    </div>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>