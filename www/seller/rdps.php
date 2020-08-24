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
     url:"./ajax/drdps.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}



</script>
	<h2>RDP</h2>
<?php
ob_start();
session_start();

date_default_timezone_set('UTC');

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?> 


       <ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','rdpTab1.php')">All</a></li>
		<li class=""><a href="#deleted" data-toggle="tab" aria-expanded="false" >Deleted</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','rdpTab2.php')">Add</a></li>
	<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','rdpTab3.php?id=<?php echo $uid ?>')">Mass Add</a></li>
	</ul> 
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
    <div class="well well-sm">
        <h4>Rules</h4>
        <ul> 
          <li>Please only insert Working RDPs And Exactly <b>Ram</b> on it </li>
          <li>You can choose the price you want but the usual price Depend on Ram and Windows Type : example</li>
            <ul> 
              <li>2003 User: <b>5-8$</b></li>
              <li>2003 Admin: <b>7-10$</b></li>
               <li>2008/2012 User: <b>6-10$</b></li>
              <li>2008/2012 Admin: <b>10-15$</b></li>             
            </ul>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that we have checked the rdp and didn't work with us so we simply deleted it </li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of RDPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM rdps where resseller='$uid'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold RDPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM rdps where resseller='$uid' and sold='0'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold RDPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM rdps where resseller='$uid' and sold='1'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Deleted RDPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM rdps where resseller='$uid' and sold='deleted'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
        </ul>
      </div>
      </div>
	  
	<div class="tab-pane fade" id="all"></div>
	<div class="tab-pane fade" id="deleted">
	 <table width="100%" class="table table-striped table-bordered table-condensed sticky-header" >
				<thead>
  <tr>
  <th>ID</th>
  <th>Type</th>
  <th>Country</th>
  <th>City</th>
  <th>Hosting</th>
  <th>Ram</th>
  <th>Item information</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		 <tbody id=''>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM rdps WHERE acctype='rdp' AND resseller='$uid' AND sold='deleted' ORDER BY id DESC")or die(mysqli_error($dbcon));

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='rdps-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['acctype']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['city'])." </td>
    <td> ".htmlspecialchars($row['hosting'])." </td>
    <td> ".htmlspecialchars($row['ram'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";

if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }
if ($row['sold'] == "1") {
 echo '<font color=green>[Sold]</font>';
 }
if ($row['sold'] == "deleted") {
 echo '<font color=gray>Deleted</font>';
 }
    echo "</td>
    </tr>";
 }

 

 ?>

 </tbody>
 </table>
	</div>
    <div class="tab-pane fade" id="add"></div>
    <div class="tab-pane fade" id="mass"></div>

</div>
</div></div>
            </div>
            </div>
        </div>
</body></html>