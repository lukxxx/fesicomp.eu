<?php
$pdo = $pdo = new PDO("mysql:host=db.dw003.nameserver.sk;port=3306;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");

if (isset($_COOKIE['user'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("UPDATE g_users SET meno=?");
    if ($stmt->execute(array($id))) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
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
    } else if (isset($_POST['surname'])){
        $edit_surname = $_POST['surname'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET priezvisko=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['surname']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['mail'])){
        $edit_surname = $_POST['mail'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET email=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['mail']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['tel'])){
        $edit_surname = $_POST['tel'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET telefon=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['tel']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['city'])){
        $edit_surname = $_POST['city'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET mesto=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['city']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['psc'])){
        $edit_surname = $_POST['psc'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET psc=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['psc']);
            echo $data;
        } else {
            echo "ZLE";
        }
    } else if (isset($_POST['street'])){
        $edit_surname = $_POST['street'];
        $email_from_login = $_POST['email_login'];
        $stmt = $pdo->prepare("UPDATE users SET ulica=? WHERE email=?");
        if ($stmt->execute(array($edit_surname, $email_from_login))) {
            $data = stripslashes($_POST['street']);
            echo $data;
        } else {
            echo "ZLE";
        }
    }
}
