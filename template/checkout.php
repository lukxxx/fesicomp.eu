
<?php 
include "../includes/head-template.php";
require_once "../config.php";
$options = [
    'cost' => 12,
];

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

$total = 0;

foreach ($cart as $c)
{
    $total += $c->product->p_cena * $c->quantity;
    $id_produktu = $c->productCode;
}

echo $id_produktu;

$platba = "";
$doprava = "";
$term = "";
$term_err = "";
$platba_err = "";
$doprava_err = "";

if(isset($_POST['pay'])){
        if(!isset($_POST['doprava'])){
            $doprava_err = "Zadajte spôsob dopravy!";
            header("location: ./final.php");
        } else if($_POST['doprava'] == "posta"){
            $doprava = "Doprava poštou";
        } else {
            $doprava = "Osobný odber na predajni";
        }
        if(!isset($_POST['platba'])){
            $platba_err = "Zadajte spôsob platby!";
            header("location: ./final.php");
        } else if($_POST['platba'] == "trustpay"){
            $platba = "trustpay";
        } else if($_POST['platba'] == "kurier-dobierka"){
            $platba = "Na dobierku pri prevzatí od kuriéra";
        } else if($_POST['platba'] == "dobierka"){
            $platba = "Na dobierku pri prezvatí tovaru na predajni";
        } else {
            $platba = "Hotovosťou";
        }
        
        if(!isset($_POST['podmienky'])){
            header("location: ./final.php");
        } else {
            $term = true;
        }
        if(isset($_COOKIE['user']) || isset($_COOKIE['user-login'])){
            $sth = $pdo->prepare("SELECT email, meno, priezvisko, mesto FROM users UNION SELECT email, meno, priezvisko, mesto FROM g_users");
            $sth->execute();
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $id_zakaznika = $row['id'];
            $meno = $row['meno'];
            $email = $row['email'];
            $mesto = $row['mesto'];
            $priezvisko = $row['priezvisko'];    
            $zlava = 0;
            $sth = $pdo->prepare("INSERT INTO faktury (id_zakaznika,meno,priezvisko,email,telefon,zaplatene,vybavene,zlava) VALUES (?,?,?,?,?,?,?,?,?)");
            $sth->execute(array($id_zakaznika,$meno,$priezvisko,$email,$telefon,0,0,$zlava));
        } else {
            foreach ($details as $d)
            {
                $telefon_non_login = $d->number;
                $name = $d->name;
                $priezvisko_non = $d->surname;
                $email_non_login = $d->email;
                $quantity = $d->quantity;
                
            }
            $id_zakaznika = 0;
            $zlava = 0;
            $sth = $pdo->prepare("INSERT INTO faktury (id_zakaznika,meno,priezvisko,email,telefon,zaplatene,vybavene,zlava) VALUES (?,?,?,?,?,?,?,?,?)");
            $sth->execute(array($id_zakaznika,$name,$priezvisko_non,$email_non_login,$telefon_non_login,0,0,$zlava));
        }
        
        
        
        
        
              
                
    } 

include "../includes/header-template.php" ?>
<?php if(isset($_COOKIE['details'])){ ?>
    <div class="container" style="margin-top: 50px;">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-3 col-lg-3">
            
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center">
            <h2 style="font-weight: bold; text-transform: uppercase;">Ďakujeme za objednávku!</h2>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3" style="text-align: right;">
            
            
        </div>
    </div>
    <hr>
    <br>
    <div class="container" style="padding: 0% 25% 0% 25%">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h5>Vašu objednávku číslo <?php echo $order_number ?> sme zaznamenali a začíname na nej pracovať!</h5>

                <span style="text-decoration: underline; font-size: 19px;">Zvolený spôsob dopravy:</span><br>
                    <span><?php echo $doprava; ?></span>
                <span style="text-decoration: underline; font-size: 19px;">Zvolený spôsob platby:</span><br>
                    <span><?php echo $platba; ?></span>
                <span>Zakúpený tovar: </span>
                
                    <?php  echo $total;?>  
                  
            </div>
        </div>
    </div>
    
     
    </div>
<?php } ?>
    <?php include "../includes/footer.php"?>
    <?php include "../includes/scripts.php"?>
</body>
</html>
    