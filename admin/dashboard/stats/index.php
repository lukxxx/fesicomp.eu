<?php 
require_once "../../includes/head-sub.php";
require_once "../../config.php";
$date = date('d.m.y');
$nadpis = "Štatistiky";
if(isset($_COOKIE['admin'])){
    if(isset($_POST['logout'])){
        header("Location: gdbay.php");
    }
}
if(!isset($_COOKIE['admin'])){
    header("Location: ../");
}


if(isset($_COOKIE['admin'])){ ?>
<div class="container-fluid">
    <div class="row">
        <div style="background-color: #303030; width: 100%; height: 1080px" class="col-sm-2 col-md-2 col-lg-2">
            <?php include "../../includes/side-panel.php"; ?>
        </div>
        
        <div  style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
            <?php include "../../includes/header-main.php"; ?>               
            <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
            <h6>Pre editovanie kliknite na výrobcu</h6>
            <div class="row" style="padding: 40px" >
                <div class="col-sm-12 col-md-12 col-lg-12" style="border-right: 1px solid black;">
                <iframe style="width: 100%;border:none; height: 100%;" id="setting" name="setting" src="https://analytics.google.com/analytics/web/#/p153293282/reports/defaulthome" ></iframe>
                       
                </div>                   
            </div>
        </div>
    </div>


<?php } ?>