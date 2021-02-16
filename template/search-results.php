<?php 

include "../includes/head-template.php";
include "../includes/header-template.php";
$db_host = "localhost";
$db_name = "compsnv";
$db_user = "root";
$db_pass = "";


// Create a connection to the MySQL database using PDO
$pdo = new pdo(
    "mysql:host={$db_host};dbname={$db_name}",
    $db_user,
    $db_pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => FALSE
    ]
);
if(isset($_POST['search'])){
    $term = $_POST['search'];
    $sql = "SELECT DISTINCT * FROM produkty WHERE p_nazov LIKE ?";
        $query = $pdo->prepare($sql);
        $query->execute([$term]);
        $post_count = $query->rowCount();
    
        $result = '';
        if ($post_count > 0) {
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $num = "(".$post_count.")";
                $div = "<div style='border: 1px solid black; border-radius: 5px; margin-bottom:2%' class='row'>";
                $col1 = "<div style='border: 1px 0px 0px 0px solid black; padding: 1%; width: 100% ' class'col-sm-12 col-md-12 col-lg-12'>";
                $vysledok = "<h2 style='text-decoration: underline; padding-left: 2%;'>".$row['meno']."  ".$row['priezvisko']."</h2>";
                $mail = "<p style='padding-left : 2%; font-size: 11px;'><strong>Rok narodenia:</strong> ".$row['rok_narodenia']." <br><strong>E-mail: </strong> ".$row['email']."</p>";
                $mesto = "<p style='padding-left: 2%'><strong>Mesto:</strong> ".$row['mesto']." <strong>Kraj:</strong> ".$row['kraj']."</p>";            
                $div_end = "</div>";
                $result .= $div. $col1. $vysledok. $mail.$mesto. $div_end. $col1. $div_end. $div_end ;
            }
        }else{
            $error = "Vašemu vyhľadávaniu nezodpovedá žiaden vodič";
        }
    }



$subidubi = "dell";
?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include "../includes/category-list-temp.php" ?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h3>Hľadaný výraz: <span style="font-size: 20px;"><?php echo $subidubi; ?></span></h3>
                <div class="row">
                    
                <?php
                
                echo $nazov;


?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include "../includes/footer.php"; ?>