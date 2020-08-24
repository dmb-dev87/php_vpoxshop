<?php 
include "includes/config.php";
include("cr.php");
$id = $_POST['id'];

$qu = mysqli_query($dbcon, "SELECT * FROM leads WHERE acctype='leads' AND id='$id'")or die(mysqli_error($dbcon));



 while($row = mysqli_fetch_assoc($qu)){
	 
	 $countryfullname = $row['country'];

	  $code = array_search("$countryfullname", $countrycodes);

	 $countrycode = strtolower($code);
	 
 
 
 
$fd = explode(",",$row['sample']);

$samp = "";
for($i=0;$i<=count($fd); $i++){
	$vals = $fd[$i];
	$em = explode("@",$vals);
	$name = $em[0];
	$len = strlen($name);
	$showLen = floor($len/2);
	$str_arr = str_split($name);
	for($ii=$showLen;$ii<$len;$ii++){
    $str_arr[$ii] = '*';
	}
	$em[0] = implode('',$str_arr); 
	$new_name = implode('@',$em);
 
	$samp .= '<span>'.$new_name.'</span><br />';
}


$urt = $row['url'];
$trf   = explode('/',$urt);
$o = parse_url($urt, PHP_URL_HOST);
$rtx = explode('.',$o);
$domain = end($rtx);
?>
<?php
echo "
<h4 style='border-bottom: 1px solid gainsboro;margin-top: -15px;line-height: 50px;'>Leads #".$row['id']."</h4>
<table class='table'>
	<tbody><tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Emails Sample</td>
	  <td>".$samp."</td>
	</tr>	
	<tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Country</td>
	  <td><i class='flag-icon flag-icon-".$countrycode."'></i>&nbsp;".$row['country']."</td>
	</tr>
	<tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Source</td>
	  <td>".$row['infos']."</td>
	</tr>
	 	<tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Domain</td>
	  <td>.".$domain."</td>
	</tr>
	 
	<tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Number</td>
	  <td>".$row['number']."</td>
	</tr>
	<tr style='border-bottom: 1px solid gainsboro;'>
	  <td>Price</td>
	  <td>".$row['price']."$</td>
	</tr>
	
	<tr>
	  <td>Buy</td>
	  <td><span id='leads".$row['id']."' title='buy' type='leads'><a onclick='javascript:buythistool(".$row['id'].")' class='btn btn-primary btn-xs'><font color=white>Buy</font></a></span></td>
	</tr>
	 	
</tbody></table>
";

?>

 <?php } ?>