<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$method = mysqli_real_escape_string($dbcon, $_POST['methodpay']);
$amount = mysqli_real_escape_string($dbcon, htmlspecialchars($_POST['amount']));
if($_POST['methodpay']=="BitcoinPayment"){
	if ($amount < 5) {
		echo "01";
	} else {

$old = mysqli_query($dbcon,"select * from users where username='$uid'");
$row = mysqli_fetch_array($old);

$oldbal = $row['balance'];
$afbal = $row['balance']+$amount;

$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
$btcamount = number_format($amount/$rate, 8, '.', '');
$btcamm = $btcamount;
$guid = 'simoelbattioui@gmail.com';  // Block.io account
$main_password = 'lmao*123'; // Block.io Password
$pin = 'lmao1234'; // Block.io PIN
$apikey = "bfcf-b67a-336f-1b71"; // block.io API KEY
$uidz = "".$uid."-".time()."";
//echo "http://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz";
///die();
///$ao = file_get_contents("http://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
///$zz = json_decode($ao);
///$btcadrs = $zz->data->address;
$btcadrs="Test Addd";
$random = substr(md5(mt_rand()), 0, 60);
$date = date('Y/m/d h:i:s');
$sql2 = "INSERT INTO payment(user,method,amount,amountusd,address,p_data,state,date,bitaddress,btcam,old_bal,af_bal) VALUES('$uid','Bitcoin','$btcamm','$amount','$btcadrs','$random','pending','$date','0','0','$oldbal','$afbal')";
mysqli_query($dbcon, $sql2) or die("error");
  $info=array('random'=>$random,'methodpay'=>'BitcoinPayment');
  echo json_encode($info); 

}

} else {
if($_POST['methodpay']=="PerfectMoneyPayment"){
		if ($amount < 5) {
		echo "01";
	} else {
$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
$btcamount = number_format($amount/$rate, 8, '.', '');
$btcamm = $btcamount;
$guid = 'simoelbattioui@gmail.com';  // Block.io account
$main_password = 'lmao*123'; // Block.io Password
$pin = 'lmao1234'; // Block.io PIN
$apikey = "bfcf-b67a-336f-1b71"; // block.io API KEY
$uidz = "".$uid."-".time()."";
///$ao = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
///$zz = json_decode($ao);
///$btcadrs = $zz->data->address;
$btcadrs='';
$random = substr(md5(mt_rand()), 0, 60);
$date = date('Y/m/d h:i:s');
$sql2 = "INSERT INTO payment(user,method,amount,amountusd,address,p_data,state,date,bitaddress,btcam,old_bal,af_bal) VALUES('$uid','PerfectMoney','$amount','$amount','$btcadrs','$random','pending','$date','0','0','0','0')";
////mysqli_query($dbcon, $sql2);
mysqli_query($dbcon, $sql2) or die("error");
$info=array('random'=>$random,'methodpay'=>'PerfectMoneyPayment');
echo json_encode($info);
}  }
if($_POST['methodpay']=="CoinPayment"){
		if ($amount < 1) {
		echo "01";
	} else {
$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
$btcamount = number_format($amount/$rate, 8, '.', '');
$btcamm = $btcamount;
$guid = 'simoelbattioui@gmail.com';  // Block.io account
$main_password = 'lmao*123'; // Block.io Password
$pin = 'lmao1234'; // Block.io PIN
$apikey = "bfcf-b67a-336f-1b71"; // block.io API KEY
$uidz = "".$uid."-".time()."";
///$ao = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
///$zz = json_decode($ao);
///$btcadrs = $zz->data->address;
$btcadrs='';
$random = substr(md5(mt_rand()), 0, 60);
$date = date('Y/m/d h:i:s');
$sql2 = "INSERT INTO payment(user,method,amount,amountusd,address,p_data,state,date,bitaddress,btcam,old_bal,af_bal) VALUES('$uid','CoinPayment','$amount','$amount','$btcadrs','$random','pending','$date','0','0','0','0')";
////mysqli_query($dbcon, $sql2);
mysqli_query($dbcon, $sql2) or die("error");
$info=array('random'=>$random,'methodpay'=>'CoinPayment');
echo json_encode($info);
}  }
else { header("location: index.html"); }}
?>