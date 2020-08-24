<?php
//error_reporting(0);
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";
/*
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/  
$uid = $_REQUEST['oid'];
preg_match_all("/(\n)/", $_POST['text'], $matches);
    $total_lines = count($matches[0]) + 1;
	if ($total_lines > 30) { echo "limit reached"; } else {
function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
$ramstorage = $_POST['ram'];

  $host = mysqli_real_escape_string($dbcon, $_POST['rdp_host']);
  
   $date = date("d/m/Y h:i:s a");
 
   $site = explode("\n", $_POST['rdp_host']);
$Total_lines = count($site); 
$i = 1;
foreach ($site as $k) {
	 $k = @trim($k);
	 
	 	$d = explode("|", $k);
		$ipu = $d[0]; 
		$user = $d[1]; 
		$pass = $d[2]; 
		$accessd = $d[3]; 
		if($accessd == 'User' || $accessd == 'USER' || $accessd == 'user'){
			$access = 'USER';
		}else{
			$access = 'ADMIN';
		}
		$windows1l = $d[4]; 
		
		$windows = preg_replace("/[^0-9]/", '', $windows1l);		
		
		$ram = $d[5];
		
			
	
		/*$rames =  preg_replace("/[^0-9]/", '', $ramd);		
		$ram = $rames.' '.$ramstorage;*/
		$price = $d[6]; 
	 
	 
	 $link = $ipu.'|'.$user.'|'.$pass;
	
	 
	 
 $already = mysqli_query($dbcon, "SELECT * FROM rdps") or die("error here");
	 if(isset($_POST['start']) and $_POST['start'] == "work"){
	if(preg_match('(GB|MB|TB)', $ram) !== 1) { 
		echo "[$i]....<b>".htmlspecialchars($ipu)."</b> ...... <b>Ram is not valid!</b> <br>";
		}else{
	if ($price == 0){
	echo "[$i]....<b>".htmlspecialchars($ipu)."</b> ...... <b>Price is not valid!</b> <br>";
	  ob_flush();
    flush();	
} 
      else if (preg_match('/[^0-9]/', $price)) {
	echo "[$i]....<b>".htmlspecialchars($ipu)."</b> ...... <b>Price is not valid!</b> <br>";
	      ob_flush();
    flush();
}else{
	$check="SELECT * FROM rdps WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_num_rows($rs);
if($data != ""){
	
	
	echo "[$i]....".htmlspecialchars($ipu)." .. <b>Already Added !</b><br/>";
	      ob_flush();
    flush();
}else{
	
	$iptohosting = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipu&fields=isp";
	$creatorhosting = file_get_contents($iptohosting);
		//echo $creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '"isp":"','"}');
$iptocountry = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipu&fields=country_name";
		$creatorcountry = file_get_contents($iptocountry);
		$countryy = ambilkata($creatorcountry, '"country_name":"','"}');
$iptocity = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipu&fields=city";
		$creatorcity = file_get_contents($iptocity);
		$cityy = ambilkata($creatorcity, '"city":"','"}');
		
		$state_prov = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipu&fields=state_prov";
		$state_provs = file_get_contents($state_prov);
		$state = ambilkata($state_provs, '"state_prov":"','"}');
		if(empty($hostingg)){
			echo "Seems not working !";
		} else {
    $query = mysqli_query($dbcon, "INSERT INTO rdps(acctype,country,city,hosting,price,url,sold,sto,dateofsold,access,windows,ram,resseller,reported,infos,domain,price_show,dateof_sold,date,state)VALUES('rdp','$countryy','$cityy','$hostingg','$price','$link','0','0','$date','$access','$windows','$ram','$uid','0','$link','0','$price','$date','$date','$state')")or die(mysqli_error($dbcon));

  if($query){
echo "<b>Succefully Added</b> .. (".htmlspecialchars($k).") with ".htmlspecialchars($login)."/".htmlspecialchars($pass)."<br>";
  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
  } }
	
}
	$i++;
}
}
}
}
}
?>