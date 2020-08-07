<?php

$blockchain_root = "https://blockchain.info/";
$blockchain_receive_root = "https://api.blockchain.info/";
//$mysite_root = "http://localhost/Bitcoin/php/callback.php";
$mysite_root = BASEURL."bitcoin/callback.php";

define('BASEURL','https://vpox.to/vpox/');

$secret = "ZzsMLGKe162CfA5EcG6j";
$my_xpub = "xpub6DVcHXwt45JBxDdKeCePuohUZJxEXkwypktVrZHTturmaAbK4PKJmQd1QJEYiocGoSza2gXc8oENnCQzxZNTNMQDFkhXDCgiXhEuGqgM7zi";
$my_api_key = "97a8535a-7538-4470-8aa6-c318bb8b8f5e";









//Database
$mysql_host = 'localhost';
$mysql_username = 'vpoxadmi_sh0p';$mysql_password = 'okcDO)xwrJs0';$mysql_database = 'vpoxadmi_new';
//$mysql_username = 'root';$mysql_password = '';$mysql_database = 'vpox';

$con = mysqli_connect("localhost","vpoxadmi_sh0p","okcDO)xwrJs0","vpoxadmi_new");
//$con = mysqli_connect("localhost","root","","vpox");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


?>
