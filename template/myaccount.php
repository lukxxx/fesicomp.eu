<?php

use GuzzleHttp\Promise\Is;

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
        $id_zakaznika = $row['id'] . "G";
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
        $id_zakaznika = $row['id'] . "L";
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
        $id_zakaznika = $row['id'] . "G";
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
<div class="container" style="padding: 20px 25px;">
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
            <span style="padding-top: 20px">Meno: <strong id="user_name"><?php if (!empty($meno_l)) {
                                                                                echo $meno_l;
                                                                            } else if (!empty($first)) {
                                                                                echo $first;
                                                                            } else if (!empty($one)) {
                                                                                echo $one;
                                                                            } else {
                                                                                echo $empty;
                                                                            } ?></strong></span>
            <?php if (isset($_COOKIE['user'])) {
                echo "<br><br>";
            } else { ?>
                <button onclick="unhideName()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button> </span><br><br>
                <div style="display: none;" id="edit-name" class="edit-form">
                    <?php

                    ?>
                    <form method="post" id="update_name_form">
                        <div class="form-group d-flex">
                            <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="name-edit" name="name-edit">&nbsp;
                            <input type="hidden" id="name-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                            echo $email_from_login;
                                                                                                        } ?>">
                            <input type="submit" style="border-radius: 10px;" id="update_name" class="btn btn-dark" value="Upraviť">
                            <a onclick="hideName()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $('#update_name_form').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: root_url + "/updateuser",
                                    data: {
                                        id: $('#name-edit').val(),
                                        email_login: $('#name-email-login').val(),
                                    },
                                    cache: false,

                                    success: function(result) {
                                        var returnedvalue = result;
                                        $('#user_name').empty();
                                        $('#user_name').html(returnedvalue);
                                        $('#edit-name').hide();
                                        $('#name-edit').empty();
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            <?php } ?>
            <span style="padding-top: 20px">Priezvisko: <strong id="user_surname"><?php if (!empty($surname_l)) {
                                                                                        echo $surname_l;
                                                                                    } else if (!empty($second)) {
                                                                                        echo $second;
                                                                                    } else if (!empty($two)) {
                                                                                        echo $two;
                                                                                    } else {
                                                                                        echo $empty;
                                                                                    } ?></strong></span>
            <?php if (isset($_COOKIE['user'])) {
                echo "<br><br>";
            } else { ?>
                <button onclick="unhideSurname()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button><br><br>
                <div style="display: none;" id="edit-surname">
                    <?php

                    ?>
                    <form method="post" id="update_surname_form">
                        <div class="form-group d-flex">
                            <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="surname-edit" name="surname-edit">&nbsp;
                            <input type="hidden" id="surname-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                echo $email_from_login;
                                                                                                            } ?>">
                            <input type="submit" style="border-radius: 10px;" id="update_surname" class="btn btn-dark" value="Upraviť">
                            <a onclick="hideSurame()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $('#update_surname_form').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: root_url + "/updateuser",
                                    data: {
                                        surname: $('#surname-edit').val(),
                                        email_login: $('#surname-email-login').val(),
                                    },
                                    cache: false,

                                    success: function(result) {
                                        var returnedvalue = result;
                                        $('#user_surname').empty();
                                        $('#user_surname').html(returnedvalue);
                                        $('#edit-surname').hide();
                                        $('#surname-edit').empty();
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            <?php } ?>
            <span style="padding-top: 20px">Email: <strong id="user_mail"><?php if (!empty($email)) {
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
                <div style="display: none;" id="edit-mail">
                    <?php

                    ?>
                    <form method="post" id="update_mail_form">
                        <div class="form-group d-flex">
                            <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="mail-edit" name="mail-edit">&nbsp;
                            <input type="hidden" id="mail-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                            echo $email_from_login;
                                                                                                        } ?>">
                            <input type="submit" style="border-radius: 10px;" id="update_mail" class="btn btn-dark" value="Upraviť">
                            <a onclick="hideMail()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $('#update_mail_form').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: root_url + "/updateuser",
                                    data: {
                                        mail: $('#mail-edit').val(),
                                        email_login: $('#mail-email-login').val(),
                                    },
                                    cache: false,

                                    success: function(result) {
                                        var returnedvalue = result;
                                        $('#user_mail').empty();
                                        $('#user_mail').html(returnedvalue);
                                        $('#edit-mail').hide();
                                        $('#mail-edit').empty();
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            <?php } ?>

            <span style="padding-top: 20px">Telefón: <strong><?php if (!empty($telefon)) {
                                                                    echo $telefon;
                                                                } else if (!empty($telefon_login)) {
                                                                    echo $telefon_login;
                                                                } else {
                                                                    echo $empty;
                                                                } ?></strong><button onclick="unhideTel()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span>
            <div style="display: none;" id="edit-tel">
                <?php

                ?>
                <form method="post" id="update_tel_form">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="tel-edit" name="tel-edit">&nbsp;
                        <input type="hidden" id="tel-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                        echo $email_from_login;
                                                                                                    } ?>">
                        <input type="submit" style="border-radius: 10px;" id="update_tel" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideTel()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#update_tel_form').submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: root_url + "/updateuser",
                                data: {
                                    tel: $('#tel-edit').val(),
                                    email_login: $('#tel-email-login').val(),
                                },
                                cache: false,

                                success: function(result) {
                                    var returnedvalue = result;
                                    $('#user_tel').empty();
                                    $('#user_tel').html(returnedvalue);
                                    $('#edit-tel').hide();
                                    $('#tel-edit').empty();
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4">
            <h4 style="color: grey;">Dodacie údaje: </h4>
            <span style="padding-top: 20px">Mesto: <strong id="user_city"><?php if (empty($mesto)) {
                                                                                echo $empty;
                                                                            } else {
                                                                                echo $mesto;
                                                                            } ?></strong><button onclick="unhideCity()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
            <div style="display: none;" id="edit-city">
                <?php

                ?>
                <form method="post" id="update_city_form">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="city-edit" name="city-edit">&nbsp;
                        <input type="hidden" id="city-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                        echo $email_from_login;
                                                                                                    } ?>">
                        <input type="submit" style="border-radius: 10px;" id="update_city" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideCity()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#update_city_form').submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: root_url + "/updateuser",
                                data: {
                                    city: $('#city-edit').val(),
                                    email_login: $('#city-email-login').val(),
                                },
                                cache: false,

                                success: function(result) {
                                    var returnedvalue = result;
                                    $('#user_city').empty();
                                    $('#user_city').html(returnedvalue);
                                    $('#edit-city').hide();
                                    $('#city-edit').empty();
                                }
                            });
                        });
                    });
                </script>
            </div>
            <span style="padding-top: 20px">PSČ: <strong id="user_psc"><?php if (empty($psc)) {
                                                                            echo $empty;
                                                                        } else {
                                                                            echo $psc;
                                                                        } ?></strong><button onclick="unhidePsc()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
            <div style="display: none;" id="edit-psc">
                <?php

                ?>
                <form method="post" id="update_psc_form">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="psc-edit" name="psc-edit">&nbsp;
                        <input type="hidden" id="psc-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                        echo $email_from_login;
                                                                                                    } ?>">
                        <input type="submit" style="border-radius: 10px;" id="update_psc" class="btn btn-dark" value="Upraviť">
                        <a onclick="hidePsc()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#update_psc_form').submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: root_url + "/updateuser",
                                data: {
                                    psc: $('#psc-edit').val(),
                                    email_login: $('#psc-email-login').val(),
                                },
                                cache: false,

                                success: function(result) {
                                    var returnedvalue = result;
                                    $('#user_psc').empty();
                                    $('#user_psc').html(returnedvalue);
                                    $('#edit-psc').hide();
                                    $('#psc-edit').empty();
                                }
                            });
                        });
                    });
                </script>
            </div>
            <span style="padding-top: 20px">Ulica: <strong id="user_street"><?php if (!empty($ulica)) {
                                                                                echo $ulica;
                                                                            } else if (!empty($street_l)) {
                                                                                echo $street_l;
                                                                            } else {
                                                                                echo $empty;
                                                                            }  ?></strong><button onclick="unhideStreet()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span>
            <div style="display: none;" id="edit-street">
                <?php

                ?>
                <form method="post" id="update_street_form">
                    <div class="form-group d-flex">
                        <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="street-edit" name="street-edit">&nbsp;
                        <input type="hidden" id="street-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                        echo $email_from_login;
                                                                                                    } ?>">
                        <input type="submit" style="border-radius: 10px;" id="update_street" class="btn btn-dark" value="Upraviť">
                        <a onclick="hideStreet()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#update_street_form').submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: root_url + "/updateuser",
                                data: {
                                    street: $('#street-edit').val(),
                                    email_login: $('#street-email-login').val(),
                                },
                                cache: false,

                                success: function(result) {
                                    var returnedvalue = result;
                                    $('#user_street').empty();
                                    $('#user_street').html(returnedvalue);
                                    $('#edit-street').hide();
                                    $('#street-edit').empty();
                                }
                            });
                        });
                    });
                </script>
            </div>

        </div>
    </div>

    <?php
    if (isset($_COOKIE['user-login'])) {
        if ($osoba == "Fyzická osoba") {
        } else { ?>
            <div class="row" style="margin-top: 2%;">

                <div class="col-sm-12 col-md-3 col-lg-3"></div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <h3>Firemné údaje</h3>
                    <hr style="width: 107%;">
                    <span style="padding-top: 20px">Názov firmy: <strong id="com_name"><?php if (isset($nazov_firmy)) {
                                                                                            echo $nazov_firmy;
                                                                                        } else {
                                                                                            echo $empty;
                                                                                        } ?></strong><button onclick="unhideComName()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-name">
                        <?php

                        ?>
                        <form method="post" id="update_com_name_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-name-edit" name="com-name-edit">&nbsp;
                                <input type="hidden" id="com-name-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_name" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComName()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_name_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_name: $('#com-name-edit').val(),
                                            email_login: $('#com-name-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_name').empty();
                                            $('#com_name').html(returnedvalue);
                                            $('#edit-com-name').hide();
                                            $('#com-name-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <span style="padding-top: 20px">Ulica: <strong id="com_street"><?php if (isset($ulica_firmy)) {
                                                                                        echo $ulica_firmy;
                                                                                    } else {
                                                                                        echo $empty;
                                                                                    } ?></strong><button onclick="unhideComStreet()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-street">
                        <?php

                        ?>
                        <form method="post" id="update_com_street_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-street-edit" name="com-street-edit">&nbsp;
                                <input type="hidden" id="com-street-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_street" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComStreet()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_street_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_street: $('#com-street-edit').val(),
                                            email_login: $('#com-street-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_street').empty();
                                            $('#com_street').html(returnedvalue);
                                            $('#edit-com-street').hide();
                                            $('#com-street-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <span style="padding-top: 20px">Mesto: <strong id="com_city"><?php if (!empty($mesto_firmy)) {
                                                                                        echo $mesto_firmy;
                                                                                    } else {
                                                                                        echo $empty;
                                                                                    }  ?></strong><button onclick="unhideComCity()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-city">
                        <?php

                        ?>
                        <form method="post" id="update_com_city_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-city-edit" name="com-city-edit">&nbsp;
                                <input type="hidden" id="com-city-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_city" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComCity()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_city_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_city: $('#com-city-edit').val(),
                                            email_login: $('#com-city-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_city').empty();
                                            $('#com_city').html(returnedvalue);
                                            $('#edit-com-city').hide();
                                            $('#com-city-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <span style="padding-top: 20px">PSČ: <strong id="com_psc"><?php if (isset($psc_firmy)) {
                                                                                    echo $psc_firmy;
                                                                                } else {
                                                                                    echo $empty;
                                                                                } ?></strong><button onclick="unhideComPsc()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-psc">
                        <?php

                        ?>
                        <form method="post" id="update_com_psc_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-psc-edit" name="com-psc-edit">&nbsp;
                                <input type="hidden" id="com-psc-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_psc" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComPsc()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_psc_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_psc: $('#com-psc-edit').val(),
                                            email_login: $('#com-psc-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_psc').empty();
                                            $('#com_psc').html(returnedvalue);
                                            $('#edit-com-psc').hide();
                                            $('#com-psc-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <h3 style="color: white">.</h3>
                    <hr>
                    <span style="padding-top: 20px">IČO: <strong id="com_ico"><?php if (isset($ico_firmy)) {
                                                                                    echo $ico_firmy;
                                                                                } else {
                                                                                    echo $empty;
                                                                                } ?></strong><button onclick="unhideComIco()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-ico">
                        <?php

                        ?>
                        <form method="post" id="update_com_ico_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-ico-edit" name="com-ico-edit">&nbsp;
                                <input type="hidden" id="com-ico-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_ico" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComIco()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_ico_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_ico: $('#com-ico-edit').val(),
                                            email_login: $('#com-ico-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_ico').empty();
                                            $('#com_ico').html(returnedvalue);
                                            $('#edit-com-ico').hide();
                                            $('#com-ico-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <span style="padding-top: 20px">DIČ : <strong id="com_dic"><?php if (isset($dic_firmy)) {
                                                                                    echo $dic_firmy;
                                                                                } else {
                                                                                    echo $empty;
                                                                                } ?></strong><button onclick="unhideComDic()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span><br><br>
                    <div style="display: none;" id="edit-com-dic">
                        <?php

                        ?>
                        <form method="post" id="update_com_dic_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-dic-edit" name="com-dic-edit">&nbsp;
                                <input type="hidden" id="com-dic-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_dic" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComDic()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_dic_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_dic: $('#com-dic-edit').val(),
                                            email_login: $('#com-dic-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_dic').empty();
                                            $('#com_dic').html(returnedvalue);
                                            $('#edit-com-dic').hide();
                                            $('#com-dic-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <span style="padding-top: 20px">IČ DPH: <strong id="com_icd"><?php if (!empty($ic_dph_firmy)) {
                                                                                        echo $ic_dph_firmy;
                                                                                    } else {
                                                                                        echo $empty;
                                                                                    }  ?></strong><button onclick="unhideComIcd()" style="all: unset; cursor: pointer;">&nbsp; <i class="fas fa-edit"></i></button></span>
                    <div style="display: none;" id="edit-com-icd">
                        <?php

                        ?>
                        <form method="post" id="update_com_icd_form">
                            <div class="form-group d-flex">
                                <input style="width: 50%; border-radius: 10px;" type="text" class="form-control" id="com-icd-edit" name="com-icd-edit">&nbsp;
                                <input type="hidden" id="com-icd-email-login" name="email-from-login" value="<?php if (isset($email_from_login)) {
                                                                                                                    echo $email_from_login;
                                                                                                                } ?>">
                                <input type="submit" style="border-radius: 10px;" id="update_com_icd" class="btn btn-dark" value="Upraviť">
                                <a onclick="hideComIcd()" style="all: 
                            unset; cursor: pointer;">&nbsp; <i style="color: red;" class="fas fa-times-circle"></i></a>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#update_com_icd_form').submit(function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: "POST",
                                        url: root_url + "/updateuser",
                                        data: {
                                            com_icd: $('#com-icd-edit').val(),
                                            email_login: $('#com-icd-email-login').val(),
                                        },
                                        cache: false,

                                        success: function(result) {
                                            var returnedvalue = result;
                                            $('#com_icd').empty();
                                            $('#com_icd').html(returnedvalue);
                                            $('#edit-com-icd').hide();
                                            $('#com-icd-edit').empty();
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
    <?php }
    }
    ?>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Vaše objednávky:</h3>
            <hr>
            <?php
            $sth = $pdo->prepare("SELECT * FROM orders WHERE zakaznik LIKE ?");
            $sth->execute(array($id_zakaznika));
            $number_of_rows = $sth->rowCount();
            if ($number_of_rows > 0) {
            ?>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Č. objednávky</th>
                            <th scope="col">Dátum vytvorenia objednávky</th>
                            <th scope="col">Cena (€)</th>
                            <th scope="col">Stav</th>
                            <th scope="col">Produkty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $sth->fetch()) {
                            $id_objednavky = $row['id'];
                            $cena_objednavky = $row['cena_objednavky'];
                            $datum = $row['datum_vytvorenia'];
                            $stav = $row['stav_objednavky'];
                            $stmt = $pdo->prepare("SELECT * FROM sold WHERE id_faktury LIKE ?");
                            $stmt->execute([$id_objednavky]);
                            if($bow = $stmt->fetch())
                                $produkt = $bow['id_produktu'];
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $id_objednavky ?></th>
                                    <td><?php echo $datum ?></td>
                                    <td><?php echo $cena_objednavky ?>€</td>
                                    <td><?php echo $stav; ?></td>
                                    <td><?php echo $produkt ?></td>
                                </tr>
                    <?php }
                        
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
        document.getElementById('edit-mail').style.display='block';
    }
    function hideMail(){
        document.getElementById('edit-mail').style.display='none';
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
    function unhideComName(){
        document.getElementById('edit-com-name').style.display='block';
    }
    function hideComName(){
        document.getElementById('edit-com-name').style.display='none';
    }
    function unhideComStreet(){
        document.getElementById('edit-com-street').style.display='block';
    }
    function hideComStreet(){
        document.getElementById('edit-com-street').style.display='none';
    }
    function unhideComCity(){
        document.getElementById('edit-com-city').style.display='block';
    }
    function hideComCity(){
        document.getElementById('edit-com-city').style.display='none';
    }
    function unhideComPsc(){
        document.getElementById('edit-com-psc').style.display='block';
    }
    function hideComPsc(){
        document.getElementById('edit-com-psc').style.display='none';
    }
    function unhideComIco(){
        document.getElementById('edit-com-ico').style.display='block';
    }
    function hideComIco(){
        document.getElementById('edit-com-ico').style.display='none';
    }
    function unhideComDic(){
        document.getElementById('edit-com-dic').style.display='block';
    }
    function hideComDic(){
        document.getElementById('edit-com-dic').style.display='none';
    }
    function unhideComIcd(){
        document.getElementById('edit-com-icd').style.display='block';
    }
    function hideComIcd(){
        document.getElementById('edit-com-icd').style.display='none';
    }
                        </script>
<?php include $root_dir . "/includes/footer.php"; ?>
<script src="https://apis.google.com/js/platform.js"></script>