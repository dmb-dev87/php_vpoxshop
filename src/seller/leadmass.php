 <?php

ob_start();

session_start();

date_default_timezone_set('UTC');

include "../includes/config.php";

$uid = $_REQUEST['oid'];


?>

<?php



   

  if(isset($_POST['start']) and $_POST['start'] == "work"){
	   $number = $_POST['details'];
	 
	$site = explode("\n", $number);
	
   $date = date("d/m/Y h:i:s a");
   
   $Total_lines = count($site); 

	$i = 0;
if($Total_lines > 20){
	echo "limit reached Max 20 smtp for request";
}else{
	  foreach ($site as $k) {

    $k = @trim($k);

	$i++;
	
	
	$d = explode("|", $k);

		$link = $d[0]; 
		$number = $d[1]; 
		$infos = $d[2]; 
		$domain = $d[3]; 
		$country = $d[4]; 
		$price = $d[5]; 

	      if ($price == 0)

{

	echo "[$i/$Total_lines]....".htmlspecialchars($link)." ...... <b>Price is not valid!</b> <br>";

} 

      else if (empty($link))

{

	echo "Complete all fields <br>";

} 

 else if (preg_match('/[^0-9]/', $price)) {

	echo "[$i/$Total_lines]....".htmlspecialchars($link)." ...... <b>Price is not valid!</b> <br>";

} else {

 $check="SELECT * FROM leads WHERE url = '$link'";

$rs = mysqli_query($dbcon,$check);

$data = mysqli_num_rows($rs);

if($data != "") {

echo "[$i/$Total_lines]....".htmlspecialchars($link)." ...... <b>Already added!</b> <br>";
} else { 

    $sqli="

  INSERT INTO leads

  (acctype,country,infos,url,price,resseller,sold,sto,dateofsold,date,number,reported,balance,domain,sample)

  VALUES

  ('leads','$country','$infos','$link','$price','$uid','0','0','0','$date','$number','0','0','$domain','0')

  ";

    $query = mysqli_query($dbcon, $sqli)or die(mysqli_error($dbcon));



  if($query){
echo "[$i/$Total_lines]....".htmlspecialchars($link)." ...... <b><font color=green>Added!</b></font> <br>";




  }else{

    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';

} }

  } }
  }
  }
?>