<?php include "./main.php"; $dbl=DB_connect();

	$atc_kategorie="../xml/atc-kategorie.xml";
	$atc_podkategorie="../xml/atc-podkategorie.xml";
	$atc_vyrobcovia="../xml/atc-vyrobcovia.xml";   
      
  function stiahni_kategorie($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/ciselniky.asmx/Kategorie?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo HTTP/1.0\r\n");
			fwrite($sock, "Host: www.atcomp.cz\r\n");
			fwrite($sock, "Content-type: application/x-www-form-urlencoded\r\n");
			fwrite($sock, "Content-length: " . strlen($data) . "\r\n");
			fwrite($sock, "Accept: */*\r\n");
			fwrite($sock, "\r\n");
			fwrite($sock, "$data\r\n");
			fwrite($sock, "\r\n");
			$headers = ""; while ($str = trim(fgets($sock, 4096))) $headers .= "$str\n";
   		$handle = fopen($subor, 'w+'); $body = ""; $pocet = 0; while (!feof($sock)) { $body .= fgets($sock, 4096); $pocet++; 
   		if ($pocet>=10000) { zapis_subor($handle,$subor,$body); $pocet=0; $body=""; }}
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
  
  function stiahni_podkategorie($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/ciselniky.asmx/Podkategorie?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo HTTP/1.0\r\n");
			fwrite($sock, "Host: www.atcomp.cz\r\n");
			fwrite($sock, "Content-type: application/x-www-form-urlencoded\r\n");
			fwrite($sock, "Content-length: " . strlen($data) . "\r\n");
			fwrite($sock, "Accept: */*\r\n");
			fwrite($sock, "\r\n");
			fwrite($sock, "$data\r\n");
			fwrite($sock, "\r\n");
			$headers = ""; while ($str = trim(fgets($sock, 4096))) $headers .= "$str\n";
   		$handle = fopen($subor, 'w+'); $body = ""; $pocet = 0; while (!feof($sock)) { $body .= fgets($sock, 4096); $pocet++;
    	if ($pocet>=10000) { zapis_subor($handle,$subor,$body); $pocet=0; $body=""; }}
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
  
  function stiahni_vyrobcovia($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/ciselniky.asmx/Vyrobci?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo HTTP/1.0\r\n");
			fwrite($sock, "Host: www.atcomp.cz\r\n");
			fwrite($sock, "Content-type: application/x-www-form-urlencoded\r\n");
			fwrite($sock, "Content-length: " . strlen($data) . "\r\n");
			fwrite($sock, "Accept: */*\r\n");
			fwrite($sock, "\r\n");
			fwrite($sock, "$data\r\n");
			fwrite($sock, "\r\n");
			$headers = "";	while ($str = trim(fgets($sock, 4096)))	$headers .= "$str\n";
   		$handle = fopen($subor, 'w+');	$body = "";	$pocet = 0;	while (!feof($sock)) {	$body .= fgets($sock, 4096); $pocet++;
    	if ($pocet>=10000) { zapis_subor($handle,$subor,$body); $pocet=0; $body=""; }}
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

	function zapis_do_db_kategorie($subor)
  {
  	global $log, $dbl;
  	$handle=fopen($subor,"rb"); 
  	if ($handle)
  	{
    	$contents=fread($handle,filesize($subor)); fclose($handle);
    	preg_match_all("/.*?<Table diffgr:id=\"(.*?)\" msdata:rowOrder=\"(.*?)\">.*?<kod>(.*?)<\/kod>.*?<nazev>(.*?)<\/nazev>.*?<poradi>(.*?)<\/poradi>.*?<\/Table>/is",$contents,$vysledky);
    	for ($i=0;$i<count($vysledky[0]);$i++) 
    	{
      	$vysledky[3][$i]=str_replace("'","`",$vysledky[3][$i]);
      	$vysledky[4][$i]=str_replace("'","`",$vysledky[4][$i]);
      
     		$sql="SELECT * FROM `kategorie` WHERE `k_kategoria`='".addslashes($vysledky[3][$i])."';"; 
     		$res=mysqli_query($dbl, $sql);
     
     		if (mysqli_num_rows($res) > 0)
     		{
     				$sql="UPDATE `kategorie` SET `k_gen`='1',`k_nazov_sklad`='".addslashes($vysledky[4][$i])."',`k_poradie_sklad`='".addslashes($vysledky[5][$i])."',`k_update`='".date("YmdHis")."' WHERE `k_kategoria`='".addslashes($vysledky[3][$i])."';";
	    			mysqli_query($dbl, $sql);
	   
	   		} else {
	   	
						$sql="INSERT INTO `kategorie` (`k_main`,`k_aktualni`,`k_gen`,`k_kategoria`,`k_nazov_sklad`,`k_poradie_sklad`,`k_nazov`,`k_poradie`,`k_vytvorena`) VALUES ('0','1','1','".addslashes($vysledky[3][$i])."','".addslashes($vysledky[4][$i])."','".addslashes($vysledky[5][$i])."','".addslashes($vysledky[4][$i])."','".addslashes($vysledky[5][$i])."','".date("YmdHis")."');";
	      		mysqli_query($dbl, $sql); 
	   		}
	  	} 
     
      $log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      echo"OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      
      
  	} else  { 
  		
  		$log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; 
  		echo"ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; }
  }

  function zapis_do_db_podkategorie($subor)
  {
  	global $log , $dbl;
  	$handle=fopen($subor,"rb"); 
  	if ($handle)
  	{
    	$contents=fread($handle,filesize($subor)); fclose($handle);
    	preg_match_all("/.*?<Table diffgr:id=\"(.*?)\" msdata:rowOrder=\"(.*?)\">.*?<kod_kategorie>(.*?)<\/kod_kategorie>.*?<kod>(.*?)<\/kod>.*?<nazev>(.*?)<\/nazev>.*?<poradi>(.*?)<\/poradi>.*?<\/Table>/is",$contents,$vysledky);
    	for ($i=0;$i<count($vysledky[0]);$i++) 
    	{
      	$vysledky[3][$i]=str_replace("'","`",$vysledky[3][$i]);
      	$vysledky[4][$i]=str_replace("'","`",$vysledky[4][$i]);
      	$vysledky[5][$i]=str_replace("'","`",$vysledky[5][$i]);
      	      	
      	$sql="SELECT k_id FROM `kategorie` WHERE `k_kategoria`='".addslashes($vysledky[3][$i])."' AND `k_kid`='0';"; 
      	$res=mysqli_query($dbl, $sql); list($kid)=mysqli_fetch_row($res);
      	
      	
      	
      	$sql="SELECT * FROM `kategorie` WHERE `k_kategoria`='".addslashes($vysledky[3][$i])."' AND `k_podkategoria`='".addslashes($vysledky[4][$i])."';"; 
      	$res=mysqli_query($dbl, $sql);
      	
      	if (mysqli_num_rows($res)==1) 
      	{
        	$sql="UPDATE `kategorie` SET `k_gen`='1',`k_nazov_sklad`='".addslashes($vysledky[5][$i])."',`k_poradie_sklad`='".addslashes($vysledky[6][$i])."',`k_update`='".date("YmdHis")."' WHERE `k_kategoria`='".addslashes($vysledky[3][$i])."' AND `k_podkategoria`='".addslashes($vysledky[4][$i])."';";
	        mysqli_query($dbl, $sql);
        
        } else {
	           
	        $sql="INSERT INTO `kategorie` (`k_main`,`k_kid`,`k_aktualni`,`k_gen`,`k_kategoria`,`k_podkategoria`,`k_nazov_sklad`,`k_poradie_sklad`,`k_nazov`,`k_poradie`,`k_vytvorena`) VALUES ('0','".$kid."','1','1','".addslashes($vysledky[3][$i])."','".addslashes($vysledky[4][$i])."','".addslashes($vysledky[5][$i])."','".addslashes($vysledky[6][$i])."','".addslashes($vysledky[5][$i])."','".addslashes($vysledky[6][$i])."','".date("YmdHis")."');";
	        mysqli_query($dbl, $sql);
	      }
    	} 
      	$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      	echo"OKK! (<b>$subor</b>) je spracovaný.<br>\n";
        	
  	} else  { 
  		
  		$log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; 
  		echo"ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; }
  }
  
  function zapis_do_db_vyrobcovia($subor)
  {
  global $log, $dbl;
  $handle=fopen($subor,"rb"); 
  if ($handle)
  {
    $contents=fread($handle,filesize($subor)); fclose($handle);
    preg_match_all("/.*?<Table diffgr:id=\"(.*?)\" msdata:rowOrder=\"(.*?)\">.*?<kod>(.*?)<\/kod>.*?<nazev>(.*?)<\/nazev>.*?<\/Table>/is",$contents,$vysledky);
    for ($i=0;$i<count($vysledky[0]);$i++) 
    {
      $vysledky[4][$i]=str_replace("'","`",$vysledky[4][$i]);
            
      $sql="SELECT * FROM `vyrobcovia` WHERE `v_kod`='".addslashes($vysledky[3][$i])."';"; 
      $res=mysqli_query($dbl, $sql);
      
      if (mysqli_num_rows($res)==0) mysqli_query($dbl,"INSERT INTO `vyrobcovia` (`v_sklad`,`v_kod`,`v_nazov`,`v_vytvorena`,`v_update`) VALUES ('1','".addslashes($vysledky[3][$i])."','".addslashes($vysledky[4][$i])."','".date("YmdHis")."','".date("YmdHis")."');");
	  	    
    } 
     $log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
     echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
  } else  {
      $log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
      echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n"; 
    }
  }

	$time_start=getmicrotime();
	
   	stiahni_kategorie(ATC_MENO,ATC_HESLO,$atc_kategorie);
   	stiahni_podkategorie(ATC_MENO,ATC_HESLO,$atc_podkategorie); 
   	stiahni_vyrobcovia(ATC_MENO,ATC_HESLO,$atc_vyrobcovia);
		
		$pos = strpos($log,'ERR');
		if ($pos === false)  mysqli_query($dbl, "UPDATE `kategorie` SET `k_gen`='0' WHERE `k_aktualni`!='2' AND `k_aktualni`!='3'"); else 
		{
      $log.="ERR! Proces stopnutý.<br>\n";
      echo"ERR! Proces stopnutý.<br>\n";
		}
   	
   	if (file_Exists($atc_kategorie))
		{
			$size = filesize($atc_kategorie);
			if ($size > 3000)
			{
				zapis_do_db_kategorie($atc_kategorie);
				unlink($atc_kategorie);
			}	
				else
			{
				unlink($atc_kategorie);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
   	
   	if (file_Exists($atc_podkategorie))
		{
			$size = filesize($atc_podkategorie);
			if ($size > 40000)
			{
				zapis_do_db_podkategorie($atc_podkategorie);
				unlink($atc_podkategorie);
			}	
				else
			{
				unlink($atc_podkategorie);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
   		
		$pos = strpos($log,'ERR');
		if ($pos === false)
		{
			 mysqli_query($dbl, "UPDATE `kategorie` SET `k_aktualni`='0' WHERE `k_gen`='0' AND `k_aktualni`!='2' AND `k_aktualni`!='3'");
			 mysqli_query($dbl, "UPDATE `kategorie` SET `k_aktualni`='1' WHERE `k_gen`='1' AND `k_aktualni`!='2' AND `k_aktualni`!='3'");
		}
		else 
		{
      $log.="ERR! Proces stopnutý.<br>\n";
      echo"ERR! Proces stopnutý.<br>\n";
		}		
		
    if (file_Exists($atc_vyrobcovia))
		{
			$size = filesize($atc_vyrobcovia);
			if ($size > 15000)
			{
				zapis_do_db_vyrobcovia($atc_vyrobcovia);
				unlink($atc_vyrobcovia);
			}	
				else
			{
				unlink($atc_vyrobcovia);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }	  	
      	   	
  $time_end=getmicrotime();
  	
  // LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Kategórie<br>Výrobcovia','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>
