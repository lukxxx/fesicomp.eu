<?php 
include "../includes/head-template.php";
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
}

$platba = "";
$doprava = "";
$term = "";
$term_err = "";
$platba_err = "";
$doprava_err = "";

$show = "display: block;";
$hide = "display: none;";

$submit_btn = "<button style='all: unset; cursor: pointer; color: black; text-align: right;' name='bimbambum' type='submit'>Pokračovať k doprave <i class='fas fa-arrow-right'></i></button>";
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
            $term_err = "Pre pokračovanie musíte súhlasiť s obchodnými podmienkami";
            header("location: ./final.php");
        } else {
            $term = true;
        }
        array_push($details, array(
                    "platby" => $platba,
                    "dopravy" => $doprava
                ));    
    } ?>
     
        <iframe id="TrustPayFrame" src="https://playground.trustpay.eu/mapi5/Card/PayPopup?accountId=2107962460"></iframe>
            <a href="#" class="show-popup">Pay via TrustPay</a>
   <?php
    function getSetUpPaymentUrl($total)
    {
        $baseUrl = "https://playground.trustpay.eu/mapi5/wire/paypopup";
        $accountId = 2107962460;
        $amount = $total;
        $currency = "EUR";
        $reference = "123456789";
        $notificationUrl = "https://compsnv.sk/template/notification.php";
        $paymentType = 0;
    
        $secretKey = "Y97Nt6wq4TaTKQduXbq6iMOKfaVINmcr";
        $sigData = sprintf("%d/%s/%s/%s/%d", $accountId, number_format($amount, 2, '.', ''), $currency, $reference, $paymentType);
        $signature = GetSignature($secretKey, $sigData);
    
        $url = sprintf(
            "%s?AccountId=%d&Amount=%s&Currency=%s&Reference=%s&NotificationUrl=%s&PaymentType=%d&Signature=%s",
            $baseUrl, $accountId, number_format($amount, 2, '.', ''), $currency,
            urlencode($reference), urlencode($notificationUrl), $paymentType, $signature);
        return $url;
    }
?>
    <?php include "../includes/header-template.php" ?>
    