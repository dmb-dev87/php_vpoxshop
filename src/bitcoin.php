<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
   // header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = mysqli_real_escape_string($dbcon, $_GET['p_data']);
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="files/bootstrap/3/css/bootstrap.css?1" />
<link rel="stylesheet" type="text/css" href="files/css/flags.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
<script type="text/javascript" src="files/js/jquery.js?1"></script>
<script type="text/javascript" src="files/bootstrap/3/js/bootstrap.js?1"></script>
<script type="text/javascript" src="files/js/sorttable.js"></script>
<script type="text/javascript" src="files/js/table-head.js?3334"></script>
<script type="text/javascript" src="files/js/bootbox.min.js"></script>
<script type="text/javascript" src="files/js/clipboard.min.js"></script>

<link rel="shortcut icon" href="files/img/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" /> 
 <meta name="referrer" content="no-referrer" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>VpoxShop</title>
</head>
<style>
#table {
  .sortable
}
table th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25BE" 
}

.label-as-badge {
    border-radius: 0.5em;
}

body {
    padding-top:50px;
}
table.floatThead-table {
    border-top: none;
    border-bottom: none;
    background-color: #fff;
}
@media (min-width: 768px) {
  .dropdown:hover .dropdown-menu {
    display: block;
  }
}

#mydiv {
  height: 400px;
  position: relative;
}
.ajax-loader {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto; /* presto! */

}

   
    

</style>
<script type="text/javascript">
             function ajaxinfo() {
                $.ajax({
                    type: 'GET',
                    url: 'ajaxinfo.html',
                    timeout: 10000,

                    success: function(data) {
                        if (data != '01') {
                            var data = JSON.parse(data);
                            for (var prop in data) {
                                $("#" + prop).html(data[prop]).show();
                            }
                        } else {
                            window.location = "logout.html";
                        }
                    }
                });

            }
            setInterval(function() {
                ajaxinfo()
            }, 3000);

            ajaxinfo();

$(document).keydown(function(event){
    if(event.which=="17")
        cntrlIsPressed = true;
});

$(document).keyup(function(){
    cntrlIsPressed = false;
});

var cntrlIsPressed = false;


function pageDiv(n,t,u,x){
  if(cntrlIsPressed){
    window.open(u, '_blank');
    return false;
  }
        var obj = { Title: t, Url: u };
        if ( ("/"+obj.Url) != location.pathname) {
        	if (x != 1) {history.pushState(obj, obj.Title, obj.Url);}
        	else{history.replaceState(obj, obj.Title, obj.Url);}

    	}
      document.title = obj.Title;
   /* $("#mainDiv").html('<div id="mydiv"><img src="files/img/load2.gif" class="ajax-loader"></div>').show();
    $.ajax({
    type:       'GET',
    url:        'divPage'+n+'.html',
    success:    function(data)
    {
        $("#mainDiv").html(data).show();
        newTableObject = document.getElementById('table');
        sorttable.makeSortable(newTableObject);
        $(".sticky-header").floatThead({top:60});
        if(x==0){ajaxinfo();}
      }});*/
   if (typeof stopCheckBTC === 'function') { 
    var a = stopCheckBTC();
     }

}

$(window).on("popstate", function(e) {
        location.replace(document.location);

});

/*
$(window).on('load', function() {
$('.dropdown').hover(function(){ $('.dropdown-toggle', this).trigger('click'); });
   pageDiv(13,'Add Balance - VpoxShop','bitcoin.html?p_data=<?php echo $p_data; ?>',0);
   var clipboard = new Clipboard('.copyit');
    clipboard.on('success', function(e) {
      setTooltip(e.trigger, 'Copied!');
      hideTooltip(e.trigger);
      e.clearSelection();
   });

});*/


function setTooltip(btn, message) {
  console.log("hide-1");
  $(btn).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
     console.log("show");
}

