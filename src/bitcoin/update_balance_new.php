<?php 
include '../includes/config.php';

$p_data = $_POST['pdata'];
$usrid = $_POST['udata'];
$btcpr = $_POST['btcpr'];

$getpa = mysqli_query($dbcon,"select * from payment where `user`='$usrid' AND p_data='$p_data'");
$comrow  = mysqli_fetch_assoc($getpa);
$balance = $comrow['af_bal'];






$s1 = mysqli_query($dbcon, "UPDATE `payment` SET `state` = 'complete',`btcam`='$btcpr'  WHERE `user`='$usrid' AND p_data='$p_data'"); 




$ssd = mysqli_query($dbcon, "UPDATE `users` SET `balance` = '$balance' WHERE `username`='$usrid'"); 
print_r(json_encode($ssd));

?>