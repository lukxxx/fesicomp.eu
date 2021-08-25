<?php 
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}
if(!isset($_COOKIE['details'])){
    header("Location: $root_url/");
} else if(!isset($_COOKIE['details2'])){
    header("Location: $root_url/");
} else if(!isset($_COOKIE['cart'])){
    header("Location: $root_url/");
}
$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);

foreach ($details as $d) {
    $telefon_non_login = $d->number;
    $name = $d->name;
    $priezvisko_non = $d->surname;
    $email_non_login = $d->email;
    $quantity = $d->quantity;
}

        
        $datum = date('d.m.y');
        $id_zakazky = $_POST['id_zakazky'];
        if (isset($_COOKIE['user'])) {
            $zakaznik = $_COOKIE['user-mail'];
            $sth = $pdo->prepare("SELECT * FROM g_users WHERE email LIKE ?");
            $sth->execute(array($zakaznik));
            while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                $id_zakaznika = $row['id'];
                $meno = $row['meno'];
                $email = $row['email'];
                $mesto = $row['mesto'];
                $priezvisko = $row['priezvisko'];
                $telefon = $row['telefon'];    
            }
            
            $zlava = 0;
            $sth = $pdo->prepare("INSERT INTO faktury (id,id_zakaznika,meno,priezvisko,email,telefon,zaplatene,vybavene,zlava,datum) VALUES (?,?,?,?,?,?,?,?,?,?)");
            if ($sth->execute(array($id_zakazky,$id_zakaznika, $meno, $priezvisko, $email, $telefon, 0, 0, $zlava,$datum))) {
                
            } else {
                    
            }
        } else if (isset($_COOKIE['user-login'])) {
            $zakaznik = $_COOKIE['user-login'];
            $sth = $pdo->prepare("SELECT email, meno, priezvisko, mesto, telefon, id FROM users WHERE email LIKE ?");
            $sth->execute(array($zakaznik));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $id_zakaznika = $row['id'];
            $meno = $row['meno'];
            $email = $row['email'];
            $mesto = $row['mesto'];
            $priezvisko = $row['priezvisko'];
            $telefon = $row['telefon'];
            $zlava = 0;
            $sth = $pdo->prepare("INSERT INTO faktury (id,id_zakaznika,meno,priezvisko,email,telefon,zaplatene,vybavene,zlava,datum) VALUES (?,?,?,?,?,?,?,?,?,?)");
            if ($sth->execute(array($id_zakazky,$id_zakaznika, $meno, $priezvisko, $email, $telefon, 0, 0, $zlava, $datum))) {
                
            } else {
                    
            }
        } else {
            $id_zakaznika = 0;
                $zlava = 0;
                $sth = $pdo->prepare("INSERT INTO faktury (id,id_zakaznika,meno,priezvisko,email,telefon,zaplatene,vybavene,zlava,datum) VALUES (?,?,?,?,?,?,?,?,?,?)");
                if ($sth->execute(array($id_zakazky,$id_zakaznika, $name, $priezvisko_non, $email_non_login, $telefon_non_login, 0, 0, $zlava,$datum))) {
        
                } else {
                        
                }
        }
        
    
include $root_url."/includes/header.php";
?>



<script>
    $(".fa-arrow-right").click(function(){
    $(this).toggleClass("down");
    });
        
    $('.fa-bars').click(function() {
    $(this).toggleClass("fa-times");
    });
</script>

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
                <h5 style="text-align: center;">Vašu objednávku číslo <b><?php echo $id_zakazky ?></b> sme zaznamenali a začíname na nej pracovať!</h5><br><br>
                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-1">
                        <i class="fas fa-envelope fa-3x"></i>
                    </div>
                    <div class="col-sm-12 col-md-10 col-lg-11">
                        <h4 style="text-align: left; padding-bottom: 60px"> Na Váš email práve v tejto chvíli mieri potvrdzujúci e-mail v ktorom nájdete detaily svojej objednávky.</h4>
                    </div>
                </div>
                <?php 
                if(isset($_COOKIE['user']) || isset($_COOKIE['user-login'])){ ?>
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-11">
                        <h4 style="text-align: right; padding-bottom: 60px"> Taktiež na správe vášho účtu si môžete zobraziť detaily o vašej novej objednávke</h4>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-1">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                </div>
                <?php } ?>
                
                <div class="text-center" style="margin-bottom: 20%;">
                        <a  href="../"><button class="btn btn-dark">Späť domov!</button></a>
                        <?php if(isset($_COOKIE['user']) || isset($_COOKIE['user-login'])){ ?>
                        <a  href="<?php echo $root_url ?>/moj-ucet"><button class="btn btn-dark">Môj účet</button></a>
                        <?php } ?>
                </div>
                    
                </div>
                
                  
            </div>
        </div>
    </div>
    
     
    </div>
<?php } ?>
    <?php include $root_dir."/includes/footer.php"?>
</body>
</html>
    