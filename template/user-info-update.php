<?php 
 if (isset($_POST['name-edit'])) {
    if (isset($_COOKIE['user'])) {
        $edit_name = $_POST['name-edit'];
        $stmt = $pdo->prepare("UPDATE g_users SET meno=?");
        $stmt->execute(array($edit_name));
        echo json_encode(array("statusCode"=>200));
    } else if (isset($_COOKIE['user-login'])) {
        $edit_name = $_POST['name-edit'];
        $stmt = $pdo->prepare("UPDATE users SET meno=? WHERE email=?");
        $stmt->execute(array($edit_name, $email_from_login));
        echo json_encode(array("statusCode"=>200));
    }
}
?>