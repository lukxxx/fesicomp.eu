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

    <div class="container" style="padding-top: 20px; height: 100vh;">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="text-center" style="font-weight: bold;">ĽUTUJEME, STRÁNKA KTORÚ HĽADÁTE NIE JE DOSTUPNÁ</h2>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center" style="margin: 50px 0 50px 0;">
                <img src="https://compsnv.sk/assets/images/FESI_404_01.svg" width="250" height="auto">
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center" style="margin: 50px 0 50px 0;">
                <a href="https://compsnv.sk"><button class="buy-btn" style="border-radius: 10px; position: relative; left: 0;"><i class="fa fa-home" aria-hidden="true"></i> Späť na hlavnú stránku</button></a>
            </div>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/footer.php")?>
    <?php include($_SERVER['DOCUMENT_ROOT']."/includes/scripts.php")?>
</body>
</html>