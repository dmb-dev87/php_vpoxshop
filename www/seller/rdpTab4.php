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