function hideTooltip(btn) {
  setTimeout(function() {$(btn).tooltip('hide'); console.log("hide-2");}, 1000);
}
</script>
		<style>
            .navbar {
                background-color: #001f3f;
            }
        </style>
<body style="padding-top: 70px; padding-bottom: 70px;">
<nav class="navbar navbar-default navbar-fixed-top ">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <div class="navbar-brand" onClick="location.href='index.html'" onMouseOver="this.style.cursor='pointer'"><b><span class="glyphicon glyphicon-fire"></span> Vpox SHOP <small><span class="glyphicon glyphicon-refresh"></span></small></b></div></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-server"></i>&nbsp;Hosts <span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
		  <!-- onclick="pageDiv(1,'RDP - VpoxShop','rdp.html',0); return false;" -->
            <li><a href="rdp.html" ><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;RDPs <span class="label label-primary label-as-badge" id="rdp"></span></a></li>
			 <!-- onclick="pageDiv(2,'cPanel - VpoxShop','cPanel.html',0); return false;" -->
            <li><a href="cPanel.html"  ><i class="fa fa-tools" aria-hidden="true"></i>&nbsp;cPanels <span class="label label-primary label-as-badge" id="cpanel"></span></a></li>
				 <!-- onclick="pageDiv(3,'Shell - VpoxShop','shell.html',0); return false;" -->
            <li><a href="shell.html" ><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;Shells <span class="label label-primary label-as-badge" id="shell"></span></a></li>  
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-mail-bulk" aria-hidden="true"></i>&nbsp;Send <span class="doar" id="mail"></span></a>
          <ul class="dropdown-menu" role="menu">
		   <!-- onclick="pageDiv(4,'PHP Mailer - VpoxShop','mailer.html',0); return false;" -->
            <li><a href="mailer.html" ><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;PHP Mailers <span class="label label-primary label-as-badge" id="mailer"></span></a></li>
			   <!-- onclick="pageDiv(5,'SMTP - VpoxShop','smtp.html',0); return false;" -->
            <li><a href="smtp.html" ><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;SMTPs <span class="label label-primary label-as-badge" id="smtp"></span></a></li>  
          </ul>
        </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Leads <span class="doar" id="all_leads"></span></a>
          <ul class="dropdown-menu" role="menu">
		  <!-- onclick="pageDiv(6,'Leads - VpoxShop','leads.html',0); return false;" -->
            <li><a href="leads.html" ><i class="fa fa-at" aria-hidden="true"></i>&nbsp;Leads <span class="label label-primary label-as-badge" id="leads"></span></a></li>
          </ul>
        </li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Accounts <span class="doar" id="accounts"></span></a>
          <ul class="dropdown-menu" role="menu">
		  		  <!-- onclick="pageDiv(7,'Premium/Dating/Shop - VpoxShop','premium.html',0); return false;" -->
            <li><a href="premium.html" ><img src="img/premium.png" height="22px" width="22px">&nbsp;Premium/Dating/Shop <span class="label label-primary label-as-badge" id="premium"></span></a></li>
			<!-- onclick="pageDiv(8,'Banks - VpoxShop','banks.html',0); return false;" -->
            <li><a href="banks.html" ><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Banks <span class="label label-primary label-as-badge" id="banks"></span></a></li>  
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;Others <span class="doar" id="accounts"></span></a>
          <ul class="dropdown-menu" role="menu">
		  <!-- onclick="pageDiv(9,'Scampages - VpoxShop','scampage.html',0); return false;" -->
            <li><a href="scampage.html" ><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Scampage <span class="label label-primary label-as-badge" id="scams"></span></a></li>
			  <!-- onclick="pageDiv(10,'Tutorials - VpoxShop','tutorial.html',0); return false;" -->
            <li><a href="tutorial.html" ><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Tutorial <span class="label label-primary label-as-badge" id="tutorials"></span></a></li>  
          </ul>
        </li> 
                      
      </ul>
      <ul class="nav navbar-nav navbar-right">
                        <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT resseller FROM users WHERE username='$uid'") or die(mysqli_error());
