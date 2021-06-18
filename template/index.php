<!DOCTYPE html>
<html lang="sk">
<?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");
if(isset($_COOKIE['details'])){
    unset($details);
    unset($_COOKIE['details']);
    setcookie('details', null, time() - 3600, "/");
}
?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/header.php") ?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/index-carousel.php"); ?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <?php include($_SERVER['DOCUMENT_ROOT']."/includes/category-list.php") ?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h2 class="akciova_ponuka">Akciová ponuka</h2>
                <br>
                <div class="row">
                    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/akciova-ponuka.php")?>
                </div>
                <h2 class="nase_sluzby">Naše služby</h2>
                    <br>
                <div class="row services" style="padding-bottom: 20px">
                    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/sluzby.php") ?>
                </div>
                <h2 class="nove_produkty">Nové produkty</h2>
                    <br>
                <div class="row">
                    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/nove-produkty.php") ?>
                </div>
            </div>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/footer.php")?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/scripts.php")?>
</body>
</html>