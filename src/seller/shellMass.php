
<?php
//error_reporting(0);
session_start();

date_default_timezone_set('GMT');
include "../includes/config.php";

/*if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/
//$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
 $uid = $_REQUEST['userid'];

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
function curl_get_contents($url)
{
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($curl);
  curl_close($curl);
  return $data;
}

 $date = date('Y/m/d h:i:s');
  //$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$site = explode("\n", $_POST['inputs']);
$price = $_POST['price'];
$Total_lines = count($site); 

	$i = 0;

	if(isset($_POST['start']) and $_POST['start'] == "work"){
$head = "<b>Number : $Total_lines || Price : $price </b><br>";
echo $head;
echo "<br/>";
foreach ($site as $k) {
    $k = @trim($k);
	$i++;
/* Attempt MySQL server dbconection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

  $qq = @mysqli_query($dbcon, "SELECT * FROM stufs") or die("error here");

// Attempt insert query execution
			 if ($price == 0)
{
	echo "[$i/$Total_lines]....".htmlspecialchars($k)." ...... <b>Price is not valid!</b> <br>";
	    ob_flush();
    flush();
} 
      else if (preg_match('/[^0-9]/', $price)) {
				 			$o = parse_url($k, PHP_URL_HOST);

	echo "[$i/$Total_lines]....<b>".htmlspecialchars($k)."</b> ...... <b>Price is not valid!</b> <br>";
	    ob_flush();
    flush();
} else {
		$hosting=file_get_contents($k);
		
		$hos = explode('nobr',$hosting);
		$server = $hos[1];
			 $repls = str_replace('>','',$server);
			 $repls2 = str_replace('</','',$repls);
			 
			 $os = explode(' ',$repls2);
			 $sysos = $os[0];
			
			$match = preg_match('#Client IP:#', $hosting);
		
			if ($match == '1') {
			 				 			$o = parse_url($k, PHP_URL_HOST);
$check="SELECT * FROM stufs WHERE domain = '$o' and sold='1'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_num_rows($rs);
if($data != "") {

    echo "[$i/$Total_lines]....".htmlspecialchars($k)." .. <b>Already Added !</b><br>";
	    ob_flush();
    flush();
} else {
	$o = parse_url($k, PHP_URL_HOST);
	$check="SELECT * FROM stufs WHERE domain = '$o' and sold='0'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_num_rows($rs);
if($data != "") {

    echo "[$i/$Total_lines]....".htmlspecialchars($k)." .. <b>Already Added !</b><br>";
	    ob_flush();
    flush();
} else {
 
		 		/*	$o = parse_url($k, PHP_URL_HOST);
	$hostingdetect = ambilkata($hosting,'Cwd:</span></td><td><nobr>','</nobr><br>');
			$o = parse_url($k, PHP_URL_HOST);
$iptolocation = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
$creatorlocation = file_get_contents($iptolocation);
$country = ambilkata($creatorlocation,'{"country_name":"','"}');*/

 $o   = parse_url($k, PHP_URL_HOST);
                        $oip = gethostbyname($o);
                        
                        $iptohosting     = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$oip&fields=isp";
                        $creatorhosting  = file_get_contents($iptohosting);
						 
                        $hostingg        = ambilkata($creatorhosting, '"isp":"', '"}');
                        $hostingdetect   = ambilkata($hosting, '</span></td><td>:<nobr>', '<a href="http://www.google.com');
                        $o               = parse_url($k, PHP_URL_HOST);
                        $iptolocation    = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
                        $creatorlocation = file_get_contents($iptolocation);
                        $country         = ambilkata($creatorlocation, '{"country_name":"', '"}');

//$sql = "INSERT INTO stufs(acctype,country,infos,url,price,resseller,sold,date,dateofsold,reported,sto,domain)VALUES('shell','$country','$hostingdetect','$k','$price','$uid','0','$date',null,'','','$o')" or mysqli_error($dbcon);
$sql = "INSERT INTO stufs(acctype,country,infos,url,price,resseller,sold,date,dateofsold,reported,sto,domain,city,hosting,price_show,dateof_sold,access,windows,ram,server_info)VALUES('shell','$country','$hostingg','$k','$price','$uid','0','$date','$date','0','0','$o','0','$hostingg','$price','0','0','$sysos','0','$repls2')";

  //echo $sql;
  if(mysqli_query($dbcon, $sql)){
  echo "[$i/$Total_lines]....$k .. <font color=green>[Added] - $o</font><br>";
      ob_flush();
    flush();
			 } } } } else { 
		$o = parse_url($k, PHP_URL_HOST);
		
  echo"[$i/$Total_lines]....".htmlspecialchars($k)." .. <b>Not Working !</b><br>";
    ob_flush();
    flush();
  } 
	} }
	$i++;
	
	} 
	}
?>