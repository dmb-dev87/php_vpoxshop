<?php 
include 'includes/config.php';

$usrid = $_POST['usrid'];


$getus = mysqli_query($dbcon,"select * from users where `username`='$usrid'");
$comrowus  = mysqli_fetch_assoc($getus);
$olbalance = $comrowus['balance'];




print_r(json_encode($olbalance));

?>