<?php  
	include "../../config.php";

	$dbl=$link;

	$atc_suvisiaci="xml/atc-suvisiaci.xml";
 
  function stiahni_suvisiaci($meno,$heslo,$subor)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/Souvisejici?strUzivatelskeJmeno=$meno&strUzivatelskeHeslo=$heslo  HTTP/1.0\r\n");
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
    
  function zapis_do_db_suvisiaci($subor)
  {
  	global $log,$dbl;
  	$kod=""; $kods=""; $typ="";
  				     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false)
				{
					
					$sql="SELECT * FROM `suvisiaci` WHERE `s_kod`='".addslashes($kod)."' AND `s_kod_suvisiaci`='".addslashes($kods)."' ";
	    		$res=mysqli_query($dbl, $sql);
     
     			if (mysqli_num_rows($res) == 0)
	    		{
	    			$sql="INSERT INTO `suvisiaci` (`s_kod`,`s_kod_suvisiaci`,`s_typ`) VALUES ('".addslashes($kod)."','".addslashes($kods)."','".addslashes($typ)."');";
	   				$res=mysqli_query($dbl, $sql);
       		}	
					
	   			$kod=""; $kods=""; $typ="";
				}
				
				$kodi=strpos($line,'kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+5); $kod=substr($line,$kodi+5,$end-$kodi-5); }
				$kodsi=strpos($line,'kod_s="'); if($kodsi!==false) { $end=strpos($line,'"',$kodsi+7); $kods=substr($line,$kodsi+7,$end-$kodsi-7); }
				$typi=strpos($line,'typ="'); if($typi!==false) { $end=strpos($line,'"',$typi+5); $typ=substr($line,$typi+5,$end-$typi-5); }
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

  	stiahni_suvisiaci(ATC_MENO,ATC_HESLO,$atc_suvisiaci);
  
  	if (file_Exists($atc_suvisiaci))
		{
			$size = filesize($atc_suvisiaci);
			if ($size > 100000)
			{
				zapis_do_db_suvisiaci($atc_suvisiaci);
				unlink($atc_suvisiaci);
			}	
				else
			{
				unlink($atc_suvisiaci);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }

  $time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Suvisiaci','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);
?>
