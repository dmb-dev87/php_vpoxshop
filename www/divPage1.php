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
  <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table">
  <thead>
  <tr>
  <th>Country</th>
  <th>State</th>
 <th>City</th>
<th>Windows Type</th>
<th>Access</th>
<th>Detected Hosting</th>
<th>Seller</th>
<!--<th></th>-->
</tr>
</thead>
<tbody>
<tr>
<td>
<select class='filterselect form-control input-sm rdp_country' name="rdp_country">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `rdps` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</select>
</td>
<td>
<select class='filterselect form-control input-sm rdp_state' name="rdp_state">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`state`) FROM `rdps` WHERE `sold` = '0' ORDER BY state ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
	}
?>
</select>
</td>

<td>
<select class='filterselect form-control input-sm rdp_city' name="rdp_city">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`city`) FROM `rdps` WHERE `sold` = '0' ORDER BY city ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
	}
?>
</select>
</td>

<td><select class='filterselect form-control input-sm rdp_windows' name="rdp_windows">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`windows`) FROM `rdps` WHERE `sold` = '0' ORDER BY windows ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['windows'].'">'.$row['windows'].'</option>';
	}
?>
</td>
<td><select class='filterselect form-control input-sm rdp_access' name="rdp_access"><option value="">ALL</option><option value="ADMIN">ADMIN</option><option value="USER">USER</option></select></td>
<td><!--<input class='filterinput form-control input-sm' name="rdp_hosting" size='3'>-->
<select class='filterselect form-control input-sm rdp_hosting' name="rdp_hosting">
<option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`hosting`) FROM `rdps` WHERE `sold` = '0' ORDER BY hosting ASC");
	while($row = mysqli_fetch_assoc($query)){
		$hostings = $row['hosting'];
		$query1 = mysqli_query($dbcon, "SELECT * FROM `rdps` WHERE hosting='$hostings' AND `sold` = '0' ");
		$rowcount=mysqli_num_rows($query1);
		$hosname = $row['hosting'];
	echo '<option value="'.$hosname.'">'.$hosname.'&nbsp;('.$rowcount.')</option>';
	}
?>
</option></select>
</td>


<td><select class='filterselect form-control input-sm rdp_seller' name="rdp_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `rdps` WHERE `sold` = '0' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
?>
</select></td><!--<td><button id='filterbutton'class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button></td>--></tr></tbody></table></div>
</div>


