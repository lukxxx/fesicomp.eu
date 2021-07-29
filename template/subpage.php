<?php 
    if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
        include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
    } else {
        include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
    }
    include $root_dir."/includes/header.php";


    // TODO : Zmeniť toto na GET SEO-Friendly URLs
    $s_id = $_GET["ID"];
    $sql = "SELECT * FROM podstranky WHERE s_id = $s_id";
    $result = $link->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>
    <div class="container" style="padding: 20px 13px 0 10px">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-8">           
                <?php echo  $row["s_text"]; ?>
            </div>
        </div>
    </div>
    <?php include $root_dir."/includes/footer.php" ?>

</body>
</html>
