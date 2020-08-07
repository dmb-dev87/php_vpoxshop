<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

?>
<?php 

echo '<option value="">All</option>';
$cvl = $_POST['cvl'];
if($cvl != ""){
$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `stufs` WHERE `sold` = '0' AND country='$cvl' ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		$hostings = $row['hosting'];
		$query1 = mysqli_query($dbcon, "SELECT * FROM `stufs` WHERE hosting='$hostings' AND `sold` = '0'");
		$rowcount=mysqli_num_rows($query1);
		$hosname = $row['hosting'];
	echo '<option value="'.$hosname.'">'.$hosname.'&nbsp;('.$rowcount.')</option>';
	}
}else{
	
	$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `stufs` WHERE `sold` = '0' ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		$hostings = $row['hosting'];
		$query1 = mysqli_query($dbcon, "SELECT * FROM `stufs` WHERE hosting='$hostings' AND `sold` = '0' ");
		$rowcount=mysqli_num_rows($query1);
		$hosname = $row['hosting'];
	echo '<option value="'.$hosname.'">'.$hosname.'&nbsp;('.$rowcount.')</option>';
	}
}
?>