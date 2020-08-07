<?php
/*use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$host = $_GET["host"];
$logine = $_GET["login"];
$passee = $_GET["pass"];
$port = $_GET["port"];
$id = $_GET["id"];
$testmail = $_GET["testmail"];

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = "$host";
$mail->Port = $port;
$mail->SMTPAuth = true;
$mail->Username = "$logine";
$mail->Password = "$passee";
$mail->setFrom("$logine", "J e r u x");
$mail->addAddress("$testmail");
$mail->Subject = "SMTP $id test";
$mail->Body = "SMTP $id IS WORKING!";
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}*/
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
echo ini_get("include_path");
ini_set("include_path", '/home/vpoxadmin/php:' . ini_get("include_path") ); 
include('Mail.php');
 $host = $_GET["host"];
 $logine = $_GET["login"]; 
 $passee = $_GET["pass"]; 
 $port = $_GET["port"]; 
 $id = $_GET["id"]; 
 $testmail = $_GET["testmail"];
 $to      = $testmail;
 $from    = $logine; 
 $subject = "SMTP $id test";  
 $body    = "SMTP $id IS WORKING!";   
 $host    = $host;  
 $port    = $port;
 $user    = $logine;  
 $pass    = $passee; 
 $headers = array("From"=> $from, "To"=>$to, "Subject"=>$subject);   
 $smtp    = @Mail::factory("smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));  
 $mail    = $smtp->send($to, $headers, $body);  
 if (PEAR::isError($mail)){   
 echo "error: {$mail->getMessage()}"; 
 } else {       
 echo "Message sent"; 
 }
 ?>