$r         = mysqli_fetch_assoc($q);
$reselerif = $r['resseller'];
if ($reselerif == "1") {
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    $q = mysqli_query($dbcon, "SELECT soldb FROM resseller WHERE username='$uid'") or die(mysqli_error());
    $r = mysqli_fetch_assoc($q);

    echo '<li><a href="'.BASEURL.'seller/index.html"><span class="badge" title="Seller Panel"><span class="glyphicon glyphicon-cloud"></span><span id="seller"></span></span></a></li>';
} else {
} ?>      
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Tickets <span id="alltickets">
<?php
$sze112  = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' and seen='1'");
$r844941 = mysqli_num_rows($sze112);
if ($r844941 == "1") {
    echo '<span class="label label-danger">1</span>';
}
?>
<?php
$sze112  = mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' and seen='1'");
$r844941 = mysqli_num_rows($sze112);
if ($r844941 == "1") {
    echo '<span class="label label-danger">1</span>';
}
?>
</span><span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
		  	  <!-- onclick="pageDiv(11,'Tickets - VpoxShop','tickets.html',0); return false;" -->
            <li><a href="tickets.html" ><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Tickets <span class="label label-info"><span id="tickets"></span></span><?php
$s1 = mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' and seen='1'");
$r1 = mysqli_num_rows($s1);
if ($r1 == "1") {
    echo '<span class="label label-success"> 1 New</span>';
}
?></span></a></li>

 <!-- onclick="pageDiv(12,'Reports - VpoxShop','reports.html',0); return false;" -->
            <li><a href="reports.html" ><i class="fa fa-flag" aria-hidden="true"></i>&nbsp;Reports <span class="label label-info"><span id="reports"></span></span> <?php
$s1 = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' and seen='1'");
$r1 = mysqli_num_rows($s1);
if ($r1 == "1") {
    echo '<span class="label label-success"> 1 New</span>';
}
?></span> </a></li>

           </ul>
        </li>
<!-- onclick="pageDiv(13,'Add Balance - VpoxShop','addBalance.html',0); return false;" -->
        <li><a href="addBalance.html" ><span class="badge balc"><b><span id="balance"></span></b> <i class="fas fa-plus-circle"></i><span> </a></li>
       <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;My Account <span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
		  <!-- onclick="pageDiv(14,'Setting - VpoxShop','setting.html',0); return false;" -->
            <li><a href="setting.html" ><i class="fas fa-user-cog"></i>&nbsp;Setting <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
			 <!-- onclick="pageDiv(15,'Orders - VpoxShop','orders.html',0); return false;" -->
            <li><a href="orders.html" ><i class="fas fa-shopping-cart"></i>&nbsp;My Orders <span class="glyphicon glyphicon-shopping-cart pull-right"></span></a></li>
			<!-- onclick="pageDiv(13,'Add Balance - VpoxShop','addBalance.html',0); return false;" -->
            <li><a href="addBalance.html" ><i class="fas fa-dollar-sign"></i>&nbsp;Add Balance <span class="glyphicon glyphicon-usd pull-right"></span></a></li>
            <li class="divider"></li>
            <li><a href="logout.html" ><i class="fas fa-sign-out-alt"></i>&nbsp;Logout <span class="glyphicon glyphicon-off pull-right"></span></a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

<?php

include 'bitcoin/include.php';

$pdata = $_REQUEST['p_data'];
$query = mysqli_query($con,"select * from payment where p_data='$pdata'");
$ro = mysqli_fetch_assoc($query);

$invoice_id = $pdata;
$price_in_usd = $ro['amountusd'];
$product_url = 'nutbolt.jpg';
//echo $blockchain_root. "tobtc?currency=USD&value=" . $price_in_usd; exit;
$price_in_btc = file_get_contents($blockchain_root . "tobtc?currency=USD&value=" . $price_in_usd);
$btcpr = $price_in_btc;
 //echo $btcpr; exit;
 
 
 
 

