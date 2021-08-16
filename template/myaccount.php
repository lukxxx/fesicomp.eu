<?php
if ($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs") {
    include $_SERVER['DOCUMENT_ROOT'] . "/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php";
}
if (isset($_COOKIE['details'])) {
    unset($details);
    unset($_COOKIE['details']);
    setcookie('details', null, time() - 3600, "/");
}
if (isset($_GET['photo'])) {
    $photo = $_GET['photo'];
}
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}
if (isset($_GET['idtoken'])) {
    $idtoken = $_GET['idtoken'];
}
if (isset($_GET['fullname'])) {
    $full_name = $_GET['fullname'];
    $parts = explode(" ", $full_name);
    $one = $parts[0];
    $two = $parts[1];
    $full_n = $one . " " . $two;
}

$given_name = "";
$em = "";
if (isset($_COOKIE['user'])) {
    $given_name = $_COOKIE['user'];
}
if (isset($_COOKIE['user-mail'])) {
    $em = $_COOKIE['user-mail'];
}
if (isset($_COOKIE['user-login'])) {
    $email_from_login = $_COOKIE['user-login'];
}

$empty = "Nie je definované";

if (isset($photo) && isset($email) && isset($idtoken) && isset($full_name)) {
    $sto = $pdo->prepare("SELECT * FROM g_users WHERE email = ?");
    $sto->execute(array($email));
    if ($sto->rowCount() == 1) {
        $row = $sto->fetch(PDO::FETCH_ASSOC);
        $id_zakaznika = $row['id'];
        $emailik = $row['email'];
        $first_name = $row['meno'];
        $second_name = $row['priezvisko'];
        $image = $row['img_url'];
        $telefon = $row['telefon'];
        $ulica = $row['ulica'];
        $mesto = $row['mesto'];
        $psc = $row['psc'];
    } else {
        $telefon = "";
        $ulica = "";
        $mesto = "";
        $psc = "";

        $sql = "INSERT INTO g_users (id_token,email,meno,priezvisko,img_url,telefon,ulica,mesto,psc) VALUES (?,?,?,?,?,?,?,?,?)";
        $pdo->prepare($sql)->execute([$idtoken, $email, $one, $two, $photo, $telefon, $ulica, $mesto, $psc]);
    }
} else if (isset($_COOKIE['user-login'])) {
    $sto = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $sto->execute(array($email_from_login));
    if ($sto->rowCount() == 1) {
        $row = $sto->fetch(PDO::FETCH_ASSOC);
        $id_zakaznika = $row['id'];
        $emailik = $row['email'];
        $telefon_login = $row['telefon'];
        $meno_l = $row['meno'];
        $surname_l = $row['priezvisko'];
        $street_l = $row['ulica'];
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
    }
} else {
    $sth = $pdo->prepare("SELECT * FROM g_users WHERE email = ?");
    $sth->execute(array($em));
    if ($sth->rowCount() == 1) {
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $id_zakaznika = $row['id'];
        $emailik_g = $row['email'];
        $first = $row['meno'];
        $second = $row['priezvisko'];
        $image = $row['img_url'];
        $telefon = $row['telefon'];
        $ulica = $row['ulica'];
        $mesto = $row['mesto'];
        $psc = $row['psc'];
        $full_n = $first . " " . $second;
    }
}

if (isset($_COOKIE['user'])) {
    if (isset($_POST['logout'])) {
        unset($_COOKIE['user']);
        unset($_COOKIE['user-mail']);
        unset($_COOKIE['G_AUTHUSER_H']);
        unset($_COOKIE['G_ENABLED_IDPS']);
        setcookie('user', null, -1, "/");
        setcookie('user-mail', null, -1, "/");
        setcookie('G_AUTHUSER_H', null, -1, "/");
        setcookie('G_ENABLED_IDPS', null, -1, "/");
        header("Location: $root_url");
    }
} else if (isset($_COOKIE['user-login'])) {
    if (isset($_POST['logout'])) {
        unset($_COOKIE['user-login']);
        unset($_COOKIE['user-login-name']);
        setcookie('user-login', null, -1, "/");
        setcookie('user-login-name', null, -1, "/");
        header("Location: $root_url");
    }
}
include $root_dir . "/includes/header.php";
?>
<script>
    function signOut() {
        gapi.auth2.getAuthInstance().signOut().then(() => console.log('ODHLASENY'));
    }

    function onLoad() {
        gapi.load('auth2', function() {
            gapi.auth2.init();
        })
    }
