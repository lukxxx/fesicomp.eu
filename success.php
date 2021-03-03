<?php
if(isset($_POST['pay'])){
        unset($cart);
        unset($_COOKIE['cart']);
        setcookie("cart", json_encode($cart), "/");
        setcookie('cart', null, "/");
        header("Location: template/checkout.php");
}
?>