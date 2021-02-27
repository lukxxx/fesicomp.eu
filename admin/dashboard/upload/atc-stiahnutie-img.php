<?php 
	include "../../config.php";

	$dbl=$link;

	$url_katalog = "../../../catalog/";
	
	function img_save($inPath,$outPath)
	{ 
    $in = fopen($inPath, "rb");
    $out = fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
    	fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
	}
	
	function img_snimky($url,$limit)
	{ 
		global $dbl,$log;
		$sql="SELECT `p_id`,`o_url`,`o_kod` FROM `odkazy`,`produkty` WHERE `p_kod_sklad`=`o_kod` AND  `o_typ`='SNIMEK' AND `o_stiahnute`='0' ORDER BY `o_kod` DESC LIMIT $limit"; 
  	$res=mysqli_query($dbl, $sql);  
		$x=0; while (list($pid,$ourl,$okod)=mysqli_fetch_row($res)) 
		{
			$ext = substr(strrchr($ourl, '.'), 1);
			$url2 = $url."".$pid;
			if (!is_dir($url2)) mkdir($url2, 0777, true);
			$url_img = $url2."/".$pid."s.".$ext;
									
			img_save($ourl,$url_img);
			mysqli_query($dbl,"UPDATE `odkazy` SET `o_stiahnute`='1' WHERE `o_kod`='".$okod."' AND `o_typ`='SNIMEK' ");
			
			$size = filesize($url_img);
			if ($size == 0)
			{
				unlink($url_img);
			}
				else
			{
				mysqli_query($dbl,"UPDATE `produkty` SET `p_img`='".$pid."s.".$ext."' WHERE `p_id`='".$pid."' ");
			}
			
			$x++; unset($url2); unset($url_img); unset($size);
  	}  		
		$log.="OKK! SNIMKY su stiahnute (počet: ".$x.").<br>\n";
		echo "OKK! SNIMKY su stiahnute (počet: ".$x.").<br>\n";
	}
	
	function img_nahlady($url,$limit)
	{ 
		global $dbl,$log;
		$sql="SELECT `p_id`,`o_url`,`o_kod` FROM `odkazy`,`produkty` WHERE `p_kod_sklad`=`o_kod` AND  `o_typ`='NAHLED' AND `o_stiahnute`='0' ORDER BY `o_kod` DESC LIMIT $limit"; 
  	$res=mysqli_query($dbl, $sql);  
		$x=0; while (list($pid,$ourl,$okod)=mysqli_fetch_row($res)) 
		{
			$ext = substr(strrchr($ourl, '.'), 1);
			$url2 = $url."".$pid;
			if (!is_dir($url2)) mkdir($url2, 0777, true);
			$url_img = $url2."/".$pid."n.".$ext;
					
			img_save($ourl,$url_img);
			mysqli_query($dbl,"UPDATE `odkazy` SET `o_stiahnute`='1' WHERE `o_kod`='".$okod."' AND `o_typ`='NAHLED'");
			
			$size = filesize($url_img);
			if ($size == 0)
			{
				unlink($url_img);
			}
				else
			{
				mysqli_query($dbl,"UPDATE `produkty` SET `p_img2`='".$pid."n.".$ext."' WHERE `p_id`='".$pid."' ");
			}
			
			$x++; unset($url2); unset($url_img); unset($size);
  	}  		
		$log.="OKK! NAHLADY su stiahnute (počet: ".$x.").<br>\n";
		echo "OKK! NAHLADY su stiahnute (počet: ".$x.").<br>\n";
	}
	
	function img_obrazky($url,$limit)
	{ 
		global $dbl,$log;
		$sql="SELECT `p_id`,`o_url`,`o_kod`,`o_typ` FROM `odkazy`,`produkty` WHERE `p_kod_sklad`=`o_kod` AND  `o_typ` LIKE 'OBR%' AND `o_stiahnute`='0' ORDER BY `o_kod` DESC LIMIT $limit"; 
  	$res=mysqli_query($dbl, $sql);  
		$x=0; while (list($pid,$ourl,$okod,$otyp)=mysqli_fetch_row($res)) 
		{
			$ext = substr(strrchr($ourl, '.'), 1);
			$url2 = $url."".$pid;
			if (!is_dir($url2)) mkdir($url2, 0777, true);
			
			if (!file_Exists($url2."/".$pid."-1.".$ext)) $url_img = $url2."/".$pid."-1.".$ext; else
			if (!file_Exists($url2."/".$pid."-2.".$ext)) $url_img = $url2."/".$pid."-2.".$ext; else
			if (!file_Exists($url2."/".$pid."-3.".$ext)) $url_img = $url2."/".$pid."-3.".$ext; else
			if (!file_Exists($url2."/".$pid."-4.".$ext)) $url_img = $url2."/".$pid."-4.".$ext; else
			if (!file_Exists($url2."/".$pid."-5.".$ext)) $url_img = $url2."/".$pid."-5.".$ext; else
			if (!file_Exists($url2."/".$pid."-6.".$ext)) $url_img = $url2."/".$pid."-6.".$ext; else
			if (!file_Exists($url2."/".$pid."-7.".$ext)) $url_img = $url2."/".$pid."-7.".$ext; else
			if (!file_Exists($url2."/".$pid."-8.".$ext)) $url_img = $url2."/".$pid."-8.".$ext; else
			if (!file_Exists($url2."/".$pid."-9.".$ext)) $url_img = $url2."/".$pid."-9.".$ext; else
			if (!file_Exists($url2."/".$pid."-10.".$ext)) $url_img = $url2."/".$pid."-10.".$ext; else
			if (!file_Exists($url2."/".$pid."-11.".$ext)) $url_img = $url2."/".$pid."-11.".$ext; else
			if (!file_Exists($url2."/".$pid."-12.".$ext)) $url_img = $url2."/".$pid."-12.".$ext; else
			if (!file_Exists($url2."/".$pid."-13.".$ext)) $url_img = $url2."/".$pid."-13.".$ext; else
			if (!file_Exists($url2."/".$pid."-14.".$ext)) $url_img = $url2."/".$pid."-14.".$ext; else
			if (!file_Exists($url2."/".$pid."-15.".$ext)) $url_img = $url2."/".$pid."-15.".$ext;
					
			img_save($ourl,$url_img);
			mysqli_query($dbl,"UPDATE `odkazy` SET `o_stiahnute`='1' WHERE `o_kod`='".$okod."' AND `o_typ`='".$otyp."' ");
			
			$size = filesize($url_img);
			if ($size == 0)
			{
				unlink($url_img);
			}
						
			$x++; unset($ext); unset($url2); unset($url_img); unset($size);
  	}  		
		$log.="OKK! OBRAZKY su stiahnute (počet: ".$x.").<br>\n";
		echo "OKK! OBRAZKY su stiahnute (počet: ".$x.").<br>\n";
	}
	
 	$time_start=getmicrotime();
				 	
		img_snimky($url_katalog,'333');			// cca počet 53956
		img_nahlady($url_katalog,'333');		// cca počet 12830
  	img_obrazky($url_katalog,'333');		// cca počet 61096	

  $time_end=getmicrotime();

	// LOG
  echo"Celkový čas sťahovania a spracovania <b>".round($time_end-$time_start)."</b> sekund(a).";
 	mysqli_query($dbl, "INSERT INTO `log` (`l_typ`,`l_sklad`,`l_priebeh`,`l_cas`,`l_datum`) VALUES ('1','<b>ATC</b><br>Sťahovanie OBR','".$log."','".round($time_end-$time_start)."','".date("YmdHis")."');");
		        
  mysqli_close($dbl);

?>