</script>
<div class="container" style="padding-top: 20px">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="account-heading d-flex justify-content-center">
                <h2 style="padding-right: 30px;">Môj účet</h2>

                <form method="post">
                    <button class="btn btn-dark" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Odhlásiť</button>
                </form>

            </div>
            <span>Pri upravovaní údajov je potrebné stránku načítať znova</span>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <img src="<?php if (isset($photo)) {
                            echo $photo;
                        } else if (isset($image)) {
                            echo $image;
                        } else {
                            echo "$root_url/assets/images/default-user.png";
                        } ?>" width="200" height="200" style="border-radius: 50%;">
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
            <h4 style="color: grey;">Základné informácie: </h4>
            <?php
            ?>
            <span style="padding-top: 20px">Meno: <strong><?php if (!empty($meno_l)) {
                                                                echo $meno_l;
                                                            } else if (!empty($first)) {
                                                                echo $first;
                                                            } else if (!empty($one)) {
                                                                echo $one;
                                                            } else {
                                                                echo $empty;
                                                            } ?></strong> <button onclick="unhideName()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button> </span><br><br>
            <div style="display: none;" id="edit-name" class="edit-form">
                <?php
               
                ?>
                <form method="post" id="update_name_form">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="name-edit" name="name-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" id="update_name" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideName()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
                <script>
                    $(document).on("click", "#update_name", function(e) {
                        
                        $.ajax({
                            url: "user-info-update.php",
                            type: "POST",
                            cache: false,
                            data: {
                                name: $('#name-edit').val(),
                            },
                            success: function(dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    alert('Data updated successfully !');
                                }
                            }
                        });
                        
                    });
                </script>
            </div>
            <span style="padding-top: 20px">Priezvisko: <strong><?php if (!empty($surname_l)) {
                                                                    echo $surname_l;
                                                                } else if (!empty($second)) {
                                                                    echo $second;
                                                                } else if (!empty($two)) {
                                                                    echo $two;
                                                                } else {
                                                                    echo $empty;
                                                                } ?></strong> <button onclick="unhideSurname()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button> </span><br><br>
            <div style="display: none;" id="edit-surname" class="edit-form">
                <?php
                if (isset($_POST['surname-edit'])) {
                    if (isset($_COOKIE['user'])) {
                        $edit_name = $_POST['surname-edit'];
                        $stmt = $pdo->prepare("UPDATE g_users SET priezvisko=?");
                        $stmt->execute(array($edit_name));
                    } else if (isset($_COOKIE['user-login'])) {
                        $edit_name = $_POST['surname-edit'];
                        $stmt = $pdo->prepare("UPDATE users SET priezvisko=? WHERE email=?");
                        $stmt->execute(array($edit_name, $email_from_login));
                    }
                }
                ?>
                <form method="post" action="#">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="surname-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideSurname()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
            </div>
            <span style="padding-top: 20px">Email: <strong><?php if (!empty($email)) {
                                                                echo $email;
                                                            } else if (!empty($emailik)) {
                                                                echo $emailik;
                                                            } else if (!empty($emailik_g)) {
                                                                echo $emailik_g;
                                                            } else {
                                                                echo $email_from_login;
                                                            } ?></strong><?php if (isset($_COOKIE['user'])) {
                                                                            } else { ?><button onclick="unhideMail()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button><?php } ?></span><br><br>
            <?php if (isset($_COOKIE['user'])) {
            } else { ?>
                <div style="display: none;" id="edit-email" class="edit-form">
                    <?php
                    if (isset($_POST['email-edit'])) {
                        if (isset($_COOKIE['user'])) {
                            $edit_name = $_POST['email-edit'];
                            $stmt = $pdo->prepare("UPDATE g_users SET email=?");
                            $stmt->execute(array($edit_name));
                        } else if (isset($_COOKIE['user-login'])) {
                            $edit_name = $_POST['email-edit'];
                            $stmt = $pdo->prepare("UPDATE users SET email=? WHERE email=?");
                            $stmt->execute(array($edit_name, $email_from_login));
                        }
                    }
                    ?>
                    <form method="post" action="#">
                        <div class="form-group d-flex">
                            <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="surname-edit">&nbsp;
                            <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                            <a onclick="hideMail()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                        </div>
                    </form>
                </div>
            <?php } ?>

            <span style="padding-top: 20px">Telefón: <strong><?php if (!empty($telefon)) {
                                                                    echo $telefon;
                                                                } else if (!empty($telefon_login)) {
                                                                    echo $telefon_login;
                                                                } else {
                                                                    echo $empty;
                                                                } ?></strong><button onclick="unhideTel()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span>
            <div style="display: none;" id="edit-tel" class="edit-form">
                <?php
                if (isset($_POST['tel-edit'])) {
                    if (isset($_COOKIE['user'])) {
                        $edit_name = $_POST['tel-edit'];
                        $stmt = $pdo->prepare("UPDATE g_users SET telefon=?");
                        $stmt->execute(array($edit_name));
                    } else if (isset($_COOKIE['user-login'])) {
                        $edit_name = $_POST['tel-edit'];
                        $stmt = $pdo->prepare("UPDATE users SET telefon=? WHERE email=?");
                        $stmt->execute(array($edit_name, $email_from_login));
                    }
                }
                ?>
                <form method="post" action="#">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="tel-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideTel()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4">
            <h4 style="color: grey;">Dodacie údaje: </h4>
            <span style="padding-top: 20px">Mesto: <strong><?php if (empty($mesto)) {
                                                                echo $empty;
                                                            } else {
                                                                echo $mesto;
                                                            } ?></strong><button onclick="unhideCity()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
            <div style="display: none;" id="edit-city" class="edit-form">
                <?php
                if (isset($_POST['city-edit'])) {
                    if (isset($_COOKIE['user'])) {
                        $edit_name = $_POST['city-edit'];
                        $stmt = $pdo->prepare("UPDATE g_users SET mesto=?");
                        $stmt->execute(array($edit_name));
                    } else if (isset($_COOKIE['user-login'])) {
                        $edit_name = $_POST['city-edit'];
                        $stmt = $pdo->prepare("UPDATE users SET mesto=? WHERE email=?");
                        $stmt->execute(array($edit_name, $email_from_login));
                    }
                }
                ?>
                <form method="post" action="#">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="city-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideCity()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
            </div>
            <span style="padding-top: 20px">PSČ: <strong><?php if (empty($psc)) {
                                                                echo $empty;
                                                            } else {
                                                                echo $psc;
                                                            } ?></strong><button onclick="unhidePsc()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
            <div style="display: none;" id="edit-psc" class="edit-form">
                <?php
                if (isset($_POST['psc-edit'])) {
                    if (isset($_COOKIE['user'])) {
                        $edit_name = $_POST['psc-edit'];
                        $stmt = $pdo->prepare("UPDATE g_users SET psc=?");
                        $stmt->execute(array($edit_name));
                    } else if (isset($_COOKIE['user-login'])) {
                        $edit_name = $_POST['psc-edit'];
                        $stmt = $pdo->prepare("UPDATE users SET psc=? WHERE email=?");
                        $stmt->execute(array($edit_name, $email_from_login));
                    }
                }
                ?>
                <form method="post" action="#">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="city-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                        <a onclick="hidePsc()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
            </div>
            <span style="padding-top: 20px">Ulica: <strong><?php if (!empty($ulica)) {
                                                                echo $ulica;
                                                            } else if (!empty($street_l)) {
                                                                echo $street_l;
                                                            } else {
                                                                echo $empty;
                                                            }  ?></strong><button onclick="unhideStreet()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span>
            <div style="display: none;" id="edit-street" class="edit-form">
                <?php
                if (isset($_POST['street-edit'])) {
                    if (isset($_COOKIE['user'])) {
                        $edit_name = $_POST['street-edit'];
                        $stmt = $pdo->prepare("UPDATE g_users SET ulica=?");
                        $stmt->execute(array($edit_name));
                    } else if (isset($_COOKIE['user-login'])) {
                        $edit_name = $_POST['street-edit'];
                        $stmt = $pdo->prepare("UPDATE users SET ulica=? WHERE email=?");
                        $stmt->execute(array($edit_name, $email_from_login));
                    }
                }
                ?>
                <form method="post" action="#">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" name="street-edit">&nbsp;
                        <input type="submit" style="border-radius: 10px;" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideStreet()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Vaše objednávky:</h3>
            <hr>
            <?php
            $sth = $pdo->prepare("SELECT * FROM faktury WHERE id_zakaznika LIKE ?");
            $sth->execute(array($id_zakaznika));
            $number_of_rows = $sth->rowCount();
            if ($number_of_rows > 0) {
            ?>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Č. objednávky</th>
                            <th scope="col">Dátum objednávky</th>
                            <th scope="col">Cena (€)</th>
                            <th scope="col">Faktúra</th>
                            <th scope="col">Stav</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                            $id_objednavky = $row['id'];
                            $meno = $row['meno'];
                            $priezvisko = $row['priezvisko'];
                            $email = $row['email'];
                            $telefon = $row['telefon'];
                            $zaplatene = $row['zaplatene'];
                            $vybavene = $row['vybavene'];
                            $zlava = $row['zlava'];
                            $datum = $row['datum'];
                            $sto = $pdo->prepare("SELECT * FROM predane_produkty WHERE id_faktury LIKE ?");
                            $sto->execute(array($id_objednavky));
                            while ($bow = $sto->fetch(PDO::FETCH_ASSOC)) {
                                $faktura = "invoice.php?fid=$id_objednavky";
                                $cena = $bow['cena_ks'];
                                $produkt = $bow['cena_ks'];
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $id_objednavky ?></th>
                                    <td><?php echo $datum ?></td>
                                    <td><?php echo $cena ?>€</td>
                                    <td><?php echo "<a href='$faktura'>Faktúra IN-$id_objednavky</a>"; ?></td>
                                    <td><?php echo "Čakajúca" ?></td>
                                </tr>
                    <?php }
                        }
                    } else {
                        echo "<div style='text-align: center; padding-top: 40px; padding-bottom: 40px;'>";
                        echo "<span>Bohužiaľ u nás ešte nemáte žiadne objednávky :(</span>";
                        echo "</div>";
                    } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/JavaScript">
    function unhideName(){
        document.getElementById('edit-name').style.display='block';
    }
    function hideName(){
        document.getElementById('edit-name').style.display='none';
    }
    function unhideSurname(){
        document.getElementById('edit-surname').style.display='block';
    }
    function hideSurname(){
        document.getElementById('edit-surname').style.display='none';
    }
    function unhideMail(){
        document.getElementById('edit-email').style.display='block';
    }
    function hideMail(){
        document.getElementById('edit-email').style.display='none';
    }
    function unhideTel(){
        document.getElementById('edit-tel').style.display='block';
    }
    function hideTel(){
        document.getElementById('edit-tel').style.display='none';
    }
    function unhideCity(){
        document.getElementById('edit-city').style.display='block';
    }
    function hideCity(){
        document.getElementById('edit-city').style.display='none';
    }
    function unhidePsc(){
        document.getElementById('edit-psc').style.display='block';
    }
    function hidePsc(){
        document.getElementById('edit-psc').style.display='none';
    }
    function unhideStreet(){
        document.getElementById('edit-street').style.display='block';
    }
    function hideStreet(){
        document.getElementById('edit-street').style.display='none';
    }
                        </script>
<?php include $root_dir . "/includes/footer.php"; ?>
<script src="https://apis.google.com/js/platform.js"></script>