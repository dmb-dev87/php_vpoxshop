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
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#addBalance">Add Balance</a></li>
    <li><a data-toggle="tab" href="#deposits">Last 10 Deposits</a></li>
 
  </ul>

<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade active in" id="addBalance">
		<div id="balance">
				<div class="container col-lg-6">
					<h3>Add Balance</h3>
			<form id="formAddBalance">

					<div class="row">
						<div class="form-group col-lg-12 ">
							<label for="method">Method</label> 
                <select name="methodpay" class="form-control" size="3" style="height: 100%;">
                  <option value="BitcoinPayment" selected="">Bitcoin</option>
                  <option value="PerfectMoneyPayment">Perfect Money</option>
				  <option value="CoinPayment">Coinpayment</option>
                </select>


						</div>
					</div>

          					<div class="row">
						<div class="form-group col-lg-6 ">
							<label for="amount">Amount</label> <input placeholder="20" pattern="[0-9]*"  type="number" name="amount" class="form-control input-normal" required="">
						</div>
					</div>
<button type="submit" form="formAddBalance" class="btn btn-primary btn-md">Add Balance <span class="glyphicon glyphicon-plus"></span></button>
				</div>

			</form>

		</div>
            <div class="col-lg-6">

            <div class="bs-component">
            	<br><br>
              <div class="well well">
                        <ul>
          <li>If you sent <b>Money</b> but it don't appear in your account please <a class="label label-default " href="tickets.html"><span class="glyphicon glyphicon-pencil"></span> Write Ticket</a></b></li>
          <li>After payment funds will be added automatically to your account <b>INSTANTLY</b></li>
          <li><b>PerfectMoney</b>/<b>Bitcoin</b> is a secure way to fund your account </li>
		  <li>Min is 5 USD For Bitcoin</li>
		  <li>Min is 10 USD For Perfect Money</li>
          <li><b>Buyer Protection</b>
            - any time you like , you can ask for <b>BALANCE REFUND !</b>       
             </li>

        </ul>
              </div>
          </div>		


</div>
</div>

<!-- Deposits -->
 <div id="deposits" class="tab-pane fade">
<table width="100%" class="table table-striped table-bordered table-sm" id="table">
      <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">Date</th>
        <th scope="col">Amount</th>
        <th scope="col">Method</th>
        <th scope="col">Before Balance</th>
        <th scope="col">After Balance</th>   
        </tr>
      </thead>
      <tbody>
	  <?php
		$getus = mysqli_query($dbcon,"select * from payment where `user`='$usrid' AND `state`='complete' order by pay_id limit 10");
		while($payadata = mysqli_fetch_array($getus)){
		
		if($payadata['old_bal'] == ""){
			
			$oldb = '0.00';
		}else{
			$oldb = $payadata['old_bal'];
		}
		
		if($payadata['af_bal'] == ""){
			
			$af_bal = '0.00';
		}else{
			$af_bal = $payadata['af_bal'];
		}
		
		?>
     <tr>
      <td></td>
      <td><?php echo $payadata['date']; ?></td>
      <td><?php echo $payadata['amountusd']; ?></td>
      <td><?php echo $payadata['method']; ?></td>
      <td><?php echo $oldb; ?></td>
      <td><?php echo $af_bal; ?></td>
   
	</tr> 
		<?php } ?>
      </tbody>
    <tfoot></tfoot></table>
	</div>
<!-- Deposits -->
</div>
<script>
if(window.location.hash != "") {
  $("#method").val(window.location.hash.substring(1));
}

$("#formAddBalance").submit(function() {
$('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'addBalanceAction.html',
           data: $("#formAddBalance").serialize(), // serializes the form's elements.
           success: function(data)
           {
            ////console.log(data);
            if (data == 01) {
              alert('Please enter a valid amount and Minimum of $5');
              $('button').prop('disabled', false);

             }else if (data == 02) {
              alert('Please enter a valid amount and Minimum $10');
              $('button').prop('disabled', false);

             }else if (data != 01 ) {
              var getObj=JSON.parse(data);
              console.log(getObj.methodpay);
			  
               if(getObj.methodpay=='PerfectMoneyPayment')
               {
                 window.location = "paymentnow.html?p_data="+getObj.random;
               }else if(getObj.methodpay == 'BitcoinPayment')
               {
               // window.location = "bitcoin/index.php?p_data="+getObj.random;
                window.location = "bitcoin.html?p_data="+getObj.random;
               }
			   else if(getObj.methodpay == 'CoinPayment')
               {
               // window.location = "bitcoin/index.php?p_data="+getObj.random;
                window.location = "coinpayment.html?p_data="+getObj.random;
               }else{
				   ///pageDiv('payment'+data,'Add Balance - Olux SHOP','Payment.html?p_data='+data,0);
			   }
               //$("#balance").html(data).show();
               ///pageDiv('payment'+data,'Add Balance - Olux SHOP','Payment.html?p_data='+data,0);
             }
           }
         });

    return false; // avoid to execute the actual submit of the form.
});

</script>