<?php 
include "../includes/head-template.php";
$options = [
    'cost' => 12,
];
$name_err = "";
$surname_err = "";
$email_err = "";
$tel_err = "";
$city_err = "";
$street_err = "";
$psc_err = "";
$submit_btn = "<button style='all: unset; cursor: pointer; color: black; text-align: right;' name='bimbambum' type='submit'>Pokračovať k doprave <i class='fas fa-arrow-right'></i></button>";
if(isset($_POST['bimbambum'])){

    if(empty(trim($_POST["name"]))){
        $name_err = "Zadajte meno";
    } else {
        $name = trim($_POST["name"]);
    }
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Zadajte priezvisko";
    } else {
        $surname = trim($_POST["surname"]);
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Zadajte priezvisko";
    } else {
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST['telefon']))){
        $tel_err = "Zadajte číslo!";
    } else {
        $tel = $_POST['telefon'];
    }
    if(empty(trim($_POST["city"]))){
        $city_err = "Zadajte názov mesta";
    } else {
        $city = trim($_POST["city"]);
    }
    if(empty(trim($_POST["street"]))){
        $street_err = "Zadajte názov ulice";
    } else {
        $street = trim($_POST["street"]);
    }
    if(empty(trim($_POST["psc"]))){
        $psc_err = "Zadajte poštové smerovacie číslo";
    } else {
        $psc = trim($_POST["psc"]);
    }
    $note = $_POST['note'];
    
    if(isset($_POST['type']) == "1"){
        $company_name = $_POST['company-name'];
        $company_street = $_POST['company-street'];
        $company_city = $_POST['company-city'];
        $company_psc = $_POST['company-psc'];
        $company_ico = $_POST['company-ico'];
        $company_dic = $_POST['company-dic'];
        $company_ic_dph = $_POST['company-ic-dph'];    
    } else {
        $company_name = "";
        $company_street = "";
        $company_city = "";
        $company_psc = "";
        $company_ico = "";
        $company_dic = "";
        $company_ic_dph = "";
    }
    if(isset($_POST['newsletter'])){
        if(isset($email)){
            $newsletter_email = $email;    
        } else {
            $newsletter_email = "";
        }
        $newsletter_msg = "Boli ste úspešne prihlasený na odber newslettere na email: $newsletter_email";
        $newsletter = true;
    } else {
        $newsletter_msg = "Na odber newslettera ste sa neprihlásili";
        $newsletter = false;
    }
    if(isset($_POST['remember'])){
        $remember_email = $email;
        $remember_msg = "Váš účet bol vytvorený na emailovú adresu: $newsletter_email";
        $remember = true;
    } else {
        $remember_msg = "Na odber newslettera ste sa neprihlásili";
        $remember = false;
    }
    if($name_err != "" || $surname_err != "" || $email_err != "" || $tel_err != "" || $city_err != "" || $street_err != "" || $psc_err != ""){

    } else {
        header("location:final.php");
    }

    
        
    
      

}
?>
    <?php include "../includes/header-template.php" ?>

