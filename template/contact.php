<!DOCTYPE html>
<html lang="sk">
<?php include_once "../includes/head-template.php";?>
<body>
<?php include (ROOT ."includes/header-template.php")?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">

            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h2>Kontakt</h2>
                <br>
                <div class="row">
                    <form action="#" method="post">
                        <input type="text" class="form-control" name="meno" placeholder="Meno" style="width: 400px; border-radius: 10px;">
                        <input type="text" class="form-control" name="email" placeholder="E-mail" style="border-radius: 10px;">
                        <input type="text" class="form-control" name="sprava" placeholder="Vaša správa" style="height: 300px; border-radius: 10px;">
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <?php include (ROOT. "includes/footer.php") ?>

</body>
</html>