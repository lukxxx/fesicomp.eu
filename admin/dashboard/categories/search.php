<?php
include "../../config.php";
if(isset($_REQUEST["term"]) && strlen($_REQUEST['term']) >= 3){
    $var = $_REQUEST["term"];
    $kat = "SELECT * FROM kategorie WHERE k_nazov LIKE ? LIMIT 20";
    if($stmt = mysqli_prepare($link, $kat)){
      mysqli_stmt_bind_param($stmt, "s", $param_term);
      
      $param_term = $_REQUEST["term"] . '%';
      
      if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
          
          if(mysqli_num_rows($result) > 0){
                
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                   echo '<div class="category card " style="border: 1px solid #E7E7E7; padding: 10px; margin-bottom: 10px; background-color: white; box-shadow: 2px 2px 10px -2px #616161; border-radius: 20px;">';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<span style="padding-left: 10px;"><b>'.$row['k_nazov'].'</b></span>
                    <form method="post" action="index.php" >
                    
                    <button type="submit" name="set" value="'.$row['k_id'].'" class="btn" style="all:unset; cursor: pointer;"><i style="font-size: 20px" class="fas fa-cog"></i></button>
                    </form>
                </div>';
                echo '</div>';
            }
          } else {
            echo "<span style='font-weight: bold; font-size: 15px'><i class='fas fa-arrow-right'></i> Kateórie</span>";
            echo "<hr>";
            echo "<p>Nič sme nenašli</p>";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
   }
     
    mysqli_stmt_close($stmt);
} else if(isset($_REQUEST["term"]) && strlen($_REQUEST['term']) <= 3){
    echo "Píšte ďalej...";
}
 
mysqli_close($link);
?>
