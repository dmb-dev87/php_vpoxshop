<?php

error_reporting(0);
session_start();
date_default_timezone_set('GMT');

include "../includes/config.php";
$cid =  $_POST['countd'];
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
 $('.<?php echo $cid; ?>').hide();
 var getDataValue =  window.setInterval(function(){
	
	 $('.loader_data').hide()
	 window.clearInterval(getDataValue);
	  $('.<?php echo $cid; ?>').show();
	  },3000);
	/*setInterval(function(){
		$('.addeda').hide();
						$('.loader_data').hide();
							},1000);*/
							
	
	</script>
<?php
$typesmtp=$_POST['typesmtp'];
$arr=array('ionos','strato','tonline','rackspace','godaddy','office365');
if(!in_array($typesmtp,$arr))
{
	$typesmtp='';	
}
else
{
	$wherecond=" AND typesmtp='$typesmtp'";
}

function ambilKata($param, $kata1, $kata2){

    if(strpos($param, $kata1) === FALSE) return FALSE;

    if(strpos($param, $kata2) === FALSE) return FALSE;

    $start = strpos($param, $kata1) + strlen($kata1);

    $end = strpos($param, $kata2, $start);

    $return = substr($param, $start, $end - $start);

    return $return;

}
	$uid = $_REQUEST['oid'];
    $date = date("d/m/Y h:i:s a");
    $k = $_POST['smtp'];
    $price = $_POST['price'];
    $i = $_POST['countd']+1;
    $Total_lines = $_POST['total'];
 
	 	$d = explode("|", $k);

		$hosts = $d[0]; 
		$host =  trim($hosts," ");
		$ports = $d[1]; 
		$port =  trim($ports," ");
		$login = $d[2]; 

		$pass = $d[3]; 
		if($pass == ""){
			$pass = '123456';
		}else{
			$pass = $pass;
		}
		
	 $link = $host.'|'.$login.'|'.$pass.'|'.$port;
/*	$socks  = "http://localhost/vpox/checkp.php?host=$host&port=$port";
	$socks2 = file_get_contents($socks);
	print_r($socks2);
	exit;*/
	$f = fsockopen($host,$port) ;
if ($f !== false) {
    $res = fread($f, 1024) ;
    if (strlen($res) > 0 && strpos($res, '220') === 0) {
        $datas =  "Success!" ;
    }
    else {
        $datas =  "Error!" ;
    }
}
fclose($f);
	//print_r($datas);
	if ($datas == 'Success!') {
			 if ($price == 0)
{
	echo "[$i/$Total_lines]....".htmlspecialchars($k)." ...... <b>Price is not valid!</b> <br>";

	    ob_flush();

    flush();
} 
      else if (preg_match('/[^0-9]/', $price)) {


	echo "[$i/$Total_lines]....<b>".htmlspecialchars($host)."</b> ...... <b>Price is not valid!</b> <br>";

	    ob_flush();

    flush();

} else {
		$check="SELECT * FROM dsmtps WHERE url = '$link' and sold='1'";

$rs = mysqli_query($dbcon,$check);

$data = mysqli_num_rows($rs);

if($data != "") {



    //echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <b>Already Added !</b><br>";
 echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'>Already Added !</b><br/>";
	    ob_flush();

    flush();

} else {
	$check="SELECT * FROM dsmtps WHERE url = '$link' and sold='0'";

$rs = mysqli_query($dbcon,$check);

$data = mysqli_num_rows($rs);

if($data != "") {



     echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'>Already Added !</b><br/>";

	    ob_flush();

    flush();

} else {

if (preg_match('/http/', $host)) {
$host = parse_url($host, PHP_URL_HOST);
} 
$sitetoip = "http://api.ipstack.com/$host?access_key=d98bf491ddee57fea842272027e1144b&fields=ip";
		$creatorip = file_get_contents($sitetoip);
		$ipsss = ambilkata($creatorip, '{"ip":"','"}');
$iptohosting = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipsss&fields=isp";
		$creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '"isp":"','"}');
$iptocountry = "http://api.ipstack.com/$host?access_key=d98bf491ddee57fea842272027e1144b&fields=country_name";
		$creatorcountry = file_get_contents($iptocountry);
		$countryy = ambilkata($creatorcountry, '{"country_name":"','"}');
if($hostingg){
	$so = "INSERT INTO dsmtps(acctype,country,infos,price,url,sold,sto,dateofsold,resseller,reported,city,hosting,price_show,dateof_sold,access,windows,ram,domain,date,typesmtp)
	
	VALUES('smtp','$countryy','$hostingg','$price','$link','0','0','$date','$uid','0','0','$hostingg','$price','$date','0','0','0','0','$date','$typesmtp')";

		  if(mysqli_query($dbcon, $so)){

 // echo "[$i/$Total_lines]....$host .. <font color=green>[Added] </font><br>";
 echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'><font color=green>[Added] </font></b><br/>";
      ob_flush();

    flush();

			 }else{
				 //echo"[$i/$Total_lines]....".htmlspecialchars($host)." .. <b>Not Working !</b><br>";
				  echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'>Not Working !</font></b><br/>";
				  ob_flush();

    flush();
			 } 
}else{
	//echo"[$i/$Total_lines]....".htmlspecialchars($host)." .. <b>Not Working !</b><br>";
	echo "[$i/$Total_lines]....".htmlspecialchars($host)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'>Not Working !</font></b><br/>";
				  ob_flush();

    flush();
}

}
	
}
		
}	
		

	}else{
		
		
		//echo "[$i/$Total_lines]....".htmlspecialchars($host)." ...... <b>Port Not Connecting With Host!</b> <br>";
		echo "[$i/$Total_lines]....".htmlspecialchars($k)." .. <img src='../loding2.gif' style='width:30px;position:relative;top:5px;' class='loader_data'/><b class='".$cid."' style='display:none'>Port Not Connecting With Host !</font></b><br/>";

	    ob_flush();

    flush();
	}
sleep(3);


?>