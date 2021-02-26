<?php include "./main.php"; $dbl=DB_connect();

	$atc_dostupnost="../xml/atc-dostupnost.xml";
     
      
  function stiahni_dostupnost($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/StavSkladuZmeny?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo&dtmDatumOd=01.01.2020  HTTP/1.0\r\n");
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
  
  function zapis_do_db_dostupnost($subor)
  {
  	global $log ,$dbl;
  	$kod=""; $pocet="";
			     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false && $kod!="")
				{				
					$sql="UPDATE `produkty` SET `p_dostup`='".addslashes($pocet)."' WHERE `p_sklad`='1' AND `p_kod_sklad`='".addslashes($kod)."';";
	     		$res=mysqli_query($dbl, $sql); $sql="";
	     		
	     		$kod=""; $pocet="";
				}
				
				$kodi=strpos($line,'kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+5); $kod=substr($line,$kodi+5,$end-$kodi-5); }
				$poceti=strpos($line,'pocet="'); if($poceti!==false) { $end=strpos($line,'"',$poceti+7); $pocet=substr($line,$poceti+7,$end-$poceti-7); }
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
	
	  stiahni_dostupnost(ATC_MENO,ATC_HESLO,$atc_dostupnost);
  
   	if (file_Exists($atc_dostupnost))
		{
			$size = filesize($atc_dostupnost);
			if ($size > 50000)
			{
				zapis_do_db_dostupnost($atc_dostupnost);
				unlink($atc_dostupnost);
			}	
				else
			{
				unlink($atc_dostupnost);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }

	$time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Dostupnost','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>