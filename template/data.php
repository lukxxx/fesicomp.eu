<?php 
include "../includes/head-template.php";
$options = [
    'cost' => 12,
];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$total = 0;

foreach ($cart as $c)
{
    $total += $c->product->p_cena * $c->quantity;
    $product_name = $c->product->p_nazov;
    $quantity = $c->quantity;
    $product_code = $c->product->p_kod_sklad;
}

$name_err = "";
$surname_err = "";
$email_err = "";
$tel_err = "";
$city_err = "";
$street_err = "";
$psc_err = "";

$name_new_err = "";
$surname_new_err = "";
$email_new_err = "";
$tel_new_err = "";
$city_new_err = "";
$street_new_err = "";
$psc_new_err = "";
$note_new = "";

$show = "display: block;";
$hide = "display: none;";

$submit_btn = "<button style='all: unset; cursor: pointer; color: black; text-align: right;' name='bimbambum' type='submit'>Pokračovať k doprave <i class='fas fa-arrow-right'></i></button>";
if(isset($_POST['bimbambum'])){
    if(isset($_POST['new_data'])){
        if(empty(trim($_POST["name_new"]))){
            $name_new_err = "Zadajte meno";
        } else {
            $name_new = $_POST["name_new"];
        }
        if(empty(trim($_POST["surname_new"]))){
            $surname_new_err = "Zadajte priezvisko";
        } else {
            $sur = trim($_POST["surname_new"]);
            $surname_new = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $sur);
        }
        if(empty(trim($_POST["email_new"]))){
            $email_new_err = "Zadajte priezvisko";
        } else {
            $email_new = trim($_POST["email_new"]);
        }
        if(empty(trim($_POST['telefon_new']))){
            $tel_new_err = "Zadajte číslo!";
        } else {
            $tel_new = $_POST['telefon_new'];
        }
        if(empty(trim($_POST["city_new"]))){
            $city_new_err = "Zadajte názov mesta";
        } else {
            $city_new = trim($_POST["city_new"]);
        }
        if(empty(trim($_POST["street_new"]))){
            $street_new_err = "Zadajte názov ulice";
        } else {
            $street_new = trim($_POST["street_new"]);
        }
        if(empty(trim($_POST["psc_new"]))){
            $psc_new_err = "Zadajte poštové smerovacie číslo";
        } else {
            $psc_new = trim($_POST["psc_new"]);
        }
        $note_new = $_POST['note_new'];
        
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
        if($name_new_err != "" || $surname_new_err != "" || $email_new_err != "" || $tel_new_err != "" || $city_new_err != "" || $street_new_err != "" || $psc_new_err != ""){
           
        } else {
            header("location:final.php");
        }
    } else {
        if(empty(trim($_POST["name"]))){
            $name_err = "Zadajte meno";
        } else {
            $name = $_POST["name"];
        }
        if(empty(trim($_POST["surname"]))){
            $surname_err = "Zadajte priezvisko";
        } else {
            $sur = trim($_POST["surname"]);
            $surname = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $sur);
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
            $details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
            $details = json_decode($details);



            array_push($details, array(
                "productCode" => $product_code,
                "quantity" => $quantity,
                "product" => $product_name,
                "number" => $tel,
                "price" => $total,
                "name" => $name,
                "surname" => $surname,
                "email" => $email
            ));

            setcookie("details", json_encode($details));
            header("location:final.php");
        }
    }
    

    
        
    
      

}
?>
    <?php include "../includes/header-template.php" ?>

