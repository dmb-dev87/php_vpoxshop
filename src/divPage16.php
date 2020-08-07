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



<style>

</style>

<ul class="nav nav-tabs">
  <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table"><thead><tr><th>Country</th>
<th>Domain TLD</th>
<th>SSL</th>
<th>Server Information</th>
<th>Server OS</th>
<th>Detected Hosting</th>

<th>Seller</th>
<!--<th></th>--></tr></thead><tbody><tr><td>
<select class='filterselect form-control input-sm shell_country' name="shell_country"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `ssh` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
		$country = $row['country'];
		$query1 = mysqli_query($dbcon, "SELECT * FROM `ssh` WHERE  country='$country'");
		$rowcountc=mysqli_num_rows($query1);
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</option></select>
</td><td style="width: 118px;"><!--<input class='filterinput form-control input-sm' name="shell_tld" size='3'>-->
<select class='filterselect form-control input-sm shell_tld' name="shell_tld">
<option value="">ALL</option>
<?php
$arrs  = "";
$query = mysqli_query($dbcon, "SELECT DISTINCT(`url`) FROM `ssh` WHERE `sold` = '0' ORDER BY url ASC");
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
	 
?>
</option></select>

</td>

<td style="width: 118px;"><select class='filterselect form-control input-sm ssls' name="shell_ssl">
<option value="">ALL</option>
<option value="https">HTTPS</option>
<option value="http">HTTP</option></select></td>
<td><input class='filterinput form-control input-sm shell_info' name="shell_info" size='3' placeholder="Type to filter..."></td>
<td><select class='filterselect form-control input-sm shell_os' name="shell_os">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`windows`) FROM `ssh` WHERE `sold` = '0' ORDER BY windows ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['windows'].'">'.$row['windows'].'</option>';
	}
?>
</select></td>
<td><!--<input class='filterinput form-control input-sm shell_hostings'  name="shell_hosting" size='3'>-->
<select class='filterselect form-control input-sm shell_hostings' name="shell_hosting">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `ssh` WHERE `sold` = '0' ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		$hostings = $row['hosting'];
		$query1 = mysqli_query($dbcon, "SELECT * FROM `stufs` WHERE hosting='$hostings' AND `sold` = '0' ");
		$rowcount=mysqli_num_rows($query1);
		$hosname = $row['hosting'];
	echo '<option value="'.$hosname.'">'.$hosname.'&nbsp;('.$rowcount.')</option>';
	}
?>
</option></select>

</td>
<td><select class='filterselect form-control input-sm sellesd' name="shell_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `ssh` WHERE `sold` = '0' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
		   
	}
?>
</select></td>


<!--<td><!--<button id='filterbutton'class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button></td>--></tr></tbody></table></div>
</div>

<table width="100%"  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >Country</th>
      <th scope="col">TLD</th>
      <th scope="col">SSL</th>
      <th scope="col" style="float: left;width: 300px;border-right:none;border-bottom:none;">Server Information</th>
      <th scope="col">Server OS</th>
      <th scope="col">Detected Hosting</th>
      <th scope="col">Seller</th>
      <th scope="col">Check</th>
      <th scope="col">Price</th>
      <th scope="col">Added on </th>

      <th scope="col">Buy</th>
    </tr>
</thead>
  <tbody>
<?php
include("cr.php");
$q = mysqli_query($dbcon, "SELECT * FROM ssh WHERE sold='0' ORDER BY RAND()")or die(mysql_error());
while($row = mysqli_fetch_assoc($q)){
	 $countryfullname = $row['country'];
	 $ssur = $row['url'];
	 $exur = explode(':',$ssur);
	 if($exur[0] == 'https'){
		 $ic = '<i class="fas fa-lock fa-fw" style="color: #18BC9C;"></i>';
		 $cols = 'color: #18BC9C';
	 }else{
		 $ic = '<i class="fas fa-lock-open fa-fw"></i>';
		 $cols = '';
	 }
	 
	 if($row['server_info'] != ""){
		 $styles = 'float: left;width: 300px;border-right:none;font-size:13px;word-break: break-all;';
	 }else{
		 $styles = '';
	 }
	 $code = array_search("$countryfullname", $countrycodes);
	 $countrycode = strtolower($code);
	 $tld = end(explode(".", parse_url($row['url'], PHP_URL_HOST))); 
	 $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		while($rpw = mysqli_fetch_assoc($qer))
			$SellerNick = "seller".$rpw["id"]."";
		if(empty($row['hosting'])) { $hostingdetec = "N/A"; } else { $hostingdetec = $row['hosting']; }
		if(empty($row['infos'])) { $hosting = "Not Available"; } else { $hosting = $row['infos']; }
    
	echo "<tr>     
    <td id='shell_country'> <i class='flag-icon flag-icon-$countrycode'> </i>&nbsp;".htmlspecialchars($row['country'])." </td>
	    <td id='shell_tld'> .".$tld." </td>
    <td id='shell_ssl'>".$ic."&nbsp;<span style='".$cols."'>".$exur[0]."</span> </td>
    <td id='shell_info' style='".$styles."'> ".$row['server_info']." </td>
    <td id='shell_os'> ".$row['windows']." </td>
    <td id='shell_hosting'> ".htmlspecialchars($hostingdetec)." </td>
    <td id='shell_seller'> ".$SellerNick."</td>"; echo '<td><span id="shop'.$row["id"].'" type="shell"><a onclick="javascript:check('.$row["id"].');" class="btn btn-info btn-xs"><font color="white"><i class="fas fa-check-circle"></i>&nbsp;Check</font></a></span><center>';
  echo "</td><td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".$row['date']."</td>";
    echo '
    <td>
	<span id="shell'.$row["id"].'" title="buy"  type="shell"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color="white"><i class="fa fa-shopping-cart"></i>&nbsp;Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>

                    </tbody>
                      </table>
  

<script type="text/javascript">

$('#filterbutton').click(function () {
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' )|| (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
function buythistool(id){
  bootbox.confirm("Are you sure?", function(result) {
        if(result ==true){
      $.ajax({
     method:"GET",
     url:"buytool.php?id="+id+"&t=ssh",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#shell"+id).html(data).show();
         }else{
            bootbox.alert('<center><img src="files/img/balance.png"><h2><b>No enough balance !</b></h2><h4>Please refill your balance <a class="btn btn-primary btn-xs"  href="addBalance.html" onclick="window.open(this.href);return false;" >Add Balance <span class="glyphicon glyphicon-plus"></span></a></h4></center>')
         }
     },
   });
       ;}
  });
}
g:xcheck=0;
function check(id){   
     if(xcheck > 2){
    bootbox.alert("<b>Wait</b> - Other checking operation is executed!");
  } else {
    xcheck++;
    var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('Checking...').show();
	$.ajax({
	type: 		'GET',
	url: 		'CheckShell'+id+'.html',
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
		xcheck--;
	}});
} }

