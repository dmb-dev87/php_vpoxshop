<?php
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";
/*
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

$id = mysqli_real_escape_string($dbcon, $_GET['id']);

$sql = "SELECT * FROM rdps WHERE id=$id";
		
$query = mysqli_query($dbcon, $sql);

	
while ($row = mysqli_fetch_array($query))
$serverurl = $row['url'];
		$d = explode("|", $serverurl);
		$url = $d[0];
		$login = $d[1];
		$pass = $d[2];
		$target_host = $url;

    $host = $target_host;
    $port = "3389";
    $timeout = 2;
    $tbegin = microtime(true);
    $fp = fsockopen($host, $port, $errno, $errstr, $timeout); 
    $responding = 1;








    if (!$fp) { $responding = 0; } 

    $tend = microtime(true);
    fclose($fp);
    $mstime = ($tend - $tbegin) * 1000;
    $mstime = round($mstime, 2);
    if($responding)
    {
         echo "<span class='label label-success'>Working&nbsp;<i class='fa fa-check'></i></span>";
		return true;
    }
    else
    {
		$sql = "update rdps SET sold='deleted' WHERE id='$id'";
$query = mysqli_query($dbcon, $sql);
        echo "<span class='label label-danger'>Bad!&nbsp;<i class='fa fa-times-circle'></i></span>";
		
    }



/*
 if (preg_match('#CP Work#', $urltoapi2))
		{
	    echo "<span class='label label-success'>Working</span>";
		return true;
	} else { 
	    echo "<span class='label label-danger'>Bad!</span>";

	$sql = "UPDATE cpanels SET sold='deleted' WHERE id='$id'";
$query = mysqli_query($dbcon, $sql);
	} */
	
	?>