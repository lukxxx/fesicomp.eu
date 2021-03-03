<?php
include_once "../includes/head-template.php"
?>
<script type='text/javascript'>
    function updateURLParameter(url, param, paramVal)
{
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) 
    {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
        if(TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i=0; i<tempArray.length; i++)
        {
            if(tempArray[i].split('=')[0] != param)
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }        
    }
    else
    {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor  = tmpAnchor[1];

        if(TheParams)
            baseURL = TheParams;
    }

    if(TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    window.location = baseURL + "?" + newAdditionalURL + rows_txt;
}

</script>
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!--<a style="color: black;" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span><i class="fas fa-arrow-left"></i> Krok späť</span></a>-->
                <!--------------------------------------------------------------------------------------------------------------------------------------------------------->

                
                
                
                 <!--       _
                        .__(.)< (kač kač)
                        \___)   
                ~~~~~~~~~~~~~~~~~~-->
                <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
                    
                    

                    
                    <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $search = $_GET['search'];
                        $no_of_records_per_page = 24;
                        $offset = ($page-1) * $no_of_records_per_page; 
                        $total_pages_sql = "SELECT COUNT(*) FROM produkty WHERE p_nazov LIKE '%$search%' and p_aktualni !='0'";
                        $result = mysqli_query($link,$total_pages_sql);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows/$no_of_records_per_page);
                        
                        ?>
                        <div class = "row" >
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                                <h3><b>Hľadaný výraz: </b><?php echo $search; ?></h3>
                                <p>Počet nájdených položiek: <?php echo $total_rows ?></p>  
                                <hr>
                                <div class="button-box ">    
                                    <span>Zoradiť podľa: </span><br>                
                                    <a href="#"  onclick="updateURLParameter(window.location.href, 'cena','ASC' )"class="btn btn-dark" role="button">Najlacnejšie</a>
                                    <a href="#"  onclick="updateURLParameter(window.location.href, 'cena','DESC' )"class="btn btn-dark" role="button">Najdrahšie</a>                    
                                </div>                                                                      
                            </div>
                        </div>
                        <br>
                        <div class = "row" >
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                                                                                                   
                            </div>
                        </div>
                        <div class="d-flex flex-wrap row">
                        <?php
                            if (isset($_GET['cena'])) {
                                $cena = $_GET['cena'];
                                //echo $cena;
                                $sql = "SELECT * FROM produkty WHERE p_nazov LIKE '%$search%' and p_aktualni !='0' and p_cena != '' ORDER BY p_cena $cena LIMIT $offset, $no_of_records_per_page  ";
                            } else {
                                $sql = "SELECT * FROM produkty WHERE p_nazov LIKE '%$search%' and p_aktualni !='0' and p_cena != '' LIMIT $offset, $no_of_records_per_page";
                            }
                            
                            if($stmt = mysqli_prepare($link,$sql)){
                                if(mysqli_stmt_execute($stmt)){
                                    $result = mysqli_stmt_get_result($stmt);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            $obrazok = $row['p_img'];
                                            $id_produktu = $row['p_id'];
                                            if(file_exists("../catalog/$id_produktu/$obrazok")){
                                                $cesta = "<img src='../catalog/$id_produktu/$obrazok' class='img-prod' style='max-width: 120px;max-height: 120px;'>";
                                            } else {
                                                $cesta = "<img class='img-prod' src='../assets/images/no-image.png' style='max-width: 120px;max-height: 120px;'>";
                                            }
                                        ?>                                
                                            <div class="col-sm-12 col-md-4 col-lg-3">
                                                <div class="product-card justify-content-md-center">
                                                    <div class="discount">
                            
                                                    </div>
                                                    <div class="product-img justify-content-md-center">
                                                        <a href="item.php?ID=<?php echo $row['p_id']?>"><?php echo $cesta; ?></a>
                                                    </div>
                                                    <div class="product-name justify-content-md-center">
                                                        <div class="heading">
                                                            <a style="color: white;" href="item.php?ID=<?php echo $row['p_id']?>"><h6 class="name-prod"><?php echo mb_strimwidth($row['p_nazov'], 0, 30, "");?></h6></a>
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
                                        } mysqli_close($link);
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
                            <li class="prev"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '<?php Print( $page-1)?>' )">Predchádzajúca</a></li>
                            <?php endif; ?>

                            <?php if ($page > 3): ?>
                            <li class="start"><a href="#" onclick="updateURLParameter(window.location.href, 'page', '1');return false;">1</a></li>
                            <li class="dots">...</li>
                            <?php endif; ?>

                            <?php if ($page-2 > 0): ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $page-2)?> )"><?php echo $page-2 ?></a></li><?php endif; ?>
                            <?php if ($page-1 > 0): ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $page-1)?> )"><?php echo $page-1 ?></a></li><?php endif; ?>

                            <li class="currentpage"><a href="?KID=<?php echo $kid?>&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                            <?php if ($page+1 < ceil($total_pages)+1): ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $page+1)?> )"><?php echo $page+1 ?></a></li><?php endif; ?>
                            <?php if ($page+2 < ceil($total_pages)+1): ?><li class="page"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $page+2)?> )"><?php echo $page+2 ?></a></li><?php endif; ?>

                            <?php if ($page < ceil($total_pages)-2): ?>
                            <li class="dots">...</li>
                            <li class="end"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $total_pages)?> )" ><?php echo ceil($total_pages) ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < ceil($total_pages)): ?>
                            <li class="next"><a href="#" onclick="updateURLParameter(window.location.href, 'page',<?php Print( $page+1)?> )">Ďalšia</a></li>
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