<table width="100%"  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >Country</th>
      <th scope="col" >State</th>
      <th scope="col" >City</th>
      <th scope="col" >Windows</th>
      <th scope="col" >Ram</th>
      <th scope="col">Access</th>
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
$q = mysqli_query($dbcon,"SELECT * FROM rdps WHERE sold='0' ORDER BY RAND()")or die(mysql_error());					
	while($row = mysqli_fetch_assoc($q)){
	 	 $countryfullname = $row['country'];
		 $code = array_search("$countryfullname", $countrycodes);
		 $countrycode = strtolower($code);
	 	 $tld = end(explode(".", parse_url($row['url'], PHP_URL_HOST))); 
		 $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
     echo "
 <tr>    
    <td id='rdp_country'><i class='flag-icon flag-icon-$countrycode'></i>&nbsp;".htmlspecialchars($row['country'])." </td>
    <td id='rd_state'> ".htmlspecialchars($row['state'])." </td>
    <td id='rdp_city'> ".htmlspecialchars($row['city'])." </td>
    <td id='rdp_windows'> ".htmlspecialchars($row['windows'])." </td>
    <td> ".htmlspecialchars($row['ram'])." </td>
    <td id='rdp_access'> ".htmlspecialchars($row['access'])." </td>
    <td id='rdp_hosting'> ".htmlspecialchars($row['hosting'])."</td>
    <td id='rdp_seller'> ".htmlspecialchars($SellerNick)."</td>
	";
	 echo '<td><span id="shop'.$row["id"].'" type="rdp"><a onclick="javascript:check('.$row['id'].');" class="btn btn-info btn-xs"><font color=white><i class="fas fa-check-circle"></i>&nbsp;Check</font></a></span><center></td>';
	echo "
    <td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".htmlspecialchars($row['date'])."</td>
    <td>";
    echo '
	<span id="rdp'.$row['id'].'" title="buy" type="cpanel"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color=white><i class="fa fa-shopping-cart"></i>&nbsp;Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>
      </tbody>
</table>
<script type="text/javascript">
$('#filterbutton').click(function (){
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_access").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() );
	 var val4 = $.trim( $('input[name="rdp_hosting"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || ck4.indexOf(val4)==-1 || (ck5 != val5 && val5 != '' )){
		 $(this).hide();
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
     url:"buytool.php?id="+id+"&t=rdps",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#rdp"+id).html(data).show();
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
     if(xcheck > 1){
    bootbox.alert("<b>Wait</b> - Other checking operation is executed!");
  } else {
    xcheck++;
    var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('Checking...').show();
	$.ajax({
	type: 		'GET',
	url: 		'checkrdp.php?id='+id,
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
<script type="text/javascript">
$('.rdp_country').on('change',function(){
	var cvl = $(this).val();
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
		 }else{
			 $(this).show(); 
			 }
			 }); 
			 $('#filterbutton').prop('disabled', true);
			 
			 $.ajax({
                type: "POST",
                url: 'getrdpdata.php',
                data: {"cvl":cvl},
               	dataType: 'json',
                success: function(data){
					/*console.log(data);
					console.log(data['state']);*/
					/*$('.shell_hostings').html('<option value="">All</option>');
					$('.shell_hostings').html(data);*/
					
				    var rdp_state = data['state'];
					var rdp_city = data['city'];
					var rdp_windows = data['windows'];
					var rdp_access = data['access'];
					var rdp_hosting = data['hosting'];
					var rdp_seller = data['seller'];
					$('.rdp_state').html();
					$('.rdp_state').html(rdp_state);
					$('.rdp_city').html();
					$('.rdp_city').html(rdp_city);
					$('.rdp_windows').html();
					$('.rdp_windows').html(rdp_windows);
					$('.rdp_access').html();
					$('.rdp_access').html(rdp_access);
					$('.rdp_hosting').html();
					$('.rdp_hosting').html(rdp_hosting);
					$('.rdp_seller').html();
					$('.rdp_seller').html(rdp_seller);
				}
				});
			 
			 
			 });
			 $('.filterselect').change(function () {
				 $('#filterbutton').prop('disabled', false);
				 });
				 $('.filterinput').keyup(function () {
					 $('#filterbutton').prop('disabled', false);
					 });
</script>


<script type="text/javascript">
$('.rdp_state').on('change',function(){
	var cvl = $(this).val();
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
		 }else{
			 $(this).show(); 
			 }
			 }); 
			 $('#filterbutton').prop('disabled', true);
			 
			 
			 $.ajax({
                type: "POST",
                url: 'getrdpstate.php',
                data: {"cvl":cvl},
               	dataType: 'json',
                success: function(data){
					/*console.log(data);
					console.log(data['state']);*/
					/*$('.shell_hostings').html('<option value="">All</option>');
					$('.shell_hostings').html(data);*/
					
				    var rdp_country = data['country'];
					var rdp_city = data['city'];
					var rdp_windows = data['windows'];
					var rdp_access = data['access'];
					var rdp_hosting = data['hosting'];
					var rdp_seller = data['seller'];
					/*$('.rdp_country').html();
					$('.rdp_country').html(rdp_country);*/
					$('.rdp_city').html();
					$('.rdp_city').html(rdp_city);
					$('.rdp_windows').html();
					$('.rdp_windows').html(rdp_windows);
					$('.rdp_access').html();
					$('.rdp_access').html(rdp_access);
					$('.rdp_hosting').html();
					$('.rdp_hosting').html(rdp_hosting);
					$('.rdp_seller').html();
					$('.rdp_seller').html(rdp_seller);
				}
				});
			 
			 
			 
			 });
			 $('.filterselect').change(function () {
				 $('#filterbutton').prop('disabled', false);
				 });
				 $('.filterinput').keyup(function () {
					 $('#filterbutton').prop('disabled', false);
					 });
</script>


<script type="text/javascript">
$('.rdp_city').on('change',function(){
	var cvl = $(this).val();
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
		 }else{
			 $(this).show(); 
			 }
			 }); 
			 $('#filterbutton').prop('disabled', true);
			 
			  $.ajax({
                type: "POST",
                url: 'getrdpcity.php',
                data: {"cvl":cvl},
               	dataType: 'json',
                success: function(data){
					/*console.log(data);
					console.log(data['state']);*/
					/*$('.shell_hostings').html('<option value="">All</option>');
					$('.shell_hostings').html(data);*/
					
				    var rdp_country = data['country'];
					var rdp_state = data['state'];
					var rdp_windows = data['windows'];
					var rdp_access = data['access'];
					var rdp_hosting = data['hosting'];
					var rdp_seller = data['seller'];
					/*$('.rdp_country').html();
					$('.rdp_country').html(rdp_country);*/
					$('.rdp_state').html();
					$('.rdp_state').html(rdp_state);
					$('.rdp_windows').html();
					$('.rdp_windows').html(rdp_windows);
					$('.rdp_access').html();
					$('.rdp_access').html(rdp_access);
					$('.rdp_hosting').html();
					$('.rdp_hosting').html(rdp_hosting);
					$('.rdp_seller').html();
					$('.rdp_seller').html(rdp_seller);
				}
				});
			 
			 
			 
			 });
			 $('.filterselect').change(function () {
				 $('#filterbutton').prop('disabled', false);
				 });
				 $('.filterinput').keyup(function () {
					 $('#filterbutton').prop('disabled', false);
					 });
