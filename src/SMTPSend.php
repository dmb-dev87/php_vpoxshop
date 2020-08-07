<?php

// use PHPMailer\PHPMailer\PHPMailer;
// require 'vendor/autoload.php';

// $host = $_GET["host"];
// $logine = $_GET["login"];
// $passee = $_GET["pass"];
// $port = $_GET["port"];
// $id = $_GET["id"];
// $testmail = $_GET["testmail"];

// $mail = new PHPMailer;
// $mail->isSMTP();
// $mail->SMTPDebug = 4;
// $mail->Host = $host;
// $mail->Port =25 ;
// $mail->SMTPAuth = false;
// $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
// $mail->Username = $logine;
// $mail->Password = $passee;
// $mail->setFrom($logine, "J e r u x");

// $mail->SMTPOptions = array(
//     'ssl' => array(
//     'verify_peer' => false,
//     'verify_peer_name' => false,
//     'allow_self_signed' => true
// ));

// $mail->addAddress("$testmail");
// $mail->Subject = "SMTP $id test";
// $mail->Body = "SMTP $id IS WORKING!";

// if (!$mail->send()) {
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message sent!';
// }


// require_once "lib/Mail.php";

// $host = $_GET["host"];
// $logine = $_GET["login"]; 
// $passee = $_GET["pass"]; 
// $port = $_GET["port"]; 
// $id = $_GET["id"]; 
// $testmail = $_GET["testmail"];

// $_mailbox        =   Mail::factory('smtp', array(
//   'host'         => $host,
//   'auth'         =>  FALSE,
//   'port'         =>  $port,
//   'username'     => $logine,
//   'password'     => $passee));

// // print_r($_mailbox);  
// // exit;
  

// // $_boundary       =   sha1(date('r'));

// $_headers        =   array(
//   'From'         => "Baji $logine",
//   'To'           => $testmail,
//   'Subject'      => 'consuming too much pear',
//   'Content-Type' => 'text/html; charset=utf-8',
//   'MIME-Version' => '1.0'    );

// $_eml_body       ="Test Email!";

// $_to_eml  =  $_headers['To'];

// $_mail    =  $_mailbox->send( $_to_eml, $_headers, $_eml_body );

// print_r($_mailbox);
// exit;


// if    (PEAR::isError($_mail)) {
//   echo date( " Y-m-d H:i:s  ->  " ) . "email to {$_to_eml} failed, details : " . $_mail->getMessage() . "\n\n";
// }
// else  {
//   echo date( " Y-m-d H:i:s  ->  " ) . "email sent to {$_to_eml} !\n\n";
// }

require_once "lib/ProxySMTP.php";

$host = $_GET["host"];
$logine = $_GET["login"]; 
$passee = $_GET["pass"]; 
$port = $_GET["port"]; 
$id = $_GET["id"]; 
$testmail = $_GET["testmail"];

$SMTP=new ProxySMTP;
$SMTP->proxyHost="http://185.158.105.177/";
$SMTP->proxyPort="55555";
$SMTP->proxyUsername="78956467";
$SMTP->proxyPassword= "hq5635gh";
$SMTP->smtpHost=$host;//smtp server domain name
$SMTP->smtpPort=$port;//smtp server port
$SMTP->smtpUsername=$logine;//Fill in the mailbox
$SMTP->smtpPassword=$passee; // fill in the authorization code inside is not qq password
$SMTP->title='test title';
$SMTP->content='test content';
$SMTP->from="Baji $logine";//The sender is the same as the account number
$SMTP->to=$testmail;//Recipient
$return=$SMTP->send();
echo $return['msg'];
?>