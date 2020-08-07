<?php 
include 'includes/config.php';

$usrid = $_POST['usrid'];
$p_data = $_POST['p_data'];

  $s1 = mysqli_query($dbcon, "SELECT * FROM `payment` WHERE `user`='$usrid' AND `p_data`='$p_data'");
  $r1 = mysqli_num_rows($s1);
  $res=mysqli_fetch_assoc($s1);
  $amountPay=$res['amountusd'];
  $state=$res['state'];
  
  
  
  if($state == 'complete'){
	  
	  $staus = 'Paid';
  }else{
	   $staus = 'Not Paid';
  }
  print_r(json_encode($staus));


?>