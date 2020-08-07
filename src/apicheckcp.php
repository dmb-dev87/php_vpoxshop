<?php
session_start();
 $cp12 = $_GET["cp12"];
 $logine = $_GET["login"];
 $passee = rawurldecode($_GET["pass"]);

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

if ($code == '200') {
     echo 'CP Work';
} else {	
	echo 'Bad CP'; 
}
 


/*$ch = curl_init("$cp12");
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in second
curl_setopt($ch, CURLOPT_POSTFIELDS,
array('user'=>"$logine",'pass'=>"$passee"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$postResult = curl_exec($ch);

curl_close($ch);
print_r($postResult);
if (preg_match('#CONTENT="2;URL=/cpsess#',$postResult)) {
    echo 'CP Work';
} else {	
	echo 'Bad CP'; 
}*/
/*
$cp12 = 'https://'.$_GET["cp12"].':2083/login';
$logine = $_GET["login"];
$passee = rawurldecode($_GET["pass"]);
$ch = curl_init("$cp12");
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in second
curl_setopt($ch, CURLOPT_POSTFIELDS,
array('user'=>"$logine",'pass'=>"$passee"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$postResult = curl_exec($ch);
curl_close($ch);
if (preg_match('#CONTENT="2;URL=/cpsess#',$postResult)) {
    echo '<br>CP Work';
} else {	
	echo 'Bad CP'; 
}
*/
?>