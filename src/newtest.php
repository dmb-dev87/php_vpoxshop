	<?php
ini_set("include_path", '/home/vpoxadmin/php:' . ini_get("include_path") );
require_once "Mail.php";


$host = "mail.artmarketeer.com";
$port = 587;
$username = "webmaster@artmarketeer.com";
$password = "j44[(hUTp(yS";


$from = "website <webmaster@artmarketeer.com>";
$to = "Me <sachin@globalhunttechnologies.in>";


$subject = "Hi!";
$body = "Hi,\n\n Test from my website";


$headers = array ('From' => $from,
'To' => $to,
'Subject' => $subject);
$smtp = Mail::factory('smtp',
array ('host' => $host,
'port' => $port,
'auth' => true,
'username' => $username,
'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
}
else {
          echo("<p>Message successfully sent!</p>");
}

?>