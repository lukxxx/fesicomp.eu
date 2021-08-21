<?php
$pdo = $pdo = new PDO("mysql:host=db.dw003.nameserver.sk;port=3306;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");

if (isset($_COOKIE['user'])) {
    if (isset($_POST['id'])) {
        $edit_name = $_POST['id'];
        if (isset($_COOKIE['user-mail'])) {
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET meno=? WHERE email=?");
        if ($stmt->execute(array($edit_name, $email))) {
            $data = stripslashes($_POST['id']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['surname'])) {
        $edit_surname = $_POST['surname'];
        if (isset($_COOKIE['user-mail'])) {
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET priezvisko=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))) {
            $data = stripslashes($_POST['surname']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['mail'])) {
        $edit_surname = $_POST['mail'];
        if (isset($_COOKIE['user-mail'])) {
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET email=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))) {
            $data = stripslashes($_POST['mail']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['tel'])) {
        $edit_surname = $_POST['tel'];
        if (isset($_COOKIE['user-mail'])) {
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET telefon=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))) {
            $data = stripslashes($_POST['tel']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['city'])) {
        $edit_surname = $_POST['city'];
        if (isset($_COOKIE['user-mail'])) {
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET mesto=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))) {
            $data = stripslashes($_POST['city']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['psc'])) {
        $edit_surname = $_POST['psc'];
        if(isset($_COOKIE['user-mail'])){
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET psc=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))){
            $data = stripslashes($_POST['psc']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['street'])) {
        $edit_surname = $_POST['street'];
        if(isset($_COOKIE['user-mail'])){
            $email = $_COOKIE['user-mail'];
        }
        $stmt = $pdo->prepare("UPDATE g_users SET ulica=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email))) {
            $data = stripslashes($_POST['street']);
            echo $data;
        } else {
            echo "ZLE";
        }
    }
} else if (isset($_COOKIE['user-login'])) {
    if (isset($_POST['id'])) {
        $edit_name = $_POST['id'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET meno=? WHERE email=?");
        if ($stmt->execute(array($edit_name, $email_from_login))) {
            $data = stripslashes($_POST['id']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['surname'])) {
        $edit_surname = $_POST['surname'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET priezvisko=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['surname']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['mail'])) {
        $edit_surname = $_POST['mail'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET email=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['mail']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['tel'])) {
        $edit_surname = $_POST['tel'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET telefon=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['tel']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['city'])) {
        $edit_surname = $_POST['city'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET mesto=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['city']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['psc'])) {
        $edit_surname = $_POST['psc'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET psc=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['psc']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['street'])) {
        $edit_surname = $_POST['street'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET ulica=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['street']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_name'])) {
        $edit_surname = $_POST['com_name'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET nazov_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_name']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_street'])) {
        $edit_surname = $_POST['com_street'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET ulica_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_street']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_city'])) {
        $edit_surname = $_POST['com_city'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET mesto_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_city']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_psc'])) {
        $edit_surname = $_POST['com_psc'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET psc_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_psc']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_ico'])) {
        $edit_surname = $_POST['com_ico'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET ico_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_ico']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_dic'])) {
        $edit_surname = $_POST['com_dic'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET dic_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_dic']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['com_icd'])) {
        $edit_surname = $_POST['com_icd'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET ic_dph_firmy=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['com_icd']);
            echo $data;
        } else {
            echo "ZLE";
        }
    }
}
