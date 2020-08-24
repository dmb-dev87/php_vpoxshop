<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

$ip = "127.0.0.1";
$cp_user = "dmotjbaj";
$cp_pwd = "Pyqr?7h$1_dh";
$url = "https://lazyman-music.com:2083/login";

// Create new curl handle
$ch=curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$cp_user&pass=$cp_pwd");
curl_setopt($ch, CURLOPT_TIMEOUT, 100020);

// Execute the curl handle and fetch info then close streams.
$f = curl_exec($ch);
$h = curl_getinfo($ch);
curl_close($ch);

print_r($h);
 
 
if  (in_array  ('curl', get_loaded_extensions())) {
 
        echo "CURL is available on your web server";
 
    }  else {
        echo "CURL is not available on your web server";
    }
	
	
	
	
?>