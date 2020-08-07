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
	
	$arrs  = "";
$query = mysqli_query($dbcon, "SELECT DISTINCT(`url`) FROM `stufs` WHERE `sold` = '0' AND country='$cvl' ORDER BY url ASC");
	while($row = mysqli_fetch_assoc($query)){
		$ur = $row['url'];
		$tld = end(explode(".", parse_url($row['url'], PHP_URL_HOST))); 
		$arrs .= $tld.","; 
	//echo '<option value="'.$tld.'">.'.$tld.'&nbsp;('.$rowcount.')</option>';
	}
	
	$trim = rtrim($arrs,',');
	$repls = str_replace(' ','',$trim);
	
	$arrs = explode(',',$trim);
	$fg = array_count_values($arrs);
	foreach($fg as $key => $value) {  

	echo '<option value=".'.$key.'">.'.$key.'&nbsp;('.$value.')</option>';
} 
	
}else{
$arrs  = "";
$query = mysqli_query($dbcon, "SELECT DISTINCT(`url`) FROM `stufs` WHERE `sold` = '0' ORDER BY url ASC");
	while($row = mysqli_fetch_assoc($query)){
		$ur = $row['url'];
		$tld = end(explode(".", parse_url($row['url'], PHP_URL_HOST))); 
		$arrs .= $tld.","; 
	//echo '<option value="'.$tld.'">.'.$tld.'&nbsp;('.$rowcount.')</option>';
	}
	
	$trim = rtrim($arrs,',');
	$repls = str_replace(' ','',$trim);
	
	$arrs = explode(',',$trim);
	$fg = array_count_values($arrs);
	foreach($fg as $key => $value) {  

	echo '<option value=".'.$key.'">.'.$key.'&nbsp;('.$value.')</option>';
} 
}
	 
?>