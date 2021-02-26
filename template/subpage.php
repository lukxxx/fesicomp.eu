<?php 
    include_once "../includes/head-template.php";
    include (ROOT ."includes/header-template.php");

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
    <?php include (ROOT. "includes/footer.php") ?>

</body>
</html>
