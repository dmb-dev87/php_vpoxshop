<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

$s1 = mysqli_query($dbcon, "SELECT * FROM ticket where status='1' and uid='$usrid'");
$r1=mysqli_num_rows($s1);
$s2 = mysqli_query($dbcon, "SELECT * FROM reports where status='1' and uid='$usrid'");
$r2=mysqli_num_rows($s2);
$s3 = mysqli_query($dbcon, "SELECT balance,username FROM users WHERE username='$usrid'");
$r3=  mysqli_fetch_assoc($s3);
$r3= $r3['balance'];
$s4 = mysqli_query($dbcon, "SELECT * FROM rdps WHERE sold='0'");
$r4=mysqli_num_rows($s4);
$s5 = mysqli_query($dbcon, "SELECT * FROM stufs WHERE sold='0'");
$r5=mysqli_num_rows($s5);
$s6 = mysqli_query($dbcon, "SELECT * FROM cpanels WHERE sold='0'");
$r6=mysqli_num_rows($s6);
$s7 = mysqli_query($dbcon, "SELECT * FROM mailers WHERE sold='0'");
$r7=mysqli_num_rows($s7);
$s8 = mysqli_query($dbcon, "SELECT * FROM smtps WHERE sold='0'");
$r8=mysqli_num_rows($s8);
$s21 = mysqli_query($dbcon, "SELECT * FROM smtps WHERE sold='0'");
$r21 = mysqli_num_rows($s21);
$s9 = mysqli_query($dbcon, "SELECT * FROM leads WHERE sold='0'");
$r9=mysqli_num_rows($s9);
$s10= mysqli_query($dbcon, "SELECT * FROM accounts WHERE sold='0'");
$r10=mysqli_num_rows($s10);
$s11 = mysqli_query($dbcon, "SELECT * FROM banks WHERE sold='0'");
$r11=mysqli_num_rows($s11);
$s12 = mysqli_query($dbcon, "SELECT * FROM scampages");
$r12=mysqli_num_rows($s12);
$s13 = mysqli_query($dbcon, "SELECT * FROM tutorials");
$r13=mysqli_num_rows($s13);
$s20 = mysqli_query($dbcon, "SELECT * FROM ssh");
$r20=mysqli_num_rows($s20);

$s14 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='ionos' and sold='0'");
$r14=mysqli_num_rows($s14);
$s15 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='strato' and sold='0'");
$r15=mysqli_num_rows($s15);
$s16 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='tonline' and sold='0'");
$r16=mysqli_num_rows($s16);
$s17 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='rackspace' and sold='0'");
$r17=mysqli_num_rows($s17);
$s18 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='godaddy' and sold='0'");
$r18=mysqli_num_rows($s18);
$s19 = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE resseller='$usrid' and typesmtp='office365' and sold='0'");
$r19=mysqli_num_rows($s19);

$myObj =new stdClass();
$myObj->tickets = "$r1";
$myObj->reports = "$r2";
$myObj->balance = "$r3";
$myObj->rdp = "$r4";
$myObj->shell = "$r5";
$myObj->cpanel = "$r6";
$myObj->mailer = "$r7";
$myObj->webmail = "$r21";
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
$myObj->ssh = "$r20";
        $q = mysqli_query($dbcon, "SELECT resseller FROM users WHERE username='$usrid'");
          $r = mysqli_fetch_assoc($q);
		  $reselerif = $r['resseller'];
       if ($reselerif == "1") { 
          $q = mysqli_query($dbcon, "SELECT soldb FROM resseller WHERE username='$usrid'");
          $r = mysqli_fetch_assoc($q);
$seller = $r['soldb'];
$myObj->seller = "$$seller";		
	   } else { }
$myJSON = json_encode($myObj);

echo $myJSON;
?>