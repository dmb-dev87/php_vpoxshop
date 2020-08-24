<?php
include "./header.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}


?>
<script>
$('#dataTable').dataTable( {
  "lengthChange": false
});
function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/d_smtp.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}



</script>
	<h2>Dedicated SMTPs</h2>
<?php
session_start();

date_default_timezone_set('UTC');

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$wherecond='';
$typesmtp=$_GET['smtp'];
$arr=array('ionos','strato','tonline','rackspace','godaddy','office365');
if(!in_array($typesmtp,$arr))
{
	$typesmtp='';	
}
else
{
	$wherecond=" AND typesmtp='$typesmtp'";
}
?> 

<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','dsmtpTab1.php?smtp=<?php echo $typesmtp;?>')">All</a></li>		
		<li class=""><a href="#deleted" data-toggle="tab" aria-expanded="false" >Deleted</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','dsmtpTab2.php?id=<?php echo $uid ?>&smtp=<?php echo $typesmtp;?>')">Add</a></li>
		<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','dsmtpTab3.php?id=<?php echo $uid ?>&smtp=<?php echo $typesmtp;?>')">Mass Add</a></li> 
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
<div class="well well-sm">
        <h4>Rules</h4>
        <ul> 
          <li>Just insert Webmails normally and our checker will detect it </li>
          <li>You can choose the price you want but the usual price between <b>2$</b>-<b>6$</b></li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of SMTPs : <b><?php
		  $s12 = mysqli_query($dbcon, "SELECT * FROM dsmtps where resseller='$uid' $wherecond");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM dsmtps where resseller='$uid' and sold='0' $wherecond");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM dsmtps where resseller='$uid' and sold='1' $wherecond");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Deleted SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM dsmtps where resseller='$uid' and sold='deleted' $wherecond");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
        </ul>
      </div>
      </div>
	  
	<div class="tab-pane fade" id="all"></div>	<div class="tab-pane fade" id="deleted">			<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header">				<thead>  <tr>  <th>ID</th>  <th>Type</th>  <th>Country</th>  <th>Item information</th>  <th>Price</th>  <th>Action</th>  </tr>        </thead>		 <tbody ><?php $qu = mysqli_query($dbcon, "SELECT * FROM dsmtps WHERE acctype='smtp' AND resseller='$uid' ORDER BY id DESC")or die(mysqli_error($dbcon)); while($row = mysqli_fetch_assoc($qu)){	 	 if ($row['sold'] == "0") { $ax =  '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>'; }elseif ($row['sold'] == "deleted") {	$ax =  "<font color=gray>Deleted</font>"; } else {$ax =  "<font color=green>[Sold]</font>";	    	}	 ?><tr class='smtps-tabel'>    <td> <?php echo htmlspecialchars($row['id']) ?> </td>    <td> <?php echo strtoupper(htmlspecialchars($row['acctype'])) ?> </td>    <td> <?php echo htmlspecialchars($row['country']) ?> </td>    <td> <?php echo htmlspecialchars($row['url']) ?> </td>    <td> <?php echo htmlspecialchars($row['price']) ?></td>    <td> 	<?php echo $ax; ?>    </td>    </tr> <?php } ?> </tbody> </table>		</div>
    <div class="tab-pane fade" id="add"></div>    <div class="tab-pane fade" id="mass"></div>

</div>
</div></div>
            </div>
            </div>
        </div>