 <?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";
/*
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = $_REQUEST['id'];
  
?>
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
$qu = mysqli_query($dbcon, "SELECT * FROM ssh WHERE acctype='shell' AND resseller='$uid' And sold != 'deleted'	ORDER BY id DESC")or die(mysql_error());

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