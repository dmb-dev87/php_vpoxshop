<?php

//Proxy to the api/receive method in order to not reveal the callback URL

include 'include.php';

 //$callbacku = 'http://localhost/Bitcoin/php/callback.php?invoice_id=058921123';
 $callbacku = BASEURL.'bitcoin/callback.php?invoice_id=058921123';
$db = new mysqli($mysql_host, $mysql_username, $mysql_password) or die(__LINE__ . ' Invalid connect: ' . mysqli_error());
$db->select_db($mysql_database) or die( "Unable to select database. Run setup first.");

$invoice_id = $_GET['invoice_id'];
$callback_url = $mysite_root . "callback.php?invoice_id=" . $invoice_id . "&secret=" . $secret;
$callback_url = BASEURL . "callback.php?invoice_id=" . $invoice_id . "&secret=" . $secret;
$btcrequesturlhere="https://api.blockchain.info/v2/receive?xpub=xpub6DVcHXwt45JBxDdKeCePuohUZJxEXkwypktVrZHTturmaAbK4PKJmQd1QJEYiocGoSza2gXc8oENnCQzxZNTNMQDFkhXDCgiXhEuGqgM7zi&callback=".urlencode($callback_url);
echo $btcrequesturlhere; exit;
$resp = file_get_contents($btcrequesturlhere);
$response = json_decode($resp);

 
 $adress = $response->address;
$qur = mysqli_query($con,"update payment set bitaddress='$adress' where p_data='$invoice_id'");
 
//Add the invoice to the database
/*$stmt = $db->prepare("UPDATE payment SET bitaddress = ? WHERE p_data = ?");
$stmt->bind_param("si", $response->address, $invoice_id);
$result = $stmt->execute();

if (!$result) {
    die(__LINE__ . ' Invalid query: ' . mysqli_error($db));
}*/

print json_encode(array('input_address' => $response->address ));


?>