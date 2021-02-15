<?php
include_once "../includes/head-template.php";
   
if(isset($_GET['KID'])){
    $kid = $_GET['KID'];
    $sql = "SELECT * FROM produkty WHERE p_kid='$kid'";
    $kat = "SELECT * FROM kategorie WHERE k_kategoria = (SELECT k_kategoria FROM kategorie WHERE k_id='$kid')";
    
    if($stmt = mysqli_prepare($link, $sql)){
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  $produkt = $row['p_nazov'];
              }
            } else{
               echo "<p>Nič sme nenašli</p>" ;
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
   }
    
?>
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h3><?php
                    $kid = $_GET['KID'];
                        if($stmt = mysqli_prepare($link,"SELECT * FROM kategorie WHERE k_kategoria = (SELECT k_kategoria FROM kategorie WHERE k_id='$kid')")){
                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        echo "<p><a href='product_list.php?KID=".$row['k_id']."'>".$kategor = $row['k_nazov']." ".$row['k_kid']."<a></p>";
                                    }
                                } else {
                                echo "<p>Nič sme nenašli tu</p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                            }
                        }
                 ?></h3>
                <h4><?php echo $produkt; ?></h4>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>