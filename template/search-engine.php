<?php
if ($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs") {
  include $_SERVER['DOCUMENT_ROOT'] . "/fesicomp.eu/config.php";
} else {
  include $_SERVER['DOCUMENT_ROOT'] . "/config.php";
}
if(isset($_REQUEST["term"]) && strlen($_REQUEST['term']) >= 3){
    $var = $_REQUEST["term"];
    $likeVar = "%" . $var . "%";
    $sql = "SELECT * FROM produkty WHERE p_nazov LIKE ? LIMIT 5";
    $kat = "SELECT * FROM kategorie WHERE k_nazov LIKE ? LIMIT 3";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $likeVar);
        
        $var = $_REQUEST["term"] . '%';

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) > 0){
                  echo "<hr style='margin: 0; margin-bottom: 2%;  border: 0.5px solid black;}'>";
                  echo "<span style='font-weight: bold; font-size: 15px'><i class='fas fa-arrow-right'></i> Produkty</span>";
                  echo "<hr>";
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  echo "<div style'display: flex; text-overflow: ellipsis; width: 80%'>";
                     echo "<a href='".$root_url."/produkt/".replaceAccents($row['p_nazov'])."' style='color: black'><p style='font-size: 15px'><img src='catalog/".$row['p_id']."/".$row['p_img']."' width='30' height='20'><span style='padding-left: 10px'>" . $row["p_nazov"] . "</span>";
                     echo "<span style='float: right; font-weight: bold; color: red;'>".$row['p_cena']."€</span></p></a>";
                   echo "</div>";
              }
            } else{
               echo "<span style='font-weight: bold; font-size: 15px'><i class='fas fa-arrow-right'></i> Produkty</span>";
               echo "<hr>";
               echo "<p>Nič sme nenašli</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }if($stmt = mysqli_prepare($link, $kat)){
      mysqli_stmt_bind_param($stmt, "s", $param_term);
      
      $param_term = $_REQUEST["term"] . '%';
      
      if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
          
          if(mysqli_num_rows($result) > 0){
                echo "<span style='font-weight: bold; font-size: 15px'><i class='fas fa-arrow-right'></i> Kategórie</span>";
                echo "<hr>";
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                   echo "<a href='".$root_url."/kategoria/".replaceAccents($row['k_nazov'])."' style='color: black'><p style='font-size: 15px'><i class='fas fa-folder-open'></i><span style='padding-left: 10px'>". $row["k_nazov"] . "</span></a>";

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
function replaceAccents($str)
{
    $search = explode(
        ",",
        "á,ä,č,ď,dž,é,ě,í,ĺ,ľ,ň,ó,ô,ŕ,ř,š,ť,ú,ů,ý,ž,Á,Ä,Č,Ď,DŽ,É,Ě,Í,Ĺ,Ľ,Ň,Ó,Ô,Ŕ,Ř,Š,Ť,Ú,Ů,Ý,Ž"
    );
    $replace = explode(
        ",",
        "a,a,c,d,dz,e,e,i,l,l,n,o,o,r,r,s,t,u,u,y,z,A,A,C,D,DZ,E,E,I,L,L,N,O,O,R,R,S,T,U,U,Y,Z"
    );
    $newstring = str_replace($search, $replace, $str);
    $newstring = strtolower($newstring);
    $newstring = str_replace(' ', '-', $newstring);
    $newstring = str_replace(',', '-', $newstring);
    $newstring = str_replace('.', '', $newstring);
    $newstring = str_replace('/', '', $newstring);
    $newstring = str_replace('™', '', $newstring);
    $newstring = str_replace('+', '', $newstring);
    $newstring = str_replace('*', '', $newstring);
    $newstring = str_replace('"', '', $newstring);
    $newstring = str_replace(')', '', $newstring);
    $newstring = str_replace('(', '', $newstring);
    return $newstring;
}
?>
