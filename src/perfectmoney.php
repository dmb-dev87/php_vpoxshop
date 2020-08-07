<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";
if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: login.html");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = mysqli_real_escape_string($dbcon, $_GET['p_data']);
?>
 
<?php 
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
  $s1 = mysqli_query($dbcon, "SELECT * FROM `payment` WHERE `user`='$usrid' AND `p_data`='$p_data'");
  $r1 = mysqli_num_rows($s1);
  $res=mysqli_fetch_assoc($s1);
  $amountPay=$res['amountusd'];
?>
<body onload="document.forms['perfectmoney'].submit();">
<form action="https://perfectmoney.is/api/step1.asp" method="POST" name="perfectmoney">
	<input type="hidden" name="PAYEE_ACCOUNT" value="U15572862">
	<input type="hidden" name="PAYEE_NAME" value="VPOX">
	<input type='hidden' name='PAYMENT_ID' value='<?=time() ?>'>
	<input type="hidden"   name="PAYMENT_AMOUNT" value="<?php echo $amountPay; ?>"><BR>
	<input type="hidden" name="PAYMENT_UNITS" value="USD">
	<input type="hidden" name="STATUS_URL" value="<?php echo BASEURL;?>status.html?p_data=<?php echo $p_data; ?>">
	<input type="hidden" name="PAYMENT_URL" value="<?php echo BASEURL;?>complete.html?p_data=<?php echo $p_data; ?>">
	<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
	<input type="hidden" name="NOPAYMENT_URL" value="<?php echo BASEURL;?>failed.html?p_data=<?php echo $p_data; ?>">
	<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
	<input type="hidden" name="SUGGESTED_MEMO" value="">
	<input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
	<!--<input type="submit" name="PAYMENT_METHOD" value="Conferment Payment!" class="tabeladugme"><br><br> -->
</form>
 
 </body>
