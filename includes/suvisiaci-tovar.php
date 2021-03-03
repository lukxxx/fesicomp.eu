<?php
if(isset($_GET['ID'])){
    $id = $_GET['ID'];
    $sql = "SELECT * FROM produkty WHERE p_kod_sklad IN (SELECT s_kod_suvisiaci FROM suvisiaci where s_kod = (SELECT p_kod_sklad FROM produkty WHERE p_id='$id')) LIMIT 3";
}
if ($stmt = mysqli_prepare($link, $sql)) {

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if(file_exists("../catalog/".$row['p_id']."/".$row['p_img']."")){
                    $cesta = "<img loading='lazy' src='../catalog/".$row['p_id']."/".$row['p_img']." width='159' class='img-prod' height='120'>";
                } else {
                    $cesta = "<img loading='lazy' src='../assets/images/no-image.png' width='140' class='img-prod' height='120'>";
                }
?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="product-card-related justify-content-md-center">
                        <div class="discount">

                        </div>
                        <div class="product-img justify-content-md-center">
                            <a href="item.php?ID=<?php echo $row['p_id']?>"><?php echo $cesta ?></a>
                        </div>
                        <div class="product-name justify-content-md-center">
                            <div class="heading">
                                <a style="color: white;" href="item.php?ID=<?php echo $row['p_id']?>"><h6 class="name-prod"><?php echo $row['p_nazov'] ?></h6></a>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="product-bottom justify-content-md-center">
                                <div class="add-to-cart-related justify-content-md-center">
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
            echo "<span>Pre tento produkt neexistujú žiadne súvisiace produkty</span>";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
} ?>