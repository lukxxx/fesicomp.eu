<?php
include_once "../includes/head-template.php"
?>
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!--<a style="color: black;" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span><i class="fas fa-arrow-left"></i> Krok späť</span></a>-->
                <div class="d-flex flex-wrap"><?php
                    
                    $kid = $_GET['KID'];
                    $name = "SELECT * FROM kategorie WHERE k_kid = '$kid' AND k_aktualni != '2' AND k_medzera ='0'  ORDER BY k_poradie";
                    if($stmt = mysqli_prepare($link,$name)){
                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
                                    ?>     
                                        <div class="col-sm-12 col-md-4 col-lg-3 ">
                                            <a class="category-link" href="category.php?KID=<?php echo $row['k_id']?>">
                                            <div class="category-card justify-content-md-center">
                                                 <span style="color: black; font-size: 17px;"> <?php echo $row['k_nazov']?></span> 
                                            </div>      
                                            <a>
                                        </div>
                                        
                                <?php
                                }
                            }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    }
                 ?></div>
                 <hr>
                    <div class="d-flex flex-wrap row">
                    <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $no_of_records_per_page = 24;
                        $offset = ($page-1) * $no_of_records_per_page; 
                        $total_pages_sql = "SELECT COUNT(*) FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0'";
                        $result = mysqli_query($link,$total_pages_sql);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows/$no_of_records_per_page);

                            $sql = "SELECT * FROM produkty WHERE (p_kid IN (SELECT k_id FROM kategorie WHERE k_kid ='$kid') OR p_kid='$kid') and p_aktualni !='0' LIMIT $offset, $no_of_records_per_page";
                            if($stmt = mysqli_prepare($link,$sql)){
                                if(mysqli_stmt_execute($stmt)){
                                    $result = mysqli_stmt_get_result($stmt);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        ?>                                
                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                <div class="product-card justify-content-md-center">
                                                    <div class="discount">
                            
                                                    </div>
                                                    <div class="product-img justify-content-md-center">
                                                        <a href="item.php?ID=<?php echo $row['p_id']?>"><img src="../catalog/<?php echo $row['p_id'] ?>/<?php echo $row['p_img']  ?>" 
                                                         class="img-prod" height="120"></a>
                                                    </div>
                                                    <div class="product-name justify-content-md-center">
                                                        <div class="heading">
                                                            <a style="color: white;" href="item.php?ID=<?php echo $row['p_id']?>"><h6 class="name-prod"><?php echo $row['p_nazov'] ?></h6></a>
                                                        </div>
                            
                                                    </div>
                            
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="product-bottom justify-content-md-center">
                                                            <div class="add-to-cart justify-content-md-center">
                                                                <button class="btn btn-dark" style="border-radius: 10px;" type="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Kúpiť</button>
                                                            </div>
                                                            <div class="price-tag align-self-center">
                                                                <div class="pricing" style="display: block;">
                                                                    <span class="product-price-dph"><?php echo $row['p_cena'] ?>€</span><br style="height: 1px;">
                                                                    <?php 
                                                                        $no_dph = ($row['p_cena'] / 100) * 80; 
                                                                        $nodph = number_format($no_dph, 2, ',', ' ');
                                                                    ?>
                                                                    <span class="product-price-wdph">Bez DPH:<?php echo $nodph; ?>€</span>
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
                                    } 
                                } else{
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                }
                            }
                        
                    ?>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <ul class="pagination ">
                            <?php if ($page > 1): ?>
                            <li class="prev"><a href="?KID=<?php echo $kid?>&page=<?php echo $page-1 ?>">Predchádzajúca</a></li>
                            <?php endif; ?>

                            <?php if ($page > 3): ?>
                            <li class="start"><a href="?KID=<?php echo $kid?>&page=1">1</a></li>
                            <li class="dots">...</li>
                            <?php endif; ?>

                            <?php if ($page-2 > 0): ?><li class="page"><a href="?KID=<?php echo $kid?>&page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
                            <?php if ($page-1 > 0): ?><li class="page"><a href="?KID=<?php echo $kid?>&page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

                            <li class="currentpage"><a href="?KID=<?php echo $kid?>&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                            <?php if ($page+1 < ceil($total_pages)+1): ?><li class="page"><a href="?KID=<?php echo $kid?>&page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
                            <?php if ($page+2 < ceil($total_pages)+1): ?><li class="page"><a href="?KID=<?php echo $kid?>&page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

                            <?php if ($page < ceil($total_pages)-2): ?>
                            <li class="dots">...</li>
                            <li class="end"><a href="?KID=<?php echo $kid?>&page=<?php echo ceil($total_pages) ?>"><?php echo ceil($total_pages) ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < ceil($total_pages)): ?>
                            <li class="next"><a href="?KID=<?php echo $kid?>&page=<?php echo ($page+1) ?>">Ďalšia</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>