<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

?>

<?php

$cvl = $_POST['cvl'];
if($cvl != ""){
	$country = '<option value="">All</option>';
	$state = '<option value="">All</option>';
	$windows = '<option value="">All</option>';
	$access = '<option value="">All</option>';
	$hosting = '<option value="">All</option>';
	$seller = '<option value="">All</option>';
	 
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$country .= '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`state`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY state ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$state .= '<option value="'.$row['state'].'">'.$row['state'].'</option>';
	}
	
		$query = mysqli_query($dbcon, "SELECT DISTINCT(`windows`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY windows ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$windows .= '<option value="'.$row['windows'].'">'.$row['windows'].'</option>';
	}
	
		$query = mysqli_query($dbcon, "SELECT DISTINCT(`access`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY access ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$access .= '<option value="'.$row['access'].'">'.$row['access'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$hosting .= '<option value="'.$row['hosting'].'">'.$row['hosting'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `rdps` WHERE `sold` = '0' AND city='$cvl' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	$seller.= '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
	
	print_r(json_encode(array("country"=>$country,"state"=>$state,"windows"=>$windows,"access"=>$access,"hosting"=>$hosting,"seller"=>$seller)));
}else{
	$country = '<option value="">All</option>';
	$state = '<option value="">All</option>';
	$windows = '<option value="">All</option>';
	$access = '<option value="">All</option>';
	$hosting = '<option value="">All</option>';
	$seller = '<option value="">All</option>';
	 
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `rdps` WHERE `sold` = '0'  ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$country .= '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`state`) FROM `rdps` WHERE `sold` = '0' ORDER BY state ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$state .= '<option value="'.$row['city'].'">'.$row['city'].'</option>';
	}
	
		$query = mysqli_query($dbcon, "SELECT DISTINCT(`windows`) FROM `rdps` WHERE `sold` = '0'  ORDER BY windows ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$windows .= '<option value="'.$row['windows'].'">'.$row['windows'].'</option>';
	}
	
		$query = mysqli_query($dbcon, "SELECT DISTINCT(`access`) FROM `rdps` WHERE `sold` = '0'  ORDER BY access ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$access .= '<option value="'.$row['access'].'">'.$row['access'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `rdps` WHERE `sold` = '0'  ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		
	$hosting .= '<option value="'.$row['hosting'].'">'.$row['hosting'].'</option>';
	}
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `rdps` WHERE `sold` = '0'  ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	$seller.= '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
	print_r(json_encode(array("country"=>$country,"state"=>$state,"windows"=>$windows,"access"=>$access,"hosting"=>$hosting,"seller"=>$seller)));
}
	 
?>