</script>


<script type="text/javascript">
$('.rdp_windows').on('change',function(){
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
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



<script type="text/javascript">
$('.rdp_access').on('change',function(){
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
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


<script type="text/javascript">
$('.rdp_hosting').on('change',function(){
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
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
<script type="text/javascript">
$('.rdp_seller').on('change',function(){
	 $("#table tbody tr").each(function() { 
	 var ck1 = $.trim( $(this).find("#rdp_country").text().toLowerCase() );
	 var ck2 = $.trim( $(this).find("#rd_state").text().toLowerCase() );
	 var ck3 = $.trim( $(this).find("#rdp_city").text().toLowerCase() );
	 var ck4 = $.trim( $(this).find("#rdp_windows").text().toLowerCase() );
	 var ck5 = $.trim( $(this).find("#rdp_access").text().toLowerCase() ); 
	 var ck6 = $.trim( $(this).find("#rdp_hosting").text().toLowerCase() ); 
	 var ck7 = $.trim( $(this).find("#rdp_seller").text().toLowerCase() ); 
	 var val1 = $.trim( $('select[name="rdp_country"]').val().toLowerCase() );
	 var val2 = $.trim( $('select[name="rdp_state"]').val().toLowerCase() );
	 var val3 = $.trim( $('select[name="rdp_city"]').val().toLowerCase() );
	 var val4 = $.trim( $('select[name="rdp_windows"]').val().toLowerCase() );
	 var val5 = $.trim( $('select[name="rdp_access"]').val().toLowerCase() ); 
	 var val6 = $.trim( $('select[name="rdp_hosting"]').val().toLowerCase() ); 
	 var val7 = $.trim( $('select[name="rdp_seller"]').val().toLowerCase() ); 
	 if((ck1 != val1 && val1 != '' ) || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || (ck4 != val4 && val4 != '' ) || (ck5 != val5 && val5 != '' ) || (ck6 != val6 && val6 != '' ) || (ck7 != val7 && val7 != '' )){
		 $(this).hide();
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