<?php if(!isset($_COOKIE['user']) && !isset($_COOKIE['user-login'])){ ?>
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
            <?php echo $submit_btn; echo $total; ?>
        </div>
    </div>
    <hr>
    <br>
                <div class="login-form">
                    <div class="container" style="padding: 5% 25% 0% 25%">
                        
                            <div class="form-group">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="name" type="text" placeholder="Meno (povinné)">';
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
if(isset($_COOKIE['user'])){ 
    
    $email = $_COOKIE['user-mail'];
    $pdo = new PDO("mysql:host=mariadb103.websupport.sk;port=3313;dbname=compsnv_sk2", "compsnv", "Kajauhroba#2021");
    $sto = $pdo->prepare("SELECT * FROM g_users WHERE email = ?");
    $sto->execute(array($email));
    if($sto->rowCount() == 1){
        $row = $sto->fetch(PDO::FETCH_ASSOC);
        $emailik = $row['email'];
        $first_name = $row['first_name'];
        $second_name = $row['second_name'];
        $image = $row['img_url'];
        $telefon = $row['telefon'];
        $ulica = $row['ulica'];
        $mesto = $row['mesto'];
        $psc = $row['psc'];
        $full_n = $first_name." ".$second_name;
    } 
    ?>
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
    <div class="row text-center">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <span style="text-align: center;"><b>Prihlásený ako:</b> <a style="color: black;" href="myaccount.php"><?php echo $full_n; ?></a></span> 
        </div>
    </div>
                <div class="login-form">
                    
                    <div class="container" style="padding: 5% 25% 0% 25%">
  
                            <div class="form-group" id="saved_data" style="<?php if(isset($_POST['new_data'])){ echo $hide;} else { echo $show; } ?>">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name" type="text" value="'.$first_name.'" placeholder="Meno (povinné)">';
                                }
                                if($surname_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname" type="text" value="'.$second_name.'" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email" type="email" value="'.$email.'" placeholder="E-mail (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon" id="phonik" value="'.$telefon.'" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city" type="text" value="'.$mesto.'" placeholder="Mesto (povinné)">';
                                }
                                if($street_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street" type="text" value="'.$ulica.'" placeholder="Ulica (povinné)">';
                                }
                                if($psc_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc" type="number" value="'.$psc.'" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                            </div>   
                            <script>
                            $(document).ready(function(){
                                    checkInput();
                                            })

                                            $('input, select').on('input change',checkInput)

                                            function checkInput(){
                                            $('input, select').each(function(){
                                                if($(this).val() != ''){
                                                $(this).addClass('has-value-input')}else{  
                                                    $(this).removeClass('has-value-input')}
                                            })
                                            }

                            </script>  
                            <div class="form-group" id="new_data" style="<?php if(isset($_POST['new_data'])){ echo $show;} else { echo $hide; } ?>">
                                <?php if($name_new_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name_new" type="text" placeholder="Meno (povinné)">';
                                }
                                if($surname_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname_new" type="text" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email_new" type="email" placeholder="E-mail (povinné)">';
                                }
                                if($tel_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon_new" id="phonik" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city_new" type="text" placeholder="Mesto (povinné)">';
                                }
                                if($street_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street_new" type="text" placeholder="Ulica (povinné)">';
                                }
                                if($psc_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc_new" type="number" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note_new" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                                <br>
                                <span><b>Prajete si tieto nové údaje uložiť?</b></span><br>
                                <div class="form-group d-flex">
                                    <label style="padding: 2%"><input checked type="radio" value="1" name="save-new"> Áno</label>
                                    <label style="padding: 2%"><input type="radio" value="0" name="save-new"> Nie</label>
                                </div>
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
                        <label><input type="checkbox" name="new_data" style="padding-bottom: 20px;" <?php if(isset($_POST['new_data'])) echo "checked='checked'"; ?> id="data" onclick="store_data();" value="<?php echo $_POST['new_data'] ?? ''; ?>"> Chcem zmeniť údaje</label>
                        <script type="text/JavaScript">
                                $("#data").change(function () {
                                    if ($(this).is(':checked')) {
                                        $("#saved_data").hide();
                                        $("#new_data").show();
                                    } else {
                                        $("#saved_data").show();
                                        $("#new_data").hide(); 
                                    }
                                });
                                
                        </script>
                        <br>
                        
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center" style="text-align: center; padding: 20px;">
                        <span ><?php echo $submit_btn; ?></span> 
                    </form>
                    </div>
                </div>
            </div>  
        </div>    
    </div>
<?php }  
if(isset($_COOKIE['user-login'])){ 
    $email = $_COOKIE['user-login'];
    $pdo = new PDO("mysql:host=mariadb103.websupport.sk;port=3313;dbname=compsnv_sk2", "compsnv", "Kajauhroba#2021");
    $sto = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $sto->execute(array($email));
    if($sto->rowCount() == 1){
        $row = $sto->fetch(PDO::FETCH_ASSOC);
        $emailik = $row['email'];
        $first_name = $row['meno'];
        $second_name = $row['priezvisko'];
        $telefon = $row['telefon'];
        $ulica = $row['ulica'];
        $mesto = $row['mesto'];
        $psc = $row['psc'];
        $osoba = $row['osoba'];
        $nazov_firmy = $row['nazov_firmy'];
        $ulica_firmy = $row['ulica_firmy'];
        $mesto_firmy = $row['mesto_firmy'];
        $psc_firmy = $row['psc_firmy'];
        $ico_firmy = $row['ico_firmy'];
        $dic_firmy = $row['dic_firmy'];
        $ic_dph_firmy = $row['ic_dph_firmy'];
        $full_n = $first_name." ".$second_name;
    } 
    ?>
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
    <div class="row text-center">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <span style="text-align: center;"><b>Prihlásený ako:</b> <a style="color: black;" href="myaccount.php"><?php echo $full_n; ?></a></span> 
        </div>
    </div>
                <div class="login-form">
                    
                    <div class="container" style="padding: 5% 25% 0% 25%">
  
                            <div class="form-group" id="saved_data" style="<?php if(isset($_POST['new_data'])){ echo $hide;} else { echo $show; } ?>">
                                <?php if($name_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="name" type="text" value="'.$first_name.'" placeholder="Meno (povinné)">';
                                }
                                if($surname_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="surname" type="text" value="'.$second_name.'" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="email" type="email" value="'.$email.'" placeholder="E-mail (povinné)">';
                                }
                                if($tel_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon" class="input-form" id="phonik" value="'.$telefon.'" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="city" type="text" value="'.$mesto.'" placeholder="Mesto (povinné)">';
                                }
                                if($street_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="street" type="text" value="'.$ulica.'" placeholder="Ulica (povinné)">';
                                }
                                if($psc_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" class="input-form" name="psc" type="number" value="'.$psc.'" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                            </div>   
                            <script>
                            $(document).ready(function(){
                                    checkInput();
                                            })

                                            $('input, select').on('input change',checkInput)

                                            function checkInput(){
                                            $('input, select').each(function(){
                                                if($(this).val() != ''){
                                                    
                                                    $(this).addClass('has-value-input')
                                                }else{  
                                                    $(this).removeClass('has-value-input')
                                                    
                                                }
                                                    
                                            })
                                            }

                            </script>  
                            <div class="form-group" id="new_data" style="<?php if(isset($_POST['new_data'])){ echo $show;} else { echo $hide; } ?>">
                                <?php if($name_new_err != ""){
                                    echo '<input autofocus style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="text" type="text" placeholder="Meno (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="name_new" type="text" placeholder="Meno (povinné)">';
                                }
                                if($surname_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="surname" type="text" placeholder="Priezvisko (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="surname_new" type="text" placeholder="Priezvisko (povinné)">';
                                }
                                if($email_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" name="email" type="email" placeholder="E-mail (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="email_new" type="email" placeholder="E-mail (povinné)">';
                                }
                                if($tel_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control" id="phonik" name="telefon" type="tel" placeholder="Telefónne číslo (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="telefon_new" id="phonik" type="tel" placeholder="Telefónne číslo (povinné)">';
                                }
                                if($city_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="city" type="text" placeholder="Mesto (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="city_new" type="text" placeholder="Mesto (povinné)">';
                                }
                                if($street_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="street" type="text" placeholder="Ulica (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="street_new" type="text" placeholder="Ulica (povinné)">';
                                }
                                if($psc_new_err != ""){
                                    echo '<input style="box-shadow: 0 0 8px red; outline: 0;" class="form-control"  name="psc" type="number" placeholder="PSČ (povinné)">';
                                } else {
                                    echo '<input class="form-control" name="psc_new" type="number" placeholder="PSČ (povinné)">';
                                }
                                echo '<textarea  style="resize: none;" rows="4" class="form-control" name="note_new" type="text" placeholder="Poznámka..."></textarea>';
                                ?>
                                <br>
                                <span><b>Prajete si tieto nové údaje uložiť?</b></span><br>
                                <div class="form-group d-flex">
                                    <label style="padding: 2%"><input checked type="radio" value="1" name="save-new"> Áno</label>
                                    <label style="padding: 2%"><input type="radio" value="0" name="save-new"> Nie</label>
                                </div>
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
                            <label><input type="checkbox" <?php if($osoba == "Firma"){ echo "checked='checked' disabled";}?> name="type" id="com" onclick="unHide();" value="1"> Chcem doplniť firemné údaje</label>
                        </div>
                        <script type="text/JavaScript">
                                function unHide(){
                                    if($('#com').is(":checked"))   
                                        $("#company").show();
                                    else
                                        $("#company").hide();
                                }
                        </script>
                        <div class="company" id="company" style="<?php if($osoba == "Fyzic"){ echo $hide; } else { echo $show; } ?>">
                            <div class="heading-login">
                                <h2 style="text-align: center">Firemné údaje</h2>
                            </div>
                            <input class="form-control form-inputik input-form" value="<?php echo $nazov_firmy ?>" name="company-name" type="text" placeholder="Názov firmy...">
                            <input class="form-control form-inputik input-form" value="<?php echo $ulica_firmy ?>" name="company-street" type="text" placeholder="Ulica...">
                            <div class="form-group d-flex">
                                <input style="margin-right: 2px"  value="<?php echo $mesto_firmy ?>" class="form-control form-inputik input-form" name="company-city" type="text" placeholder="Mesto...">
                                <input style="margin-left: 2px"  value="<?php echo $psc_firmy ?>" class="form-control form-inputik input-form" name="company-psc" type="text" placeholder="PSČ...">
                            </div>  
                            <div class="form-group d-flex">
                                <input style="margin-right: 2px"  value="<?php echo $ico_firmy ?>" class="form-control form-inputik input-form" name="company-ico" type="text" placeholder="IČO...">
                                <input style="margin-left: 2px"  value="<?php echo $dic_firmy ?>" class="form-control form-inputik input-form" name="company-dic" type="text" placeholder="DIČ...">
                            </div>
                            <input class="form-control form-inputik input-form" value="<?php echo $ic_dph_firmy ?>" name="company-ic-dph" type="text" placeholder="IČ DPH...">
                        </div>
                        <label><input type="checkbox" name="new_data" style="padding-bottom: 20px;" <?php if(isset($_POST['new_data'])) echo "checked='checked'"; ?> id="data" onclick="store_data();" value="<?php echo $_POST['new_data'] ?? ''; ?>"> Chcem zmeniť údaje</label>
                        <script type="text/JavaScript">
                                $("#data").change(function () {
                                    if ($(this).is(':checked')) {
                                        $("#saved_data").hide();
                                        $("#new_data").show();
                                    } else {
                                        $("#saved_data").show();
                                        $("#new_data").hide(); 
                                    }
                                });
                                
                        </script>
                        <br>
                        
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center" style="text-align: center; padding: 20px;">
                        <span ><?php echo $submit_btn; ?></span> 
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