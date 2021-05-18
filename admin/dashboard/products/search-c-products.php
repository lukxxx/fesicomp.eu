<?php

include "../../config.php";
if(isset($_REQUEST["term"]) && strlen($_REQUEST['term']) >= 3){
    $var = $_REQUEST["term"];
    $vyr = "SELECT * FROM kategorie WHERE k_nazov LIKE ? LIMIT 20";
    if($stmt = mysqli_prepare($link, $vyr)){
      mysqli_stmt_bind_param($stmt, "s", $param_term);
      
      $param_term = $_REQUEST["term"] . '%';
      
      if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
          
          if(mysqli_num_rows($result) > 0){
            $projects = array();
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $projects[] = $row;
            }
            foreach ($projects as $project) {
            ?>
                <div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn">

                        <div class="edit_k" style="display: none;">
                            <i class="far fa-edit"></i>
                        </div>
                        <div class="id_k">
                            <span style="font-size: 24px; font-weight: bold; padding-top: 1%"><?php echo $project['k_id']; ?></span>
                        </div>
                        <div class="inner" >
                            <div class="ano">
                        <div class=" nazovik">
                                <span style="font-size: 24px; font-weight: bold; padding-top: 1%"><?php echo $project['k_nazov']; ?></span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <script>
            $('.download-btn').hover(
				
                function () {
                    $(this).children('.edit_k').fadeIn("fast");
                }, 
                 
                function () {
                    $(this).children('.edit_k').css('display', 'none');
                }
             );
            </script>
    <?php
            }
          } else {
            echo "<p>Nič sme nenašli</p>";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
   }mysqli_stmt_close($stmt);
     
    
} else if(isset($_REQUEST["term"]) && strlen($_REQUEST['term']) <= 3){
    echo "Píšte ďalej...";
}
 
mysqli_close($link);
?>
