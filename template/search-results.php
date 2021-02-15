<?php 

include "../includes/head-template.php";
include "../includes/header-template.php";

if(isset($_POST['search'])){
    $term = $_POST['search'];
}
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
$sth = $pdo->prepare("SELECT * FROM produkty WHERE p_nazov LIKE ?");
$sth->execute(array($subidubi));
if($sth->rowCount() >= 1){
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $nazov = $row['p_nazov'];

} else {
    echo "zle";
}
echo $nazov
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include "../includes/footer.php"; ?>