/*print_r($ro['amountusd']);
echo $pdata;
 exit;
*/
?>
 <div id="myTabContent" class="tab-content">
	<div class="tab-pane fade active in" id="">
		<div id="">
				<div class="container col-lg-6">
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
			<script type="text/javascript" src="<?php echo $blockchain_root ?>Resources/js/pay-now-button-v2.js"></script>
			<script type="text/javascript">
	$(document).ready(function() {
		$('.stage-paid').on('show', function() {
			
			 
			var pdata = "<?php echo $invoice_id; ?>";
			var udata = "<?php echo $usrid; ?>";
			var btcpr = "<?php echo $btcpr; ?>";
				$.ajax({
				url:'bitcoin/update_balance_new.php',
					secureuri:false,
					type: "POST",       
					data: {"pdata":pdata,"udata":udata,"btcpr":btcpr},
					dataType: 'json',
					success: function (data){
				
				$('#state').text('');
				$('#state').text('Paid');
				$('#amount').text('');
				$('#amount').text(btcpr);
				$('#success_box').show();
				
						},
						}); 
		});
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.stage-error').on('show', function() {
			//window.location.href = './order_status.php?invoice_id=<?php echo $invoice_id; ?>';
			//window.location.href = '<?php echo BASEURL;?>failed.html?p_data=<?php echo $invoice_id; ?>';
		});
	});
	</script>
	<script type="text/javascript">
$(document).ready(function(){
    $("#confirmbuton").trigger('click'); 
});
</script>
	<style>
	.qr-code img{
		width:150px;
		height:150px;
	}
	</style>
	 <div class="blockchain-btn" style="width:auto" data-create-url="bitcoin/create.php?invoice_id=<?php echo $invoice_id; ?>"> 
            <div class="blockchain stage-begin">
              <button type="button" id="confirmbuton" class="btn btn-primary">Confirm Payment</button>
            </div> 
           <!-- <div class="blockchain stage-loading" style="text-align:center">
                <img src="<?php echo $blockchain_root; ?>Resources/loading-large.gif">
            </div>
			 -->
            <div class="blockchain stage-ready" style="display:block !important;">
			<div class="col-md-3">
			<h4  style="float:left;    font-size: 17px;">Pay using Bitcoin</h4>
			<br />
			<div class='qr-code' style="float:left"></div>
				</div>
			
							 	<div class="col-md-9">
								
								<script>
function myFunctionprice() {
  var copyText = document.getElementById("price_bit");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  //alert("Copied the text: " + copyText.value);
    document.getElementById("pbit").innerHTML = "Copied";
}
</script>

