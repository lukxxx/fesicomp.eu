<?php 
define("ATC_MENO","FEDORCAK");
define("ATC_HESLO","fesi7812");

define("ROOT", __DIR__ ."/");


$db_host = "localhost";
$db_name = "compsnv_sk2";
$db_user = "compsnv";
$db_pass = "Kajauhroba#2021";


// Create a connection to the MySQL database using PDO
$pdo = $pdo = new PDO("mysql:host=db003.nameserver.sk;dbname=compsnv_sk2", "compsnv_sk2", "iQ8sh2lz");

$hostname = "localhost";
$user = "compsnv";
$pass = "Kajauhroba#2021";
$db_name = "compsnv_sk2";
$link = mysqli_connect("db003.nameserver.sk", "compsnv_sk2", "iQ8sh2lz", "compsnv_sk2");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

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
function getmicrotime() { list($usec,$sec)=explode(" ",microtime()); return ((float)$usec+(float)$sec); }
function ToPHPDate($d) { return substr($d,6,2).'.'.substr($d,4,2).'.'.substr($d,0,4).' '.substr($d,8,2).':'.substr($d,10,2); }

?>

