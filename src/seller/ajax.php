<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$usrid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
?>
<?php
$s1 = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$usrid'")or die(mysqli_error());
$r1 = mysqli_fetch_assoc($s1);
$r1 = $r1['soldb'];
///
$s2 = mysqli_query($dbcon, "SELECT * FROM reports WHERE resseller='$usrid' AND status='1' OR status='2'");
$r2=mysqli_num_rows($s2);
///
$s4 = mysqli_query($dbcon, "SELECT * FROM rdps WHERE resseller='$usrid' AND sold='0'");
$r4=mysqli_num_rows($s4);
///
$s5 = mysqli_query($dbcon, "SELECT * FROM stufs WHERE resseller='$usrid' AND sold='0'");
$r5=mysqli_num_rows($s5);
///
$s6 = mysqli_query($dbcon, "SELECT * FROM cpanels WHERE resseller='$usrid' AND sold='0'");
$r6=mysqli_num_rows($s6);
///
$s7 = mysqli_query($dbcon, "SELECT * FROM mailers WHERE resseller='$usrid' AND sold='0'");
$r7=mysqli_num_rows($s7);
///
$s8 = mysqli_query($dbcon, "SELECT * FROM smtps WHERE resseller='$usrid' AND sold='0'");
$r8=mysqli_num_rows($s8);
///
$s9 = mysqli_query($dbcon, "SELECT * FROM leads WHERE resseller='$usrid' AND sold='0'");
$r9=mysqli_num_rows($s9);
///
$s10= mysqli_query($dbcon, "SELECT * FROM accounts WHERE resseller='$usrid' AND sold='0'");
$r10=mysqli_num_rows($s10);
///
$s11 = mysqli_query($dbcon, "SELECT * FROM banks WHERE resseller='$usrid' AND sold='0'");
$r11=mysqli_num_rows($s11);
///
$s12 = mysqli_query($dbcon, "SELECT * FROM scampages WHERE resseller='$usrid'");
$r12=mysqli_num_rows($s12);
///
$s13 = mysqli_query($dbcon, "SELECT * FROM tutorials WHERE resseller='$usrid'");
$r13=mysqli_num_rows($s13);

$s14 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='ionos'");
$r14=mysqli_num_rows($s14);
$s15 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='strato'");
$r15=mysqli_num_rows($s15);
$s16 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='tonline'");
$r16=mysqli_num_rows($s16);
$s17 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='rackspace'");
$r17=mysqli_num_rows($s17);
$s18 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='godaddy'");
$r18=mysqli_num_rows($s18);
$s19 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='office365'");
$r19=mysqli_num_rows($s19);

$s20 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and sold='0'");
$r20=mysqli_num_rows($s20);

$s21 = mysqli_query($dbcon, "SELECT * FROM ssh WHERE resseller='$usrid'");
$r21=mysqli_num_rows($s21);
?>
<?php

$myObj =new stdClass();
$myObj->sales = "$$r1";
$myObj->reports = "$r2";
$myObj->rdp = "$r4";
$myObj->shell = "$r5";
$myObj->cpanel = "$r6";
$myObj->mailer = "$r7";
$myObj->smtp = "$r8";
$myObj->leads = "$r9";
$myObj->premium = "$r10";
$myObj->banks = "$r11";
$myObj->scams = "$r12";
$myObj->tutorials = "$r13";
$myObj->dsmtp_ionos = "$r14";
$myObj->dsmtp_strato = "$r15";
$myObj->dsmtp_tonline = "$r16";
$myObj->dsmtp_rackspace = "$r17";
$myObj->dsmtp_godaddy = "$r18";
$myObj->dsmtp_office365 = "$r19";
$myObj->dsmtp = "$r20";
$myObj->ssh = "$r21";

$myJSON = json_encode($myObj);

echo $myJSON;
?>