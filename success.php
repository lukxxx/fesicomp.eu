<?php
require_once "config.php";

$cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
$cart = json_decode($cart);

$total = 0;

foreach ($cart as $c) {
        $total += $c->product->p_cena * $c->quantity;
        $id_produktu = $c->productCode;
        $quantity = $c->quantity;
}

$sth = $pdo->prepare("SELECT * FROM faktury ORDER BY id DESC LIMIT 1");
        if($sth->execute()){
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                $id_zakazky = $row['id'];
                $id_zakazky = $id_zakazky + 1;        
        } else {
                echo "pohubene";
        }
        

if (isset($_POST['pay'])) {
        if (!isset($_POST['doprava'])) {
                $doprava_err = "Zadajte spôsob dopravy!";
                header("location: template/final.php");
        } else if ($_POST['doprava'] == "posta") {
                $doprava = "Doprava poštou";
        } else {
                $doprava = "Osobný odber na predajni";
        }
        if (!isset($_POST['platba'])) {
                $platba_err = "Zadajte spôsob platby!";
                header("location: template/final.php");
        } else if ($_POST['platba'] == "trustpay") {
                $platba = "trustpay";
        } else if ($_POST['platba'] == "kurier-dobierka") {
                $platba = "Na dobierku pri prevzatí od kuriéra";
        } else if ($_POST['platba'] == "dobierka") {
                $platba = "Na dobierku pri prezvatí tovaru na predajni";
        } else {
                $platba = "Hotovosťou";
        }

        if (!isset($_POST['podmienky'])) {
                header("location: template/final.php");
        } else {
                $term = true;
        }
        
        $sth = $pdo->prepare("INSERT INTO predane_produkty (id_produktu,id_faktury,cena_ks,pocet_ks) VALUES (?,?,?,?)");
        if($sth->execute(array($id_produktu, $id_zakazky, $total, $quantity))){
        
        }
                
        unset($cart);
        unset($_COOKIE['cart']);
        setcookie('cart', null, time() -3600, "/");
}

?>
<form method="post" action="template/checkout.php" name="pass-data" style="display: none;">
        <input type="hidden" name="id_zakazky" value="<?php echo $id_zakazky ?>">
        <input type="submit">
</form>
<script>
       window.onload = function(){
        document.forms['pass-data'].submit();
}
</script>



<?php
/*picpic */
    $sent_message = false;
    if(isset($_POST['pay'])){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

            
           
            $messageSubject = "Nova sprava od zakaznika";

            $to = "matej.roch4@gmail.com";
            $body = "";

            $body .= "Dakujeme za vasu objednavku";
            mail($to,$messageSubject,$body);
            $sent_message = true;
        }
}

?>