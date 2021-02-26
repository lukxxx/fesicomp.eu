<?php  include "./main.php"; $dbl=DB_connect();

	$atc_popisy="../xml/atc-popisy.xml";
	$atc_popisy_tmp="../xml/atc-popisy-tmp.xml";

     
  function stiahni_popisy($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/Popisy?uzivatel=$meno&heslo=$heslo&kodKategorie=&zmenyOd=01.01.2020  HTTP/1.0\r\n");
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
  
    
  function zapis_do_db_popisy($subor,$subor_tmp)
  {
  	global $log ,$dbl;
  	$i=0;	$text=""; $kod="";
		
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			$file_tmp = fopen("$subor_tmp", "w+");
			while(!feof($file))
			{
				$line=fgets($file);
				$handle = str_replace('</popis>',"\n</popis>\n",$line);
				fwrite($file_tmp,$handle);
			}
				fclose($file);
				rewind($file_tmp);
				
			while(!feof($file_tmp))
			{
				$line=fgets($file_tmp);
				$zbozi=strpos($line,'</popis>');
				
				if($zbozi!==false)
				{
					$text=html_entity_decode($text);
																				
					$sql="UPDATE `produkty` SET `p_popis`='".addslashes($text)."' WHERE `p_sklad`='1' AND `p_kod_sklad`='".addslashes($kod)."';";
	  			$res=mysqli_query($dbl, $sql); $sql="";
	  				     	  
					$text=""; $kod=""; $i++;	
				}
			
				$kodi=strpos($line,'kod_zbozi="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+11); $kod=substr($line,$kodi+11,$end-$kodi-11); }
				$texti=strpos($line,'xml:lang="cs">'); 
				if($texti!==false) 
				{ $end=strpos($line,'</popis>'); if($end!==false) { $text=substr($line,$texti+14,$end-$texti-14); } else 
					{
						$text=substr($line,$texti+14);
						do 
						{
							$point=ftell($file_tmp);
							$line=fgets($file_tmp);
							$end=strpos($line,'</popis>');
							if($end===false)
							{
								$text = $text . $line;
							} else {
								$text = $text . substr($line, 0, $end);
								break 1;
							}
						} while(1);
						fseek($file_tmp,$point);
			  	}
				}	
			}
				
				fclose($file_tmp);
				$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
				echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
 
  	} else {
  	
  		$log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
			echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
   	}
  }
 
	$time_start=getmicrotime();

  	stiahni_popisy(ATC_MENO,ATC_HESLO,$atc_popisy);
  	
  	if (file_Exists($atc_popisy))
		{
			$size = filesize($atc_popisy);
			if ($size > 100000)
			{
				zapis_do_db_popisy($atc_popisy,$atc_popisy_tmp);
				unlink($atc_popisy);
				unlink($atc_popisy_tmp);
			}	
				else
			{
				unlink($atc_popisy);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
  	
  $time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Popisy','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>
