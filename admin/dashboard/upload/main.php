<?php

	define("RAND_KEY","0iQxek66oVZe");

  define("MAIN_HOSTNAME","www.compsnv.sk");
  define("DB_HOSTNAME","db003.nameserver.sk");
  define("DB_NAME","compsnv_sk2");
  define("DB_USERNAME","compsnv_sk2");
  define("DB_PASSWORD","iQ8sh2lz");
  
  define("ATC_MENO","FEDORCAK");
  define("ATC_HESLO","fesi7812");
  
  function DB_connect() { return mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME); }
  function GetLoginSessionVar() { $retvar = md5(RAND_KEY); $retvar = 'usr_'.substr($retvar,0,10); return $retvar; } 
	function CheckLogin() { if(!isset($_SESSION)){ session_start(); } $sessionvar = GetLoginSessionVar(); if(empty($_SESSION[$sessionvar])) { return false; } return true; }
 	function getmicrotime() { list($usec,$sec)=explode(" ",microtime()); return ((float)$usec+(float)$sec); }
 	function ToPHPDate($d) { return substr($d,6,2).'.'.substr($d,4,2).'.'.substr($d,0,4).' '.substr($d,8,2).':'.substr($d,10,2); }
	
	function zapis_subor($handle,$subor,$retazec)
  {
  	global $log; 	
		if (is_writable($subor)) 
		{
	  	if (!$handle) { $log.="ERR! nemôžem zapísať subor.<br>\n"; echo "ERR! nemôžem zapísať subor.<br>\n"; exit; }
	   	if (fwrite($handle, $retazec) === FALSE) { $log.="ERR! nemôžem zapísať subor<.br>\n"; echo "ERR! nemôžem zapísať subor.<br>\n"; exit; }
	  	} 
	 		else 
	 	{
	  	$log.="ERR! nemá práva pre zápis subora.<br>\n";
	   	echo "ERR! nemá práva pre zápis subora.<br>\n";
		}
  }
	
  function konstanty()
  {
    global $link;
    $sql="SELECT `k_id`,`k_konstanta` FROM `konstanty`";
  	$res=mysqli_query($link, $sql); while (list($kid,$kkonstanta)=mysqli_fetch_row($res)) 
  	{
  		$konstanty[$kid]=$kkonstanta;
  	}
  	return $konstanty;
  }
  
  function podstranka($sid)
  {
    global $link;
    $sql="SELECT `s_nazov`,`s_text` FROM `podstranky` WHERE `s_id`='".$sid."' ";
  	$res=mysqli_query($link, $sql); list($snazov,$stext)=mysqli_fetch_row($res);
  	$text[0]=$snazov; $text[1]=$stext; return $text;
  }
  
  function rozbalovacie_menu_kategorie($id,$id2,$id3,$id4)
  {
		if (isset($_COOKIE[$id4]))
		{
			$strcook = json_decode(base64_decode($_COOKIE[$id4]),true);
			foreach ($strcook as $row) 
			{
				if ($row['id'] == $id)
				{
					foreach ($row['wrapedKatIds'] as $val) 
					{
						if ($val == $id2)  { if ($id3 == 1)  return "openable"; else return "closed"; }
 					}
					
					foreach ($row['expandKatIds'] as $val) 
					{
						if ($val == $id2)  { if ($id3 == 1)  return "closeable"; else return; }
 					}
				} 
			}
				if ($id3 == 1)  return "openable"; else return "closed";		
		}
			else { if ($id3 == 1)  return "openable"; else return "closed"; }
	}
  
  function zobrazenie_produktov($kid)
  {
  	global $link;
    $sql="SELECT `k_id` FROM `kategorie` WHERE `k_kid`= '".$kid."' ";
  	$res=mysqli_query($link, $sql); $num =mysqli_num_rows($res); 
  	
  	$sql1="SELECT `k_main` FROM `kategorie` WHERE `k_kid`!='0' AND `k_id`= '".$kid."' ";
  	$res1=mysqli_query($link, $sql1); list($kmain)=mysqli_fetch_row($res1);
  	
  	if ($num == 0 || $kmain == 1) return true; 
  }
  
  function vytvorCestu($kid)
  {
    global $cesta,$cestaid,$link;
    $sql1="SELECT `k_id`,`k_kid`,`k_nazov`
           FROM `kategorie`
           WHERE `k_id`='$kid'"; $res1=mysqli_query($link, $sql1);
    			 list($kid1,$kkid1,$knazov1)=mysqli_fetch_row($res1);
    if ($kkid1==0) { $cesta[]=$knazov1; $cestaid[]=$kid1; }
    if ($kkid1!=0) { $cesta[]=$knazov1; $cestaid[]=$kid1; vytvorCestu($kkid1); }
  }
  
  function vytvorCestu2($kid)
  {
    global $cestasql,$cestakid,$link;
    $sql1="SELECT `k_id`,`k_kid`,`k_main`,`k_nazov`,`k_medzera`
           FROM `kategorie`
           WHERE `k_kid`='$kid' AND (`k_aktualni`='1' OR `k_aktualni`='3') ORDER BY `k_poradie`"; $res1=mysqli_query($link, $sql1);
   	
   	if (mysqli_num_rows($res1) > 0)
   	{
   		while (list($kid1,$kkid1,$kmain1,$knazov1,$kmedzera1)=mysqli_fetch_row($res1))
			{
    		if ($kmedzera1 == 0) $cestasql[]=$kid1;
    		$cestakid[$kid][]=$kmain1."|".$kmedzera1."|".$kid1."|".$knazov1;
    		vytvorCestu2($kid1);	
    	}
		} else $cestasql[]=$kid;
  }
  
  function ar_produkty_kategorii($kidd)
  {
    global $link;
    $sql="SELECT `p_kid`,`p_vyrobca` FROM `produkty` WHERE `p_aktualni`='1' AND ".$kidd." ";
    $res=mysqli_query($link, $sql);
  	$x=0; while (list($pkid,$pvyrobca)=mysqli_fetch_row($res)) 
  	{
  		$array[$x]['pkid']=$pkid;
  		$array[$x]['pvyrobca']=$pvyrobca;
  		$x++;
  	}
  	return $array; 
  }
    
  function ar_pid_vid_1kategorie($array,$kid)
	{ 
		$ar = array_filter($array, function ($var) use ($kid) { return ($var['pkid'] == $kid ); });
		return $ar;
	}
  
  function pocet_produktov_kategorie($arpr,$arkt,$kid)
  {
  	global $link;
  	for ($x=0;$x<count($arkt[$kid]);$x++) 
		{  	
  		$p1 = strpos($arkt[$kid][$x],'|',4);
			$kid1 = substr($arkt[$kid][$x],4,$p1-4);
		$num = "";
  		$num += count(ar_pid_vid_1kategorie($arpr,$kid1));
  		
  		for ($y=0;$y<count($arkt[$kid1]);$y++)
  		{
  			$p2 = strpos($arkt[$kid1][$y],'|',4);
				$kid2 = substr($arkt[$kid1][$y],4,$p2-4);
  			$num += count(ar_pid_vid_1kategorie($arpr,$kid2));
  		}
  	}
  	$num += count(ar_pid_vid_1kategorie($arpr,$kid));
   	return $num;
	}
		
	function vyrobcovia_kategorie($arpr,$arkt,$kid)
  {
		global $link;
		for ($x=0;$x<count($arkt[$kid]);$x++) 
		{  	
  		$p1 = strpos($arkt[$kid][$x],'|',4);
			$kid1 = substr($arkt[$kid][$x],4,$p1-4);
  		$ar1[] = ar_pid_vid_1kategorie($arpr,$kid1);
  	
  		for ($y=0;$y<count($arkt[$kid1]);$y++) 
			{  	
  			$p2 = strpos($arkt[$kid1][$y],'|',4);
				$kid2 = substr($arkt[$kid1][$y],4,$p2-4);
  			$ar1[] = ar_pid_vid_1kategorie($arpr,$kid2);
  		}
  	}
		if (count($arkt[$kid]) == 0) $ar2=ar_pid_vid_1kategorie($arpr,$kid); else
		{		
			foreach ($ar1 as $row) { foreach ($row as $row1) { $ar2[]=$row1; }}
		}
			
		$ar2=(array_count_values(array_column($ar2,'pvyrobca')));
		foreach ($ar2 as $key => $val) 
 		{
			echo "<li><a href=\"?kid=".$kid."&amp;vid=".$key."\" >".$key." (".$val."),</a></li>";
		} 
	}
	
	function img($pid,$img)
  {
  	$url_katalog = "./katalog/".$pid;
                
    if (file_exists($url_katalog."/".$img) && $img!=="")
		{
			$size = filesize($url_katalog."/".$img);
			if ($size !== 0) $ar[]=$url_katalog."/".$img;
    }                      
                
    $handle=opendir($url_katalog);
    while ($file=readdir($handle))
  		if (is_file($url_katalog."/".$file) && $file!="index.php" && $file!=$img) $pom[]=$file;
  		if (count($pom)!=0) sort($pom);

		for ($j=0;$j<count($pom);$j++)
  	{
    	if (file_exists($url_katalog."/".$pom[$j]))
			{
				$size = filesize($url_katalog."/".$pom[$j]); 
    		if ($size !== 0) $ar[]=$url_katalog."/".$pom[$j];
    	}
    }
    closedir($handle); 
    
    if (count($ar) == 0) $ar[]="./app/img/noimage.jpg"; 
    
    return $ar;
  }
	
	
	
	
	
	function cesta_kategorie($kid,$aktualni)
  {
    global $link;
    if ($aktualni==0) $str=" AND (`k_aktualni`='1' OR `k_aktualni`='3') "; else $str="";
    $sql="SELECT `k_id`,`k_kid`,`k_main`,`k_nazov`,`k_aktualni`,`k_poradie`,`k_medzera` FROM `kategorie` WHERE `k_kid`='".$kid."' ".$str."  ORDER BY `k_poradie`";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($kid,$kkid,$kmain,$knazov,$kaktualni,$kporadie,$kmedzera)=mysqli_fetch_row($res)) 
  	{
  		$ar[$x]['kid']=$kid;
  		$ar[$x]['kkid']=$kkid;
  		$ar[$x]['kmain']=$kmain;
  		$ar[$x]['knazov']=$knazov;
  		$ar[$x]['kaktualni']=$kaktualni;
  		$ar[$x]['kporadie']=$kporadie;
  		$ar[$x]['kmedzera']=$kmedzera;
  		$x++;
  	}
  	return $ar;
  }
   	
	function array_vyrobca_kid($arraypr,$arraykt,$kid)
  {
		global $link;
		$ar = array_filter($arraykt, function ($var) use ($kid) { return ($var['kkid'] == $kid ); });
  	array_multisort( $ar, SORT_ASC, SORT_NUMERIC, $ar );  	
  	for ($x=0;$x<count($ar);$x++) 
		{  
			$ar1[]=asearchpro($arraypr,$ar[$x]['kid']);
		}
		
		if (count($ar)=="0") $ar2=asearchpro($arraypr,$kid);	 else
		{		
			foreach ($ar1 as $row) { foreach ($row as $row1) { $ar2[]=$row1; }}
		}
			
		$ar2=(array_count_values(array_column($ar2,'pvyrobca')));
		foreach ($ar2 as $key => $val) 
 		{
			echo "<li><a href=\"?kid=".$kid."&amp;vid=".$key."\" >".$key." (".$val."),</a></li>";
		} 
	}
	
	function asearchpro($array,$kid)
	{ 
		$ar = array_filter($array, function ($var) use ($kid) { return ($var['pkid'] == $kid ); });
		return $ar;
	}
	
	function array_kategorie()
  {
    global $link;
    $sql="SELECT `k_id`,`k_kid`,`k_aktualni`,`k_kategoria`,`k_podkategoria`,`k_nazov_sklad`,`k_poradie_sklad`,`k_nazov`,`k_poradie`,`k_vytvorena`,`k_update` FROM `kategorie` ";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($kid,$kkid,$kaktualni,$kkategoria,$kpodkategoria,$knazovsklad,$kporadiesklad,$knazov,$kporadie,$kvytvorena,$kupdate)=mysqli_fetch_row($res)) 
  	{
  		$array[$x]['kid']=$kid;
  		$array[$x]['kkid']=$kkid;
  		$array[$x]['kaktualni']=$kaktualni;
  		$array[$x]['knazov']=$knazov;
  		$array[$x]['kporadie']=$kporadie;
  		$x++;
  	}
  	return $array;
  }
  
	function array_produkty()
  {
    global $link;
    $sql="SELECT `p_id`,`p_kid`,`p_aktualni`,`p_vyrobca`,`p_nazov` FROM `produkty` WHERE `p_aktualni`='1' ";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($pid,$pkid,$paktualni,$pvyrobca,$pnazov)=mysqli_fetch_row($res)) 
  	{
  		$array[$x]['pid']=$pid;
  		$array[$x]['pkid']=$pkid;
  		$array[$x]['paktualni']=$paktualni;
  		$array[$x]['pvyrobca']=$pvyrobca;
  		$array[$x]['pnazov']=$pnazov;
  		$x++;
  	}
  	return $array; 
  }
    
  function produkty_num_kid($arraypr,$arraykt,$kid)
  {
  	global $link;
  	$kkid = array_filter($arraykt, function ($var) use ($kid) { return ($var['kkid'] == $kid ); });
  	array_multisort($kkid,SORT_ASC, SORT_NUMERIC, $kkid );
		for ($y=0;$y<count($kkid);$y++) 
		{  	
		$num = "";
  		$num += count(asearchpro($arraypr,$kkid[$y]['kid']));
  	}
  	$num += count(asearchpro($arraypr,$kid));
   	return $num;
	}
    
  
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ ADMINISTRACIA @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//
  
  //KATEGORIE
  function acesta_kategorie($kid,$aktualni)
  {
    global $link;
    if ($aktualni==0) $str=" AND (`k_aktualni`='1' OR `k_aktualni`='3') "; else $str="";
    $sql="SELECT `k_id`,`k_kid`,`k_main`,`k_nazov`,`k_aktualni`,`k_poradie`,`k_medzera` FROM `kategorie` WHERE `k_kid`='".$kid."' ".$str."  ORDER BY `k_poradie`";
  	$res=mysqli_query($link, $sql);
  	$x=0; while (list($kid,$kkid,$kmain,$knazov,$kaktualni,$kporadie,$kmedzera)=mysqli_fetch_row($res)) 
  	{
  		$ar[$x]['kid']=$kid;
  		$ar[$x]['kkid']=$kkid;
  		$ar[$x]['kmain']=$kmain;
  		$ar[$x]['knazov']=$knazov;
  		$ar[$x]['kaktualni']=$kaktualni;
  		$ar[$x]['kporadie']=$kporadie;
  		$ar[$x]['kmedzera']=$kmedzera;
  		$x++;
  	}
  	return $ar;
  }
  
  //KATEGORIE AKTUALNE
  function akat_aktual($id)
  {
    if ($id == 0 || $id == 2) return "akt"; else return "";
  }
	
	
  
    
?>