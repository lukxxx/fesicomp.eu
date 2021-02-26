<?php include "./main.php";	$link=DB_connect();

	$atc_produkty="../xml/atc-produkty-update.xml";
	$atc_datum=date("d.m.Y",-20*86400+mktime(00,00,00,date("m"),date("d"),date("Y")));	
				
  function array_kategorie_gen()
  {
    global $link;
    $sql="SELECT `k_id`,`k_kategoria`,`k_podkategoria` FROM `kategorie` ";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($kid,$kkategoria,$kpodkategoria)=mysqli_fetch_row($res)) 
  	{
  		$array[$x]['kid']=$kid;
  		$array[$x]['kkategoria']=$kkategoria;
  		$array[$x]['kpodkategoria']=$kpodkategoria;
  		$x++;
  	}
  	return $array;
  }
  
  function kategoria_gen($array,$kids,$pkids)
	{ 
		$ar = array_filter($array, function ($var) use ($kids,$pkids) { return ($var['kkategoria'] == $kids &&  $var['kpodkategoria'] == $pkids); });
		array_multisort( $ar, SORT_ASC, SORT_NUMERIC, $ar ); 
		return $ar['0']['kid'];
	} 
  
  function array_vyrobcovia_gen()
  {
    global $link;
    $sql="SELECT `v_kod`,`v_nazov` FROM `vyrobcovia` ";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($vkod,$vnazov)=mysqli_fetch_row($res)) 
  	{
  		$array[$x]['vkod']=$vkod;
  		$array[$x]['vnazov']=$vnazov;
  		$x++;
  	}
  	return $array;
  }
  
  function vyrobca_gen($array,$vkod)
	{ 
		$ar = array_filter($array, function ($var) use ($vkod) { return ($var['vkod'] == $vkod); });
		array_multisort( $ar, SORT_ASC, SORT_NUMERIC, $ar ); 
		return $ar['0']['vnazov'];
	}
		
  function stiahni_produkty($meno,$heslo,$subor,$datum)
  {
		global $log;
		$sock = fsockopen("www.atcomp.cz", 80, $errno, $errstr, 30);
		if (!$sock) { $log.="ERR! $errstr ($errno)<br>\n"; echo"ERR! $errstr ($errno)<br>\n"; } else 
		{
			$data = "foo=" . urlencode("Value for Foo") . "&bar=" . urlencode("Value for Bar");
			fwrite($sock, "GET /webservices/zbozi.asmx/Zbozi2?uzivatel=$meno&heslo=$heslo&kodKategorie=&zmenyOd=$datum HTTP/1.0\r\n");
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
  
  function zapis_do_db_produkty($subor)
  {
  	global $log, $link;
  	$arkat_gen=array_kategorie_gen();
		$arvyr_gen=array_vyrobcovia_gen();
		$kod=""; $nazev=""; $part_number=""; $kod_vyrobce=""; $kod_kategorie=""; $kod_podkategorie=""; $aktualni=""; $typ=""; $zaruka=""; $doprodej=""; $obv_dodavka=""; $kkid="";
							     
		if (file_exists($subor))
		{
			$file = fopen("$subor", "r");
			while(!feof($file))
			{
				$line=fgets($file);
				$zbozi=strpos($line,'/>');
				if($zbozi!==false && $kod!=="")
				{				
					$nazev=str_replace("'","`",$nazev);
					$kod_kategorie=str_replace("'","`",$kod_kategorie);
					$kod_podkategorie=str_replace("'","`",$kod_podkategorie);
					
					$kkid=kategoria_gen($arkat_gen,addslashes($kod_kategorie),addslashes($kod_podkategorie));
					if ($kkid == "") $kkid="870";
					
  				$vyrobca=vyrobca_gen($arvyr_gen,addslashes($kod_vyrobce));
  				if ($vyrobca == "") $vyrobca="NEURČENE";		
									
	    		$sql="SELECT * FROM `produkty` WHERE `p_kod_sklad`='".addslashes($kod)."'"; 
	    		$res=mysqli_query($link, $sql);
     
     			if (mysqli_num_rows($res) == 1)
	    		{
	    			$sql="UPDATE `produkty` SET `p_kid`='".addslashes($kkid)."',`p_pn`='".addslashes($part_number)."',`p_aktualni`='".addslashes($aktualni)."',`p_dopredaj`='".addslashes($doprodej)."',`p_nazov`='".addslashes($nazev)."',`p_vyrobca`='".addslashes($vyrobca)."',`p_zaruka`='".addslashes($zaruka)."',`p_sklad`='1',`p_kid_sklad`='".addslashes($kod_kategorie)."',`p_pkid_sklad`='".addslashes($kod_podkategorie)."',`p_typ`='".addslashes($typ)."',`p_obv_dodavka`='".addslashes($obv_dodavka)."' WHERE `p_kod_sklad`='".addslashes($kod)."'";
	      		$res=mysqli_query($link, $sql); $sql="";				
       		} 
       		  else
	    		{
       			$sql="INSERT INTO `produkty` (`p_kid`,`p_pn`,`p_aktualni`,`p_dopredaj`,`p_nazov`,`p_vyrobca`,`p_zaruka`,`p_sklad`,`p_kod_sklad`,`p_kid_sklad`,`p_pkid_sklad`,`p_typ`,`p_obv_dodavka`) VALUES ('".addslashes($kkid)."','".addslashes($part_number)."','".addslashes($aktualni)."','".addslashes($doprodej)."','".addslashes($nazev)."','".addslashes($vyrobca)."','".addslashes($zaruka)."','1','".addslashes($kod)."','".addslashes($kod_kategorie)."','".addslashes($kod_podkategorie)."','".addslashes($typ)."','".addslashes($obv_dodavka)."');";
       			$res=mysqli_query($link, $sql); $sql="";
       		}
	     		     		
	     		$kod=""; $nazev=""; $part_number=""; $kod_vyrobce=""; $kod_kategorie=""; $kod_podkategorie=""; $aktualni=""; $typ=""; $zaruka=""; $doprodej=""; $obv_dodavka=""; $kkid="";
	     	}
				
				$kodi=strpos($line,'kod="'); if($kodi!==false) { $end=strpos($line,'"',$kodi+5); $kod=substr($line,$kodi+5,$end-$kodi-5);	}
				$nazevi=strpos($line,'nazev="'); if($nazevi!==false) { $end=strpos($line,'"',$nazevi+7); $nazev=substr($line,$nazevi+7,$end-$nazevi-7); }
				$part_numberi=strpos($line,'part_number="'); if($part_numberi!==false) { $end=strpos($line,'"',$part_numberi+13); $part_number=substr($line,$part_numberi+13,$end-$part_numberi-13); }
    		$kod_vyrobcei=strpos($line,'kod_vyrobce="'); if($kod_vyrobcei!==false) { $end=strpos($line,'"',$kod_vyrobcei+13); $kod_vyrobce=substr($line,$kod_vyrobcei+13,$end-$kod_vyrobcei-13); }
				$kod_kategoriei=strpos($line,'kod_kategorie="'); if($kod_kategoriei!==false) { $end=strpos($line,'"',$kod_kategoriei+15); $kod_kategorie=substr($line,$kod_kategoriei+15,$end-$kod_kategoriei-15); $kod_kategorie=html_entity_decode($kod_kategorie); }
	  		$kod_podkategoriei=strpos($line,'kod_podkategorie="'); if($kod_podkategoriei!==false) { $end=strpos($line,'"',$kod_podkategoriei+18); $kod_podkategorie=substr($line,$kod_podkategoriei+18,$end-$kod_podkategoriei-18); $kod_podkategorie=html_entity_decode($kod_podkategorie); }
	  		$aktualnii=strpos($line,'aktualni="'); if($aktualnii!==false) { $end=strpos($line,'"',$aktualnii+10); $aktualni=substr($line,$aktualnii+10,$end-$aktualnii-10); }
  		  $typi=strpos($line,'typ="'); if($typi!==false) { $end=strpos($line,'"',$typi+5); $typ=substr($line,$typi+5,$end-$typi-5); }
  			$zarukai=strpos($line,'zaruka="'); if($zarukai!==false) { $end=strpos($line,'"',$zarukai+8); $zaruka=substr($line,$zarukai+8,$end-$zarukai-8); }
				$doprodeji=strpos($line,'doprodej="'); if($doprodeji!==false) { $end=strpos($line,'"',$doprodeji+10); $doprodej=substr($line,$doprodeji+10,$end-$doprodeji-10); }
				$obv_dodavkai=strpos($line,'obv_dodavka="'); if($obv_dodavkai!==false) { $end=strpos($line,'"',$obv_dodavkai+13); $obv_dodavka=substr($line,$obv_dodavkai+13,$end-$obv_dodavkai-13); }
	 		}
	  	
	  	fclose($file);
	  	$log.="OKK! (<b>$subor</b>) je spracovaný.<br>\n";
	  	echo "OKK! (<b>$subor</b>) je spracovaný.<br>\n";
   	
   	} else {
	   
	  	$log.="ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
	  	echo "ERR! (<b>$subor</b>) súbor neexistuje.<br>\n";
    }
  } 

	
	$time_start=getmicrotime();
     
    stiahni_produkty(ATC_MENO,ATC_HESLO,$atc_produkty,$atc_datum);
           		        
    if (file_Exists($atc_produkty))
		{
			$size = filesize($atc_produkty);
			if ($size > 50000)
			{
				zapis_do_db_produkty($atc_produkty);
				unlink($atc_produkty);
			}	
				else
			{
				//unlink($atc_produkty);
				$log.="ERR! Proces stopnutý súbor maly.<br>\n";
      	echo"ERR! Proces stopnutý súbor maly.<br>\n";
			} 
    }
         	
  $time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	$log=str_replace("../xml/","",$log);
 	mysqli_query($link, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Produkty update','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($link);
?>
