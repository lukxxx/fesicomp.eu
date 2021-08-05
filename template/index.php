<?php
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}
if(isset($_COOKIE['details'])){
    unset($details);
    unset($_COOKIE['details']);
    setcookie('details', null, time() - 3600, "/");
}
?>
    <?php include $root_dir."/includes/header.php" ?>
    <?php include $root_dir."/includes/index-carousel.php" ?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <?php include $root_dir."/includes/category-list.php" ?>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9" style="margin: auto;">
                <h2 class="akciova_ponuka">Akciová ponuka</h2>
                <br>
                <div class="row">
                    <?php include $root_dir."/includes/akciova-ponuka.php" ?>
                </div>
                <br>
                <h2 class="akciova_ponuka" style="font-weight: bold;">Produkty, ktoré by sa Vám mohli páčiť</h2>
                <br>
                <div class="row">
                    <?php include $root_dir."/includes/like.php" ?>
                </div>
                <h2 class="nase_sluzby">Naše služby</h2>
                    <br>
                <div class="row services" style="padding-bottom: 20px">
                    <?php include $root_dir."/includes/sluzby.php" ?>
                </div>
                <h2 class="nove_produkty">Nové produkty</h2>
                    <br>
                <div class="row">
                    <?php include $root_dir."/includes/nove-produkty.php" ?>
                </div>
            </div>
        </div>
    </div>
    <?php include $root_dir."/includes/footer.php" ?>
</body>
</html>