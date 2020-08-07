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

	<h2>cPanels</h2>
  <script>

function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dcp.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}

</script>
 
 
	<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','cpanelTab1.php?id=<?php echo $uid ?>')">All</a></li>
		<li class=""><a href="#deleted" data-toggle="tab" aria-expanded="false">Deleted</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','cpanelTab2.php')">Add</a></li>
		<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','cpanelTab3.php')">Mass Add</a></li>
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
     <div class="well well-sm">
        <h4>Rules</h4>
        <ul> 
          <li>Please choose a source of your cpanels</li>
          <ul> 
            <li><b>Carded or Created</b>: Created by you with a random empty domain and etc (even if the server is hacked it's still created)</li>
            <li><b>Hacked</b>: hacked cpanel.</li>
          </ul>

          <li>You can choose the price you want but the usual price between <b>2$</b>-<b>6$</b></li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of cpanels : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM cpanels where resseller='$uid'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold cpanels : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM cpanels where resseller='$uid' and sold='0'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold cpanels : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM cpanels where resseller='$uid' and sold='1'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Deleted cpanels : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM cpanels where resseller='$uid' and sold='deleted'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
        </ul>
      </div>
      </div>
	  
	<div class="tab-pane fade" id="all"></div>
	<div class="tab-pane fade" id="deleted">
	 <table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header">
                <thead>
  <tr>
  <th></th>
  <th>ID</th>
  <th>Type</th>
  <th>Country</th>
  <th>Information</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
 <?php
/*$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);*/
$qu = mysqli_query($dbcon, "SELECT * FROM cpanels WHERE acctype='cpanel' AND resseller='$uid' And sold='deleted' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='stufs-tabel'>
    <td> </td>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['acctype']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row["sold"] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row["sold"] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
	    echo "<font color=green>[Sold]</font>";
	}
    echo "</td>
    </tr>";


 }

 ?>

 
 </table>
	</div>
    <div class="tab-pane fade" id="add"></div>
    <div class="tab-pane fade" id="mass"></div>

</div>
</div></div>
            </div>
            </div>
        </div>
