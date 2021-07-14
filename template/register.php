<?php 
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}
$options = [
    'cost' => 12,
];
$email_err = "";
$pass_err = "";
$pass2_err = "";
$tel_err = "";

if(isset($_POST['submit'])){

    if(empty(trim($_POST["email"]))){
        $email_err = "Zadajte email";
    } else if(($_POST["email"]) == $email_err){
        $email_err = "Účet s týmto emailom už existuje";
    } else {
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST['password']))){
        $pass_err = "Zadajte heslo!";
    } else {
        $pass_err = "";
        $pass1 = $_POST['password'];
        $pass1_hash = password_hash($pass1, PASSWORD_BCRYPT, $options);
    } 
    if(empty(trim($_POST['password-again']))){
        $pass2_err = "Zadajte heslo! Heslá sa nezhodujú!";
    } else if($_POST['password-again'] != $pass1){
        $pass2_err = "Heslá sa nezhodujú!";
    } else {
        $pass2 = $pass1;
    }
    if(empty(trim($_POST['tel']))){
        $tel_err = "Zadajte číslo!";
    } else {
        $tel = $_POST['tel'];
    }
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $psc = $_POST['psc'];
    $teldop = $_POST['tel-dop'];
    if($_POST['type'] == "1"){
        $osoba = "Fyzická osoba";
    } else {
        $osoba = "Firma";
    }
    $company_name = $_POST['company-name'];
        $company_street = $_POST['company-street'];
        $company_city = $_POST['company-city'];
        $company_psc = $_POST['company-psc'];
        $company_ico = $_POST['company-ico'];
        $company_dic = $_POST['company-dic'];
        $company_ic_dph = $_POST['company-ic-dph'];


    //if($email_err == "" || $pass_err == "" || $pass2_err == "" || $tel_err == ""){
        $sql = "INSERT INTO users (email, heslo, telefon, meno, priezvisko, ulica, mesto, psc, tel_dop, osoba, nazov_firmy, ulica_firmy, mesto_firmy, psc_firmy, 
        ico_firmy, dic_firmy, ic_dph_firmy) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $email, $pass1_hash, $tel, $name, $surname, $street, $city, $psc, $teldop, $osoba, $company_name, $company_street,
        $company_city, $company_psc, $company_ico, $company_dic, $company_ic_dph);
            if(mysqli_stmt_execute($stmt)){
                header("location: $root_url/prihlasenie");
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
    //}

}
?>
    <?php include $root_dir."/includes/header.php" ?>
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="heading-login">
                    <h2 style="text-align: center">REGISTRÁCIA</h2>
                </div>
                <div class="login-form">
                    <div class="container" style="padding: 5% 25% 0% 25%">
                        <form method="post" action="">
                            <div class="form-group">
                                <?php if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control form-inputik" name="email" type="email" placeholder="e-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control form-inputik" name="email" type="email" placeholder="e-mail (povinné)">';
                                }
                                if($pass_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control form-inputik" name="password" type="password" placeholder="heslo... (povinné)">';
                                } else {
                                    echo '<input class="form-control form-inputik" name="password" type="password" placeholder="heslo (povinné)">';
                                }
                                if($pass2_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control form-inputik" name="password-again" type="password" placeholder="opakovať heslo (povinné)">';
                                } else {
                                    echo '<input class="form-control form-inputik" name="password-again" type="password" placeholder="opakovať heslo (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control form-inputik" id="phonik" name="tel" type="text" placeholder="telefón (povinné)">';
                                } else {
                                    echo '<input class="form-control form-inputik" id="phonik" name="tel" type="text" placeholder="telefón (povinné)">';
                                }
                                ?>
                                
                                
                            </div>               
                            <script>
                                $(document).ready(function()
                                {
                                    $("#phonik").attr('maxlength','10');
                                });

                            </script>
                        <div class="heading-login">
                            <h2 style="text-align: center">Dodacie údaje</h2>
                        </div>
                        <div class="form-group d-flex">
                                <input style="margin-right: 2px" class="form-control form-inputik" name="name" type="text" placeholder="Meno...">
                                <input style="margin-left: 2px" class="form-control form-inputik" name="surname" type="text" placeholder="Priezvisko...">
                        </div>
                                <input class="form-control form-inputik" name="street" type="text" placeholder="Ulica...">
                        <div class="form-group d-flex">
                                <input style="margin-right: 2px" class="form-control form-inputik" name="city" type="text" placeholder="Mesto...">
                                <input style="margin-left: 2px" class="form-control form-inputik" id="psc" name="psc" type="text" placeholder="PSČ...">
                        </div>      
                        <script>
                                $(document).ready(function()
                                {
                                    $("#psc").attr('maxlength','5');
                                });

                            </script>
                            <input class="form-control form-inputik" name="tel-dop" type="text" placeholder="Kontakt pre dopravcu...">
                            <br>
                        <div class="form-group d-flex justify-content-center">
                            <label><input type="radio" checked name="type" onclick="hide();" value="1"> Som fyzická osoba</label>&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" name="type" value="2" onclick="unHide();"> Som firma/právnicka osoba</label>
                        </div>
                        <script type="text/JavaScript">
                                function unHide(){
                                    document.getElementById('company').style.display='block';
                                }
                                function hide(){
                                    document.getElementById('company').style.display='none';
                                }
                        </script>
                        <div class="company" id="company" style="display:none;">
                            <div class="heading-login">
                                <h2 style="text-align: center">Firemné údaje</h2>
                            </div>
                            <input class="form-control form-inputik" name="company-name" type="text" placeholder="Názov firmy...">
                            <input class="form-control form-inputik" name="company-street" type="text" placeholder="Ulica...">
                            <div class="form-group d-flex">
                                <input style="margin-right: 2px" class="form-control form-inputik" name="company-city" type="text" placeholder="Mesto...">
                                <input style="margin-left: 2px" class="form-control form-inputik" name="company-psc" type="text" placeholder="PSČ...">
                            </div>  
                            <div class="form-group d-flex">
                                <input style="margin-right: 2px" class="form-control form-inputik" name="company-ico" type="text" placeholder="IČO...">
                                <input style="margin-left: 2px" class="form-control form-inputik" name="company-dic" type="text" placeholder="DIČ...">
                            </div>
                            <input class="form-control form-inputik" name="company-ic-dph" type="text" placeholder="IČ DPH...">
                        </div>
                        
                            <div class="d-flex justify-content-center" style="padding: 5%">
                            <button type="submit" name="submit" class="btn btn-dark">Registrovať&nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $root_dir."/includes/footer.php"?>
</body>
</html>