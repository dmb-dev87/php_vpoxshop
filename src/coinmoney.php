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
	<form action="https://www.coinpayments.net/index.php" method="post" name="submitpayment">
		<input type="hidden" name="cmd" value="_pay_simple">
		<input type="hidden" name="reset" value="1">
		<input type="hidden" name="merchant" value="68484cb4f39e2c9f87f12a20ee99cb0f">
		<input type="hidden" name="currency" value="USD">
		<input type="hidden" name="amountf" value="<?php echo $amountPay;?>">
		<input type="hidden" name="item_name" value="Add Fund">
		<!--<input type="hidden" name="item_desc" value="Joining Fees">
		<input type="hidden" name="item_number" value="156669">-->
		<input type="hidden" name="item_number" value="<?php echo time();?>">
		<input type="hidden" name="invoice" value="<?php echo time();?>">
		<input type="hidden" name="want_shipping" value="0">
		<!--<input type="hidden" name="custom" value="946519">-->
		<input type="hidden" name="success_url" value="<?echo BASEURL;?>complete.html">
		<input type="hidden" name="cancel_url" value="<?echo BASEURL;?>failed.html">
		<input type="hidden" name="ipn_url" value="<?echo BASEURL;?>notifypay.php">
		<!--<input type="hidden" name="first_name" value="">
		<input type="hidden" name="last_name" value="">
		<input type="hidden" name="email" value="">
		<input type='hidden' name='custom' value=''>-->
		<!--<input type="image" src="https://www.coinpayments.net/images/pub/buynow-grey.png" alt="Buy Now with CoinPayments.net">
		<button type="submit" style="text-align:center;" class="btn btn-success">Grab <?php //$point_volume;?> Coins At 0.0001 Presale Price</button>-->
	</form>
	<script>
		document.submitpayment.submit();
	</script>
<!--
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
		<input type="submit" name="PAYMENT_METHOD" value="Conferment Payment!" class="tabeladugme"><br><br> 
	</form>
-->
</body>
