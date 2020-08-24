 <?php
error_reporting(0);
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

/*if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}*/

$uid = $_REQUEST['id'];
?>
<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
  <tr>
      <th>ID</th>
      <th>Type</th>
      <th>Country</th>
      <th>Link</th>
      <th>Price</th>
      <th>Action</th>
  </tr>
</thead>

<?php
//echo "SELECT * FROM leads WHERE acctype='leads' AND resseller='$uid' ORDER BY id DESC";
$qu = mysqli_query($dbcon, "SELECT * FROM leads WHERE acctype='leads' AND resseller='$uid' ORDER BY id DESC")or die(mysqli_error($dbcon));

 while($row = mysqli_fetch_assoc($qu)){	 	if ($row['sold'] == "0") { $data = '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>'; }elseif ($row['sold'] == "deleted") {	$data =  "<font color=gray>Deleted</font>"; } else {$data =  "<font color=green>[Sold]</font>";	    	}
	 ?><tr class='leads-tabel'>
    <td> <?php echo strtoupper(htmlspecialchars($row['id'])) ?> </td>
    <td> <?php echo strtoupper(htmlspecialchars($row['acctype'])) ?> </td>
    <td> <?php echo htmlspecialchars($row['country']) ?> </td>
    <td> <?php echo htmlspecialchars($row['url']) ?> </td>
    <td> <?php echo htmlspecialchars($row['price']) ?></td>    <td><?php echo $data ?></td></tr>
<?php }
 ?>
 </tbody>
 </table>