<?php if(!isset($_COOKIE['user'])){ ?>
    <div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <a style="color: black;" href="cart.php"><i class="fas fa-arrow-left"></i> Späť do košíka</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold;">Dodacie údaje</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            <form method="post" action="">
            <?php echo $submit_btn ?>
        </div>
    </div>
    <hr>
    <br>
                <div class="login-form">
                    <div class="container" style="padding: 5% 25% 0% 25%">
                        
                            <div class="form-group">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name" type="text" placeholder="Meno (povinné)">';
                                }
                                if($surname_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon" id="phonik" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city" type="text" placeholder="Mesto (povinné)">';
                                }
                                if($street_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street" type="text" placeholder="Ulica (povinné)">';
                                }
                                if($psc_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc" type="number" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                            </div>               
                            <script>
                                $(document).ready(function()
                                {
                                    $("#phonik").attr('maxlength','10');
                                });

                            </script>   
                        <script>
                                $(document).ready(function()
                                {
                                    $("#psc").attr('maxlength','5');
                                });

                            </script>
                            <br>
                        <div class="form-group d-flex">
                            <label><input type="checkbox" name="type" id="com" onclick="unHide();" value="1"> Chcem doplniť firemné údaje</label>
                        </div>
                        <script type="text/JavaScript">
                                function unHide(){
                                    if($('#com').is(":checked"))   
                                        $("#company").show();
                                    else
                                        $("#company").hide();
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
                        <label><input type="checkbox" checked name="newsletter" id="news" onclick="newsletter();" value="1"> Chcem odoberať novinky na email</label><br>
                        <label><input type="checkbox" name="remember" style="padding-bottom: 20px;" id="data" onclick="store_data();" value="1"> Zapamätať údaje do budúcna</label>
                        <script type="text/JavaScript">
                                function store_data(){
                                    if($('#data').is(":checked"))   
                                        $("#store_alert").show();
                                    else
                                        $("#store_alert").hide();
                                }
                        </script>
                        <div id="store_alert" style="display:none; color: white; text-align: center; padding-bottom: 20px;">
                            <div class="alert bg-dark" role="alert">
                                Na váš email Vám zašleme prihlasovacie údaje do Vášho nového účtu!
                            </div>
                        </div>
                            <?php echo $submit_btn; ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } 
if(isset($_COOKIE['user'])){ ?>
    <div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <a style="color: black;" href="cart.php"><i class="fas fa-arrow-left"></i> Späť do košíka</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold;">Dodacie údaje</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            <form method="post" action="">
            <?php echo $submit_btn ?>
        </div>
    </div>
    <hr>
    <br>
                <div class="login-form">
                    <div class="container" style="padding: 5% 25% 0% 25%">
                        
                            <div class="form-group" id="saved_data">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name" type="text" placeholder="Meno (povinné)">';
                                }
                                if($surname_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon" id="phonik" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city" type="text" placeholder="Mesto (povinné)">';
                                }
                                if($street_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street" type="text" placeholder="Ulica (povinné)">';
                                }
                                if($psc_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc" type="number" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                            </div>     
                            <div class="form-group" id="new_data" style="display: none;">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name" type="text" placeholder="Meno (povinné)">';
                                }
                                if($surname_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon" id="phonik" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city" type="text" placeholder="Mesto (povinné)">';
                                }
                                if($street_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street" type="text" placeholder="Ulica (povinné)">';
                                }
                                if($psc_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc" type="number" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                            </div>               
                            <script>
                                $(document).ready(function()
                                {
                                    $("#phonik").attr('maxlength','10');
                                });

                            </script>   
                        <script>
                                $(document).ready(function()
                                {
                                    $("#psc").attr('maxlength','5');
                                });

                            </script>
                            <br>
                        <div class="form-group d-flex">
                            <label><input type="checkbox" name="type" id="com" onclick="unHide();" value="1"> Chcem doplniť firemné údaje</label>
                        </div>
                        <script type="text/JavaScript">
                                function unHide(){
                                    if($('#com').is(":checked"))   
                                        $("#company").show();
                                    else
                                        $("#company").hide();
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
                        <label><input type="checkbox" name="remember" style="padding-bottom: 20px;" id="data" onclick="store_data();" value="1"> Chcem doručiť zásielku na inú adresu</label>
                        <script type="text/JavaScript">
                                function store_data(){
                                    if($('#data').is(":checked"))   
                                        $("#new_data").show();
                                        $("#saved_data").hide();
                                    else
                                        $("#saved_data").show();
                                        $("#new_data").hide();
                                }
                        </script>
                        <div id="store_alert" style="display:none; color: white; text-align: center; padding-bottom: 20px;">
                            <div class="alert bg-dark" role="alert">
                                Na váš email Vám zašleme prihlasovacie údaje do Vášho nového účtu!
                            </div>
                        </div>
                            <?php echo $submit_btn; ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>
    <?php include "../includes/footer.php"?>
    <?php include "../includes/scripts.php"?>
</body>
</html>