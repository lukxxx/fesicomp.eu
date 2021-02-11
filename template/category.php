<?php
include_once "../includes/head-template.php";
   
if(isset($_GET['KID'])){
    $kid = $_GET['KID'];
    $sql = "SELECT * FROM produkty WHERE p_kid='$kid'";
    $kategoria = "SELECT * FROM kategorie WHERE k_id='$kid'";
    $kat = "SELECT * FROM kategorie WHERE k_kategoria='$kategoria'";
    
    if($stmt = mysqli_prepare($link, $sql)){
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  $produkt = $row['p_nazov'];
              }
            } else{
               echo "<p>Nič sme nenašli</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }if($stmt = mysqli_prepare($link, $kat)){
      if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
          
          if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $kategor = $row['k_nazov'];
            }
          } else {
            echo "<p>Nič sme nenašli tu</p>";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
    }
   }
    /*$sqlko = "SELECT * FROM kategorie WHERE k_id='$kid' AND k_podkategoria=''";
    $resultik = mysqli_query($link, $sqlko) or die("Bad query");
    $rowko = mysqli_fetch_array($resultik);
    $kategoria = $rowko['k_nazov'];   
    $pod_kat = $rowko['k_podkategoria']; 
    
    
    $sql = "SELECT * FROM produkty WHERE p_kid='$kid'";
    $result = mysqli_query($link, $sql) or die("Bad query");
    while($row = mysqli_fetch_array($result)){
        $produkty = $row['p_nazov'];    
    }
    
}
        
    /*
    if(file_exists("../catalog/$id_produktu/$obrazok")){
        $cesta = "<img src='../catalog/$id_produktu/$obrazok' style='width: 100%;'>";
    } else {
        $cesta = "<img src='../assets/images/no-image.png'  style='width: 100%;'>";
    }*/
?>
<!DOCTYPE html>
<html lang="sk">
<body>
    <?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include (ROOT."includes/category-list-temp.php")?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h3><?php echo $kategor; ?></h3>
                <h4><?php echo $produkt; ?></h4>
                <br>
            </div>
        </div>   
    </div>
    <?php include (ROOT. "includes/footer.php") ?>
    
</body>
</html>