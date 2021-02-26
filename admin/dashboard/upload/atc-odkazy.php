<?php  include "./main.php"; $dbl=DB_connect();

	$atc_odkazy="../xml/atc-odkazy.xml";
    
  function stiahni_odkazy($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/Odkazy?uzivatel=$meno&heslo=$heslo&typ=all  HTTP/1.0\r\n");
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
    
  function zapis_do_db_odkazy($subor)
  {
  	global $log ,$dbl;
  	$kod=""; $typ=""; $popis=""; $urll="";

		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false && $kod!=="")
				{
					$popis=html_entity_decode($popis);							      		          	      	
      		
      		$sql="SELECT * FROM `odkazy` WHERE `o_kod`='".addslashes($kod)."' AND `o_typ`='".addslashes($typ)."' ";
	    		$res=mysqli_query($dbl, $sql);
     
     			if (mysqli_num_rows($res) == 1)
	    		{
	    			$sql="UPDATE `odkazy` SET `o_popis`='".addslashes($popis)."',`o_url`='".addslashes($urll)."' WHERE `o_kod`='".addslashes($kod)."' AND `o_typ`='".addslashes($typ)."' ";
	      		$res=mysqli_query($dbl, $sql); $sql="";
       		}
       		  else
	    		{
       			$sql="INSERT INTO `odkazy` (`o_kod`,`o_typ`,`o_popis`,`o_url`) VALUES ('".addslashes($kod)."','".addslashes($typ)."','".addslashes($popis)."','".addslashes($urll)."');";
	        	$res=mysqli_query($dbl, $sql); $sql="";
       		}
       		
					$kod=""; $typ=""; $popis=""; $urll="";
				}

				$kodi=strpos($line,'kod_zbozi="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+11); $kod=substr($line,$kodi+11,$end-$kodi-11); }
				$typi=strpos($line,'typ="'); if($typi!==false) { $end=strpos($line,'"',$typi+5); $typ=substr($line,$typi+5,$end-$typi-5); }
				$popisi=strpos($line,'popis="'); if($popisi!==false) { $end=strpos($line,'"',$popisi+7); $popis=substr($line,$popisi+7,$end-$popisi-7); }
				$urlli=strpos($line,'url="'); if($urlli!==false) { $end=strpos($line,'"',$urlli+5); $urll=substr($line,$urlli+5,$end-$urlli-5); }
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

  	stiahni_odkazy(ATC_MENO,ATC_HESLO,$atc_odkazy);
  	
  	if (file_Exists($atc_odkazy))
		{
			$size = filesize($atc_odkazy);
			if ($size > 100000)
			{
				zapis_do_db_odkazy($atc_odkazy);
				unlink($atc_odkazy);
			}	
				else
			{
				unlink($atc_odkazy);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }

  $time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Odkazy Obrazky','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>