<script>
function myFunctionaddress() {
  var copyText = document.getElementById("addre_bit");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
 //alert("Copied the text: " + copyText.value);
   document.getElementById("pbitn").innerHTML = "Copied";
}
</script>
								<div class="input-group mb-3" style="padding: 46px 55px 0px 0px;display: block;">
								<span>Send exactly (BTC)</span>
									<input type="text" class="form-control" id="price_bit" value="<?php echo $btcpr; ?>" readonly="" >
									<div class="input-group-append" style="float: right;margin-bottom: -25px;margin-right: -87px;">
										<button class="btn btn-primary copyit" id="pbit" onclick="myFunctionprice()"><i class="fa fa-copy"></i> Copy</button>
									</div>
						 <br />
						 <br />
						 <br />
						 <br />
								<span>To the address</span>
									<input type="text" class="form-control" id="addre_bit" value="[[address]]" readonly="" >
									<div class="input-group-append" style="float: right;margin-bottom: -25px;margin-right: -87px;">
										<button class="btn btn-primary copyit" id="pbitn"  onclick="myFunctionaddress()"><i class="fa fa-copy"></i> Copy</button>
									</div>
									
									<br />
									<br />
									<br />
									<div style="border-bottom: 1px solid #dee2e6;margin-top: 17px;"></div>
									<table class="table">
								<tbody><tr style="border-bottom: 1px solid #dee2e6;margin-top: 17px;">
									<td align="left"><span class="text">State</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="state" style="background-color: #ecf0f1;    color: #212529;">Not Paid</span></td>
								</tr>
								<tr>
									<td align="left"><span class="text">Loaded BTC</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="amount" style="background-color: #ecf0f1;    color: #212529;">0.000</span> </td>
								</tr>
								
								<tr>
									<td align="left"><span class="text">Last Checked</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="time" style="background-color: #ecf0f1;  color: #212529;"><?php echo date('d/m/Y h:i:s a')  ?></span> <span id="Img" style="margin-left: 4px;"> <i class="fa fa-refresh" aria-hidden="true" style="font-size: 20px;position: relative;top: 4px;"></i></span></td>
								</tr>
								
							</tbody></table>
								</div>	
								

									
							 	</div >
			<script>
			setInterval(function(){ 
			//$('#Img').click(function(){ 
				$('#Img').text('');
				$('#Img').append('<img src="https://www.olux.to/files/img/load.gif" height="15" width="15" >');
				
			$.ajax({
				url:'updatetime.php',
					secureuri:false,
					type: "POST",       
					data: {},
					dataType: 'json',
					success: function (data){
				 $('#time').text('');
				 $('#time').text(data);
				 $('#Img').text('');
				$('#Img').append('<i class="fa fa-refresh" aria-hidden="true" style="font-size: 20px;position: relative;top: 4px;"></i>');
						},
						}); 
						}, 15000);
			//});
			</script>
			
				<script>
		
			$('#Img').click(function(){ 
				$('#Img').text('');
				$('#Img').append('<img src="https://www.olux.to/files/img/load.gif" height="15" width="15" >');
				
			$.ajax({
				url:'updatetime.php',
					secureuri:false,
					type: "POST",       
					data: {},
					dataType: 'json',
					success: function (data){
				 $('#time').text('');
				 $('#time').text(data);
				 $('#Img').text('');
				$('#Img').append('<i class="fa fa-refresh" aria-hidden="true" style="font-size: 20px;position: relative;top: 4px;"></i>');
						},
						}); 
						
			});
			</script>
              <!--  Please send <?php echo $btcpr; ?> BTC to <br /> <b>[[address]]</b> <br />-->
                
            </div>
            <div class="blockchain stage-paid">
               <!-- Payment Received <b>[[value]] BTC</b>. Thank You.-->
			   
			   <!-- After Code -->
			   <div class="col-md-3">
			<h4  style="float:left;    font-size: 17px;">Pay using Bitcoin</h4>
			<br />
			<div class='qr-code' style="float:left"></div>
				</div>
			
							 	<div class="col-md-9">
								 
								<div class="input-group mb-3" style="padding: 46px 55px 0px 0px;display: block;">
								<span>Send exactly (BTC)</span>
									<input type="text" class="form-control" id="price_bit" value="<?php echo $btcpr; ?>" readonly="" >
									<div class="input-group-append" style="float: right;margin-bottom: -25px;margin-right: -87px;">
										<button class="btn btn-primary copyit" onclick="myFunctionprice()"><i class="fa fa-copy"></i> Copy</button>
									</div>
						 <br />
						 <br />
						 <br />
						 <br />
						 
						 <?php 
						 $getpa = mysqli_query($dbcon,"select * from payment where `user`='$usrid' AND p_data='$pdata'");
						$comrow  = mysqli_fetch_assoc($getpa);
						$bitaddress = $comrow['bitaddress'];
						 ?>
								<span>To the address</span>
									<input type="text" class="form-control receaddress" id="addre_bits"   readonly="" >
									<div class="input-group-append" style="float: right;margin-bottom: -25px;margin-right: -87px;">
										<button class="btn btn-primary copyit"  onclick="myFunctionaddress()"><i class="fa fa-copy"></i> Copy</button>
									</div>
									
									<br />
									<br />
									<br />
									<div style="border-bottom: 1px solid #dee2e6;margin-top: 17px;"></div>
									<table class="table">
								<tbody><tr style="border-bottom: 1px solid #dee2e6;margin-top: 17px;">
									<td align="left"><span class="text">State</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="state" style="background-color: #ecf0f1;    color: #212529;">Paid</span></td>
								</tr>
								<tr>
									<td align="left"><span class="text">Loaded BTC</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="amount" style="background-color: #ecf0f1;    color: #212529;"><?php echo $btcpr; ?></span> </td>
								</tr>
								
								<tr>
									<td align="left"><span class="text">Last Checked</span></td>
									<td align="center"><span class="text">:</span></td>
									<td align="left"><span class="badge badge-light" id="time" style="background-color: #ecf0f1;  color: #212529;"><?php echo date('d/m/Y h:i:s a')  ?></span> <span id="Img" style="margin-left: 4px;cursor: pointer;"> <i class="fa fa-refresh" aria-hidden="true" style="font-size: 20px;position: relative;top: 4px;"></i></span></td>
								</tr>
								
							</tbody></table>
								</div>	
								

									
							 	</div >
			   <!-- After Code -->
            </div>
            <div class="blockchain stage-error">
                <font color="red">[[error]]</font>
            </div>
        </div>
		<div id="success_box" style="height: 100px;background: #15a589;margin-top: 350px;border-radius: 5px;    color: white;line-height: 0px;display:none;">
		<p style="    padding: 19px 15px;">Payment Completed</p>
		<p style="padding: 0px 15px;">An amount of $<?php echo $ro['amountusd']; ?> have been added to your account balance</p>
		</div>
		
		
		
			<!-- -->	</div>

			</form>

		</div>
            <div class="col-lg-6">

            <div class="bs-component">
            	<br><br>
              <div class="well well">
			  
			  <ul>
							<li><b>DO NOT CLOSE THIS PAGE</b></li>
							<li>Please wait for at least <b>1</b> confirmation </li>
							<li>For high amounts please include high fees </li>
							<li>Our bitcoin addresses are SegWit-enabled</li>							
							<li>Bitcoin to USD rate is  <b>6876.07 </b> (according to Blockchain) </li>
							<li>This page will be only valid for <b>2 hours</b></li>
							<li>Make sure that you send exactly <b>0.000727 BTC</b></li>
							<li>After payment an amount of <b>5$</b> will be added to your account</li>							
							<li>If any error happened or money didn't show please <a class="label label-default " href="tickets.html"><span class="glyphicon glyphicon-pencil"></span> Write Ticket</a> </li> 
						</ul>
			  
			  
               
              </div>
          </div>		


</div>

</div>
</div>


</body>
</html>

<script>
$(document).ready(function(){
	
	var usrid = "<?php echo $usrid ?>"; 
	setInterval(function()
{
    $.ajax({
        url:'get_upate_balance.php',
		secureuri:false,
		type: "POST",       
		data: {"usrid":usrid},
		dataType: 'json',
        success:function(data)
        {
			 console.log(data);
			 $('#balance').text();
			 $('#balance').text(data);
		 
        }
    });
}, 1000);  
});
</script>
<script>
/*$(document).ready(function(){
	setInterval(function()
{
	var addre_bit = $('#addre_bit').val();
	//alert(addre_bit);
	}, 2000);
})
*/
$(document).ready(function(){
var interval = setInterval(doStuff, 2000); // 2000 ms = start after 2sec 
function doStuff() {
  var addre_bit = $('#addre_bit').val();
  $('.receaddress').val(addre_bit);
 // alert(addre_bit);
  clearInterval(interval);
}
});
</script>
