 <?php
 session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";
/*
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = $_POST['id'];

?>
<?php
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

 $date = date('d/m/Y h:i:s a');
 // $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$site = $_POST['mailer_host'];
$price = $_POST['price'];
$k = $site;
	  $qq = @mysqli_query($dbcon, "SELECT * FROM mailers") or die("error here");

// Attempt insert query execution
	if(isset($_POST['start']) and $_POST['start'] == "work"){
		 if ($price == 0)
{
	echo "".htmlspecialchars($o)." .. Price not valid! <br>";
} 
      else if (preg_match('/[^0-9]/', $price)) {
				 	
				 		$o = parse_url($k, PHP_URL_HOST);

	echo "".htmlspecialchars($o)." .. <b>Price not valid!</b> <br>";
} else {
		$hosting=file_get_contents($k);
		 $match = preg_match('#Reciver Email#', $hosting);
			 if($match == '1') { 
			
$mailer_url = 'url';
$check="SELECT * FROM mailers WHERE $mailer_url='$k' and sold='0'";
$rs = mysqli_query($dbcon, $check);
$data = mysqli_num_rows($rs);
if($data != 0) {
/* while($row = mysqli_fetch_assoc($qq)){
     $st = $row['url'];
	 			$o = parse_url($k, PHP_URL_HOST);

  			 if (preg_match("#$o#", $st)) { 
			 } 
    }*/

    echo "".htmlspecialchars($k)." .. Already Added !<br/>";
} else {
	
    	 			$o = parse_url($k, PHP_URL_HOST);
		$oip = gethostbyname($o);
	
		$iptohosting = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$oip&fields=isp";
		$creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '"isp":"','"}');
	$hostingdetect = ambilkata($hosting,'</span></td><td>:<nobr>','<a href="http://www.google.com');
			$o = parse_url($k, PHP_URL_HOST);
$iptolocation = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
$creatorlocation = file_get_contents($iptolocation);
$country = ambilkata($creatorlocation,'{"country_name":"','"}');
$sql = mysqli_query($dbcon,"INSERT INTO mailers(acctype,country,infos,url,price,resseller,sold,date,dateofsold,reported,sto,city,hosting,price_show,dateof_sold,access,windows,ram,domain)VALUES('mailer','$country','$hostingg','$k','$price','$uid','0','$date','0','0','0','0','$hostingg','$price','$date','0','0','0','0')")or die (mysqli_error($dbcon));

 
	  echo "".htmlspecialchars($k)." .. [Added]<br>";
			  } } else { 
		$o = parse_url($k, PHP_URL_HOST);
  echo"".htmlspecialchars($k)." .. <b>Not Working !</b><br>";
				
			 }
	} } }
?>