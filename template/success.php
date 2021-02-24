<?php 


$details = isset($_COOKIE["details"]) ? $_COOKIE["details"] : "[]";
$details = json_decode($details);


foreach($details as $d){
    echo $d->price;
}
?>