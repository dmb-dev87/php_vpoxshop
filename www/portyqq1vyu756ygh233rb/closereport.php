<?php
 ob_start();
 date_default_timezone_set('GMT');

session_start();
include "../includes/config.php";

if(!isset($_SESSION['aname']) and !isset($_SESSION['apass'])){
   header("location: login.html");
   exit();
}
$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);


$get = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$myid'");
$row = mysqli_fetch_assoc($get);

$date = date("Y-m-d h:i:sa");
$resseller = $row['resseller'];
$buyer = $row['uid'];
$acctype = $row['acctype'];
$sid = $row['s_id'];
$surl = $row['s_url'];
$price = $row['price'];
$d = $row['date'];
$memo = $row['memo'];
// Check connection
   $msg     = '
  <div class="panel panel-default">
  <div class="panel-body">
<b>Refund request has been rejected.<br>Thank you for using Vpox.</b>
 </div>
  <div class="panel-footer"><div class="label label-warning">Support</div> - '.date("d/m/Y h:i:s a").'</div>
  </div>
  ';
  $ms = $memo.''.$msg;
  //print_r("UPDATE reports SET memo ='$ms',status = '0',seen='1',lastreply='Support',state='rejected' WHERE id='$myid'");
  $qq = mysqli_query($dbcon, "update reports SET memo='$ms',status='0',seen='1',lastreply='Support',state='rejected' where id='$myid'")or die(mysqli_error($dbcon));
  header("location: viewr.php?id=$myid"); 


?>