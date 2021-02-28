<?php 

	include "../../config.php";

	$dbl=$link;

	$atc_ceny="xml/atc-ceny.xml";
	$atc_ceny_doporucene="xml/atc-ceny-doporucene.xml";
	   
	function stiahni_ceny($meno,$heslo,$subor,$typ)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/CenyZboziZakaznika?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo&intTypCeny=$typ&dtmDatum=01.01.2005 HTTP/1.0\r\n");
			fwrite($sock, "Host: www.atcomp.cz\r\n");
			fwrite($sock, "Content-type: application/x-www-form-urlencoded\r\n");
			fwrite($sock, "Content-length: " . strlen($data) . "\r\n");
			fwrite($sock, "Accept: */*\r\n");
			fwrite($sock, "\r\n");
			fwrite($sock, "$data\r\n");
			fwrite($sock, "\r\n");
			$headers = ""; while ($str = trim(fgets($sock, 4096))) $headers .= "$str\n"; $handle = fopen($subor, 'w+'); $body = ""; $pocet = 0;
			while (!feof($sock)) { $body .= fgets($sock, 4096); $pocet++; if ($pocet>=10000) { zapis_subor($handle,$subor,$body); $pocet=0; $body=""; }}
    	if ($pocet>0) { zapis_subor($handle,$subor,$body); $pocet=0; $body=""; }
    	fclose($handle); fclose($sock);
			$pos = strpos($log,'ERR'); if ($pos === false)  
  		{
  			$log.="OKK! (<b>$subor</b>) bol stiahnutý.<br>\n";
  			echo"OKK! (<b>$subor</b>) bol stiahnutý.<br>\n";
  		} 
  		else 
			{
      	$log.="ERR! Proces stopnutý.<br>\n";
      	echo"ERR! Proces stopnutý.<br>\n";
			}
    }
  }
  
  function zapis_do_db_ceny($subor)
  {
  	global $log, $dbl;
  		  	
  	$kod=""; $cena=""; $rema=""; $autorsky_poplatek="";
  				     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false && $kod!="" && $cena > 0)
				{
										
					$sql="UPDATE `produkty` SET `p_cena`='".$cena."',`p_rema`='".$rema."',`p_autorsky_poplatok`='".$autorsky_poplatek."' WHERE `p_kod_sklad`='".addslashes($kod)."';"; 
					$res=mysqli_query($dbl, $sql); $sql="";
															
					$kod=""; $cena=""; $rema=""; $autorsky_poplatek="";
				}
				
				$kodi=strpos($line,'kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+5); $kod=substr($line,$kodi+5,$end-$kodi-5); }
				$cenai=strpos($line,'cena="'); if($cenai!==false) { $end=strpos($line,'"',$cenai+6); $cena=substr($line,$cenai+6,$end-$cenai-6); }
				$remai=strpos($line,'rema="'); if($remai!==false) { $end=strpos($line,'"',$remai+6); $rema=substr($line,$remai+6,$end-$remai-6); }
				$autorsky_poplateki=strpos($line,'autorsky_poplatek="'); if($autorsky_poplateki!==false) { $end=strpos($line,'"',$autorsky_poplateki+19); $autorsky_poplatek=substr($line,$autorsky_poplateki+19,$end-$autorsky_poplateki-19); }
	 		}
	  	
	  	fclose($file);
	  	$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
    
    } else  {
      
      $log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
      echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; 
    }
  }
  
  function zapis_do_db_ceny_doporucene($subor)
  {
  	global $log, $dbl;
  		  	
  	$kod=""; $cena="";
  				     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false && $kod!="" && $cena > 0)
				{
										
					$sql="UPDATE `produkty` SET `p_cena_doporucena`='".$cena."' WHERE `p_kod_sklad`='".addslashes($kod)."';"; 
					$res=mysqli_query($dbl, $sql); $sql="";
															
					$kod=""; $cena=""; $rema=""; $autorsky_poplatek="";
				}
				
				$kodi=strpos($line,'kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+5); $kod=substr($line,$kodi+5,$end-$kodi-5); }
				$cenai=strpos($line,'cena="'); if($cenai!==false) { $end=strpos($line,'"',$cenai+6); $cena=substr($line,$cenai+6,$end-$cenai-6); }
			}
	  	
	  	fclose($file);
	  	$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
    
    } else  {
      
      $log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
      echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; 
    }
  }
  
  
 	$time_start=getmicrotime(); 
  	
  	stiahni_ceny(ATC_MENO,ATC_HESLO,$atc_ceny,0);
  	stiahni_ceny(ATC_MENO,ATC_HESLO,$atc_ceny_doporucene,1);
		
		if (file_Exists($atc_ceny))
		{
			$size = filesize($atc_ceny);
			if ($size > 50000)
			{
				zapis_do_db_ceny($atc_ceny);
				unlink($atc_ceny);
			}	
				else
			{
				unlink($atc_ceny);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
		
		if (file_Exists($atc_ceny_doporucene))
		{
			$size = filesize($atc_ceny_doporucene);
			if ($size > 50000)
			{
				zapis_do_db_ceny_doporucene($atc_ceny_doporucene);
				unlink($atc_ceny_doporucene);
			}	
				else
			{
				unlink($atc_ceny_doporucene);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
  	
	$time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
  $log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Ceny','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>