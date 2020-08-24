<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);


ini_set("include_path", '/home/vpoxadmin/php:' . ini_get("include_path") );





include('Mail.php'); //this loads up PEAR Mail


//vpoxru@gmail.com




 $to      = "sachin@globalhunttechnologies.in";
    $from    = "webmaster@artmarketeer.com"; // the email address
    $subject = "hiii";
    $body    = "Email contents here";

    $host    = "mail.artmarketeer.com";
    $port    =  "587";
    $user    = "webmaster@artmarketeer.com";
    $pass    = "j44[(hUTp(yS";
	
	$content = "text/html; charset=utf-8";
	$mime = "1.0";
	
    $headers = array("From"=> $from, "To"=>$to, "Subject"=>$subject,'MIME-Version' => $mime,'Content-type' => $content);
    $smtp    = @Mail::factory("smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
    $mail    = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)){
        echo "error: {$mail->getMessage()}";
    } else {
        echo "Message sent";
    }




?>