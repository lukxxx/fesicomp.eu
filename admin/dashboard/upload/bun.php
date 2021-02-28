<?php require_once "../../includes/head-sub.php";
require_once "../../config.php";
require_once "./main.php";
?>

<div class="container" id="agenerovanie">
	<div class="atitle bgcolor3 txtcolor1" onclick="window.location.href='?a'"><span class="glyphicon glyphicon-home"></span> Administrácia - Nahrávanie z veľkoskladu</div>

	<h4><span class="glyphicon glyphicon-asterisk"></span> Spúšťanie nahrávania z veľkoskladu</h4>
	
	<div class="row">
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
			<div class="agen2 divcentrow" onclick="sendget('atc-kategorie-vyrobcovia.php')" >
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Kategórie Značky</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-produkty.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Produkty (cele)</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<a onclick="XMLHttpRequest.send(atc-produkty-update.php)"<div class="agen2 divcentrow" onclick="">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Produkty (update)</b></div></a>
  	</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-ceny.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Ceny</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-dostupnost.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Dostupnosť</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-popisy.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Popisy</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-odkazy.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Odkazy Obrazky</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-suvisiaci.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Suvisiaci</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-parametre.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Parametre</b></div>
  		</div>
  	</div>
  	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 agen1">
  		<div class="agen2 divcentrow" onclick="sendget('atc-stiahnutie-img.php')">
  			<div class="col-xs-3"><span class="glyphicon glyphicon-download-alt" style="font-size:30px;"></span></div>
    		<div class="col-xs-9">AT Computer<br><b>Sťahovanie OBR</b></div>
  		</div>
  	</div>
  </div>
</div>

<div class="container">
  
<div id="report"></div>

<h4><span class="glyphicon glyphicon-asterisk"></span> Záznamy nahrávania</h4>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Dátum</th>
        <th>Sklad/Typ</th>
        <th>Záznam</th>
        <th>Čas priebehu</th>
      </tr>
    </thead>
    
<?php

	$sql="SELECT `l_id`, `l_sklad`, `l_priebeh`, `l_cas`, `l_datum` FROM `log` WHERE `l_typ`='1' ORDER BY `l_id` DESC LIMIT 20"; 
  $res=mysqli_query($link, $sql);  
	while (list($lid,$lsklad,$lpriebeh,$lcas,$ldatum)=mysqli_fetch_row($res)) {
		
	$pos = strpos($lpriebeh,'ERR');
	if ($pos === false) $str="txtcolor3"; else $str="txtcolor2";	
?>   
    
    <tbody>
      <tr>
        <td><?=ToPHPDate($ldatum);?></td>
        <td><?=$lsklad;?></td>
        <td class="<?=$str;?>"><?=$lpriebeh;?></td>
        <td><?=$lcas;?> s</td>
      </tr>
     
<?php } ?>
     
    </tbody>
  </table>
</div>