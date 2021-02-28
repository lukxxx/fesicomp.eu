<?php 
require_once "../../includes/head-sub.php";
include "../../config.php";
//include "main.php";
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$date = date('d.m.y');
$nadpis = "Nahrávanie";

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
            <?php include "../../includes/side-panel.php"            ;?>
        </div>
        
        <div  style="background-color: #F3F3F3; width: 100%; height: 1080px; padding: 0 !important" class="col-sm-10 col-md-10 col-lg-10 scroll">
            <?php include "../../includes/header-main.php"; ?>               
            <hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
            <div class="row" style="padding: 40px" >
                
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Kategórie a značky</span>
                        </div>
                    </div>
                </div> 
				<div class="col-sm-3 col-md-4 col-lg-3" >
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;" >
						<div class="row">
							<button class="download-btn-produkty btn bnt-dark">download</button>
							<i  class="fas fa-download fa-2x"></i>
							<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Produkty</span>
                        </div>
                    </div>
                </div>               
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Produkty update</span>
                        </div>
                    </div>
                </div>  
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Ceny</span>
                        </div>
                    </div>
                </div>  
            </div> 
			<div class="row" style="padding: 40px" >
                
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Dostupnosť</span>
                        </div>
                    </div>
                </div> 
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Popisy</span>
                        </div>
                    </div>
                </div>               
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Odkazy a obrázky</span>
                        </div>
                    </div>
                </div>  
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Súvisiaci tovar</span>
                        </div>
                    </div>
                </div>  
            </div> 
			<div class="row" style="padding: 40px" >
                
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Parametre</span>
                        </div>
                    </div>
                </div> 
				<div class="col-sm-3 col-md-4 col-lg-3">
                    <div class="download-btn" style="border: 1px solid #E7E7E7; padding: 5% 0% 5% 10%; background-color: white; box-shadow: 5px 6px 16px -2px #616161; border-radius: 20px;">
						<div class="row">
						<i class="fas fa-download fa-2x"></i>
						<span style="font-size: 24px; font-weight: bold; padding-top: 1%">&nbsp; Sťahovanie OBR</span>
                        </div>
                    </div>
                </div>                
            </div> 

            
			<form action="atc-ceny.php">
                <input onclick="sendget('atc-dostupnost.php')" type="submit" value="Submit">
            </form>

			<hr style="border: 1px solid black; margin-top: -5px; width: 95%;">
			<h3>Záznamy nahrávania:</h3>	
			<div class="row" style="padding: 40px; margin-bottom: 100px" >
			<table class="table">
            <div id="report"></div>

  <thead class="thead-dark">
    <tr>
      <th scope="col">Dátum</th>
      <th scope="col">Sklad/Typ</th>
      <th scope="col">Záznam</th>
      <th scope="col">Čas priebehu</th>
    </tr>
  </thead>
  <?php
	
	$sql="SELECT `l_id`, `l_sklad`, `l_priebeh`, `l_cas`, `l_datum` FROM `log` WHERE `l_typ`='1' ORDER BY `l_id` DESC LIMIT 20"; 
  	$res=mysqli_query($link, $sql);  
	while (list($lid,$lsklad,$lpriebeh,$lcas,$ldatum)=mysqli_fetch_row($res)) {
		
	$pos = strpos($lpriebeh,'ERR');
	if ($pos === false) $str="text-success"; else $str="text-danger";	
?>   
 <tbody>
      <tr>
        <td><?=date_format (new DateTime($ldatum), 'd.m.Y');?></td>
        <td><?=$lsklad;?></td>
        <td class="<?=$str;?>"><?=$lpriebeh;?></td>
        <td><?=$lcas;?> s</td>
      </tr>
	  <?php } ?>
  </tbody>
</table>
			</div>		
              
        </div>
    </div>
</div>
<script>

var span = document.getElementById('span');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}

setInterval(time, 1000);
</script>
<script>

const url = 'atc-produkty.php';
$('.download-btn-produkty').click(function(){
	$.get(url, function(data, status){
		console.log('${data}')
	})
})

</script>
<?php } ?>