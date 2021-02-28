<?php  
	include "../../config.php";

	$dbl=$link;

	$typ=1; // 1 technické, 2 logistické
	$atc_parametre_cis="xml/atc-parametre_cis.xml";
	$atc_parametre="xml/atc-parametre.xml";
	
     
  function stiahni_parametre_cis($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/ciselniky.asmx/Parametry?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo  HTTP/1.0\r\n");
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
  
  function stiahni_parametre($meno,$heslo,$typ,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/Parametry3?uzivatel=$meno&heslo=$heslo&typParametru=$typ&kodKategorie=&zmenyOd=01.01.2020  HTTP/1.0\r\n");
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
         
  function zapis_do_db_parametre_cis($subor)
  {
  	global $log, $dbl;
  	$handle=fopen($subor,"rb"); 
  	if ($handle)
  	{
    	$contents=fread($handle,filesize($subor)); fclose($handle);
    	preg_match_all("/.*?<Table diffgr:id=\"(.*?)\" msdata:rowOrder=\"(.*?)\">.*?<kod>(.*?)<\/kod>.*?<nazev>(.*?)<\/nazev>.*?<typ_parametru>(.*?)<\/typ_parametru>.*?<typ_hodnoty>(.*?)<\/typ_hodnoty>.*?<datovy_typ>(.*?)<\/datovy_typ>.*?<nazev_sablony>(.*?)<\/nazev_sablony>.*?<poradi>(.*?)<\/poradi>.*?<\/Table>/is",$contents,$vysledky);
    	for ($i=0;$i<count($vysledky[0]);$i++) 
    	{
      	$vysledky[4][$i]=str_replace("'","`",$vysledky[4][$i]);
      	$vysledky[8][$i]=str_replace("'","`",$vysledky[8][$i]);
          	      	
      	$sql="SELECT * FROM `parametrecis` WHERE `pc_kod`='".addslashes($vysledky[3][$i])."';"; 
      	$res=mysqli_query($dbl, $sql);
     		
     		if (mysqli_num_rows($res) == 1)
      	{
        	$sql="UPDATE `parametrecis` SET `pc_nazov`='".addslashes($vysledky[4][$i])."',`pc_typ_parametru`='".addslashes($vysledky[5][$i])."',`pc_typ_hodnoty`='".addslashes($vysledky[6][$i])."',`pc_datovy_typ`='".addslashes($vysledky[7][$i])."',`pc_nazov_sablony`='".addslashes($vysledky[8][$i])."',`pc_poradie`='".addslashes($vysledky[9][$i])."' WHERE `pc_kod`='".addslashes($vysledky[3][$i])."';";
	        $res=mysqli_query($dbl, $sql);
        
        } else {
	              
	        $sql="INSERT INTO `parametrecis` (`pc_kod`,`pc_nazov`,`pc_typ_parametru`,`pc_typ_hodnoty`,`pc_datovy_typ`,`pc_nazov_sablony`,`pc_poradie`) VALUES ('".addslashes($vysledky[3][$i])."','".addslashes($vysledky[4][$i])."','".addslashes($vysledky[5][$i])."','".addslashes($vysledky[6][$i])."','".addslashes($vysledky[7][$i])."','".addslashes($vysledky[8][$i])."','".addslashes($vysledky[9][$i])."');";
	        $res=mysqli_query($dbl, $sql);
	      }
    	} 
      	$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
      	echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
  	} else  {
      $log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
      echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
    }
  }
  
  function zapis_do_db_parametre($subor)
  {
  	global $log,$dbl;
  	
  	$kod=""; $kodp=""; $hodnota=""; $kodh=""; $popis="";
  				     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				if($kodp!=="")
				{
				 	$hodnota=str_replace("'","`",$hodnota);
	 
					$sql="INSERT INTO `parametre` (`p_kod`,`p_kod_parametru`,`p_hodnota`,`p_kod_hodnoty`,`p_popis`) VALUES ('".addslashes($kod)."','".addslashes($kodp)."','".addslashes($hodnota)."','".addslashes($kodh)."','".addslashes($popis)."');";
	       	$res=mysqli_query($dbl, $sql);
				 		       	
	       	$kodp=""; $hodnota=""; $kodh=""; $popis="";
				}
				
				$kodi=strpos($line,'zbozi kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+11); $kod=substr($line,$kodi+11,$end-$kodi-11); }
				$kodpi=strpos($line,'parametry kod="'); if($kodpi!==false) { $end=strpos($line,'"',$kodpi+15); $kodp=substr($line,$kodpi+15,$end-$kodpi-15); }
				$hodnotai=strpos($line,'hodnota="'); if($hodnotai!==false) { $end=strpos($line,'"',$hodnotai+9); $hodnota=substr($line,$hodnotai+9,$end-$hodnotai-9); }
				$kodhi=strpos($line,'kod_hodnoty="'); if($kodhi!==false) { $end=strpos($line,'"',$kodhi+13); $kodh=substr($line,$kodhi+13,$end-$kodhi-13); }
				$popisi=strpos($line,'popis="'); if($popisi!==false) { $end=strpos($line,'"',$popisi+7); $popis=substr($line,$popisi+7,$end-$popisi-7); }
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

  	stiahni_parametre_cis(ATC_MENO,ATC_HESLO,$atc_parametre_cis);
   	stiahni_parametre(ATC_MENO,ATC_HESLO,$typ,$atc_parametre);
   	
   	if (file_Exists($atc_parametre_cis))
		{
			$size = filesize($atc_parametre_cis);
			if ($size > 100000)
			{
				mysqli_query($dbl,"DELETE FROM `parametre`");				
				zapis_do_db_parametre_cis($atc_parametre_cis);
				unlink($atc_parametre_cis);
			}	
				else
			{
				unlink($atc_parametre_cis);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
  	
  	if (file_Exists($atc_parametre))
		{
			$size = filesize($atc_parametre);
			if ($size > 100000)
			{
				zapis_do_db_parametre($atc_parametre);
				unlink($atc_parametre);
			}	
				else
			{
				unlink($atc_parametre);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }

 	$time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Parametre','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>
