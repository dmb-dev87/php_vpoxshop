<?php

include 'include.php';

$pdata = $_REQUEST['p_data'];
$query = mysqli_query($con,"select * from payment where p_data='$pdata'");
$ro = mysqli_fetch_assoc($query);

$invoice_id = $pdata;
$price_in_usd = $ro['amountusd'];
$product_url = 'nutbolt.jpg';
$price_in_btc = file_get_contents($blockchain_root . "tobtc?currency=USD&value=" . $price_in_usd);
$btcpr = $price_in_btc;
 
 
 
 
 

/*print_r($ro['amountusd']);
echo $pdata;
 exit;
*/
?>

<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $blockchain_root ?>Resources/js/pay-now-button-v2.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function() {
		$('.stage-paid').on('show', function() {
			//window.location.href = './order_status.php?invoice_id=<?php echo $invoice_id; ?>';
			 
			var pdata = "<?php echo $invoice_id; ?>";
				$.ajax({
				url:'update_balance_new.php',
					secureuri:false,
					type: "POST",       
					data: {"pdata":pdata},
					dataType: 'json',
					success: function (data){
					window.location.href = 'https://www.globalhunttechnologies.com/Vpox/complete.html?p_data=<?php echo $invoice_id; ?>';
						},
						}); 
		});
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.stage-error').on('show', function() {
			//window.location.href = './order_status.php?invoice_id=<?php echo $invoice_id; ?>';
			window.location.href = 'https://www.globalhunttechnologies.com/Vpox/failed.html?p_data=<?php echo $invoice_id; ?>';
		});
	});
	</script>
</head>
    <body>
       <!--<h1>Buy Nuts and Bolts</h1>-->

        <div class="blockchain-btn" style="width:auto" data-create-url="create.php?invoice_id=<?php echo $invoice_id; ?>"> 
            <div class="blockchain stage-begin">
              <button type="button" class="btn btn-primary">Confirm Payment</button>
            </div>
            <div class="blockchain stage-loading" style="text-align:center">
                <img src="<?php echo $blockchain_root; ?>Resources/loading-large.gif">
            </div>
			 
            <div class="blockchain stage-ready" style="text-align:center">
                Please send <?php echo $btcpr; ?> BTC to <br /> <b>[[address]]</b> <br />
                <div class='qr-code'></div>
            </div>
            <div class="blockchain stage-paid">
                Payment Received <b>[[value]] BTC</b>. Thank You.
            </div>
            <div class="blockchain stage-error">
                <font color="red">[[error]]</font>
            </div>
        </div>
    </body>
</html>