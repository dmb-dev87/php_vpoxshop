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
									<div class="well well-sm">

<h2><center><small><font color="#080C39"><span class="glyphicon glyphicon-info-sign"></span></small></font> How to report a bad item ?	</h2>
  <p align="center"><b>Account</b> &gt; <b>My Orders</b> then choose the item you want to report and click on <b>Report</b> button.</p>
                    </div>
           <style>
		   .backg{
			   background:lightblue !important;
		   }
		   </style>
<table width="100%" class="table table-striped table-bordered table-condensed" id="table">
<thead>
            <tr>
                                  <th scope="col"></th>
  <th scope="col">ID</th>
  <th scope="col">Date Created</th>
   <th scope="col">Order ID</th>
    <th scope="col">Item Type</th>
    <th scope="col">Seller</th>
  <th scope="col" >Report State</th>
  <th scope="col">Last Reply</th>
    <th scope="col" >Last Updated</th>
            </tr>
        </thead>
 <tbody id='tbody2'>
 <?php
 $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
 $q = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' ORDER BY id DESC")or die(mysqli_error());
 while($row = mysqli_fetch_assoc($q)){
	  
     $st = $row['status'];
    switch ($st){
      case "0" :
       $st = "Resolved";
       break;
      case "1" :
       $st = "Pending";
       break;
      case "2":
       $st = "Pending";
       break;
    }
		if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
		if (empty($row['orderid'])) {
		$orderid = "n/a"; 
		} else { 
		$orderid = $row['orderid']; 	
		}
	 	    $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
$idreport = $row['id'];

if($row['seen'] == '1'){
	$clas = 'backg';
}else{
	$clas = '';
}
$today=date('Y-m-d H:i:s');
//echo $lastup;
//$date = new DateTime($lastup);
//$new_date_format = $date->format('Y-m-d H:i:s');
//echo "<br>".$new_date_format;
$lastuparr=explode(' ',$lastup);
if($lastuparr[2]=='pm')
{
    //echo $lastuparr[1]; echo "--";
    $lastuparr_h=explode(':',$lastuparr[1]);
    if($lastuparr_h[0]<12){ $lastuparr_h[0]=$lastuparr_h[0]+12;}
    $lastuparr[1]=implode(':',$lastuparr_h);
    //echo $lastuparr[1];
}
$lastuparr_d=explode('/',$lastuparr[0]);
$lastuparr[0]=$lastuparr_d[2].'-'.$lastuparr_d[1].'-'.$lastuparr_d[0];
$new_d2=date('Y-m-d H:i:s',strtotime($lastuparr[0].' '.$lastuparr[1]));
//echo "<pre>"; print_r($lastuparr[2]);
$d2=date('Y-m-d H:i:s',strtotime($lastup));
//echo $d2; echo "--";
		$start = new DateTime($new_d2);
		$end   = new DateTime($today); // Current date time
		$diff  = $start->diff($end);
//echo $today; echo "<pre>";print_r($diff);echo "<br>";
//print_r($diff);
		if($diff->y){ $tago=  $diff->y . ' years ago ';}// return $d2
		elseif($diff->m){$tago=  $diff->m . ' months ago ';}// return $d2
		elseif($diff->d){$tago=  $diff->d . ' days ago ';}
		elseif($diff->h){$tago=  $diff->h . ' hours ago ';}
		elseif($diff->i){$tago=  $diff->i . ' minutes ago ';}
		elseif($diff->s){$tago=  $diff->s . ' seconds ago';}
?>
<tr style="cursor: pointer;" class="<?php echo $clas ?>" onclick="pageDiv('report<?php echo $idreport; ?>','Report #<?php echo $idreport; ?> - Vpox SHOP','showReport<?php echo $idreport; ?>.html',0);">
<?php
echo "     <td>  </td>
 <td> ".$row['id']." </td>
    <td> ".$row['date']." </td>
    <td> ".$orderid." </td>
    <td> ".strtolower($row['acctype'])." </td>
    <td> ".$SellerNick."</td>
    <td> ".$st."</td>
    <td> ".$row['lastreply']." </td>
    <td> ".$tago." </td>
            </tr>
     ";
 }

 ?>

</tbody>
 </table>