function openitem(order){
  $("#myModalLabel").text('Order #'+order);
  $('#myModal').modal('show');
  $.ajax({
    type:       'GET',
    url:        'showOrder'+order+'.html',
    success:    function(data)
    {
        $("#modelbody").html(data).show();
    }});

}

</script>

<!-- NEW -->
<!-- detected-->
<script>
//$('#shell_hosting').click(function () {
	
		$('.shell_hostings').on('change',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!-- detected-->
					<!-- Country-->
					<script>
//$('#shell_hosting').click(function () {
	
		$('.shell_country').on('change',function(){
			//alert('1')
			var cvl = $(this).val();
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			
			/* Ajax */
			
			$.ajax({
                type: "POST",
                url: 'gethosting.php',
                data: {"cvl":cvl},
               	dataType: 'html',
                success: function(data){
					
					$('.shell_hostings').html('<option value="">All</option>');
					$('.shell_hostings').html(data);
				}
				});
				
				$.ajax({
                type: "POST",
                url: 'getltd.php',
                data: {"cvl":cvl},
               	dataType: 'html',
                success: function(data){
					

					$('.shell_tld').html(data);
				}
				});
				
				$.ajax({
                type: "POST",
                url: 'getssl.php',
                data: {"cvl":cvl},
               	dataType: 'html',
                success: function(data){
					

					$('.ssls').html(data);
				}
				});
				
				$.ajax({
                type: "POST",
                url: 'serveros.php',
                data: {"cvl":cvl},
               	dataType: 'html',
                success: function(data){
					

					$('.shell_os').html(data);
				}
				});
				
				$.ajax({
                type: "POST",
                url: 'gsell.php',
                data: {"cvl":cvl},
               	dataType: 'html',
                success: function(data){
					

					$('.sellesd').html(data);
				}
				});
				
			/* Ajax */
			
			
			
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!-- Country-->
					<!--TLD -->
					
					<script>
//$('#shell_hosting').click(function () {
	
		$('.shell_tld').on('change',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!--TLD -->
					<!--SSl -->
					<script>
//$('#shell_hosting').click(function () {
	
		$('.ssls').on('change',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!--SSl -->
					<!-- Windows --> 
					
						<script>
//$('#shell_hosting').click(function () {
	
		$('.shell_os').on('change',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!-- Windows --> 
					<!-- Seller -->
					<script>
//$('#shell_hosting').click(function () {
	
		$('.sellesd').on('change',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!-- Seller -->
					<!-- server info -->
									<script>
//$('#shell_hosting').click(function () {
	
		$('.shell_info').on('keyup',function(){
			//alert('1')
	$("#table tbody tr").each(function() {
		
		var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );
		var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );
		var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );
		var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );
		var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );
		var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() );
		var ck7 = $.trim( $(this).find("#shell_ssl").text().toLowerCase() );
		var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );
		var val2 = $.trim( $('select[name="shell_tld"]').val().toLowerCase() );
		var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );
		var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );
		var val5 = $.trim( $('select[name="shell_hosting"]').val().toLowerCase() );
		var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() );
		var val7 = $.trim( $('select[name="shell_ssl"]').val());
	
		if((ck1 != val1 && val1 != '' ) ||(ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){ $(this).hide(); 
		}else{
			$(this).show();
			}
			});
			$('#filterbutton').prop('disabled', true);
			});
			$('.filterselect').change(function () {
				$('#filterbutton').prop('disabled', false);
				});
				$('.filterinput').keyup(function () {
					$('#filterbutton').prop('disabled', false);
					});
					</script>
					<!-- server info -->
					
					
					
<!-- NEW -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="modelbody">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
