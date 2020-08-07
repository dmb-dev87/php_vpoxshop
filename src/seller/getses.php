<?php
session_start();
$cp12 = $_POST["cpanel_host"];
$logine = $_POST["cpanel_login"];
$passee = $_POST["cpanel_pass"];

$ch=curl_init($cp12);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HEADER,array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$logine&pass=$passee");
curl_setopt($ch, CURLOPT_TIMEOUT, 100020);

// Execute the curl handle and fetch info then close streams.
$f = curl_exec($ch);
$h = curl_getinfo($ch);
curl_close($ch);
$code = $h['http_code'];
/*
if ($code == '200') {
     echo 'CP Work';
} else {	
	echo 'Bad CP'; 
}*/

$_SESSION['code'] = $code;

?>