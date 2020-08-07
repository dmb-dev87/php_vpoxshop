<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";
error_reporting(0);
if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: login.html");
    exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<?php

echo '

    <script>

function sendt(id){

    var sub = $("#subject").val();
    var msg = $("#msg").val();
    var pr = $("#proi"+id).val();
     $.ajax({
     method:"GET",
     url:"CreateTicket.html?s="+btoa(sub)+"&m="+btoa(msg),
     dataType:"text",
     success:function(data){
     $("#resulta").html(data).show();
     },
   });
}

    </script>
               <ul class="nav nav-tabs">
    <li class=""><a href="#mytickets" data-toggle="tab" aria-expanded="true">My Tickets</a></li>
    <li class="active"><a href="#open" data-toggle="tab" aria-expanded="false"> <span class="glyphicon glyphicon-pencil"></span> New Ticket</a></li>
</ul>    		

<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="open"> 
    <div class="form-group col-lg-5 ">
          <h3>Support Tickets</h3>
									 <b> What can we help you with?</b><br>
									 <select class="form-control" id="subject" name="title" required="">
									<option value="" selected=""></option>								
									<option value="Please include your Payment Details.">Deposit Issue (Add Balance Issue)</option>
									<option value="Please include Order id.">Bad Item/Order</option>
									<option value="Please include Report id.">Report Issue</option>
									<option value="Account Issue">VpoxShop Account Issue</option>
									<option value="Complaint/Problem">Complaint/Problem</option>
									<option value="Apply for Seller">Apply for Seller</option>
									<option value="Other">Other</option>
								</select>
									 
<br><b>Message</b>
<br>
<textarea id="msg'.$row['id'].'" class="form-control" name="memo" style="width: 100%; height: 150px;" placeholder="Message Here" required></textarea>
<br>
<center><button type="submit" value="Open ticket"  class="btn btn-primary" onclick="javascript:sendt('.$row['id'].');" style="float:left">Submit <span class="glyphicon glyphicon-chevron-right"></span></button </center>
<br><br> </center><div id="resulta"> </div>

 </div><br><br>
 <div class="col-lg-7">
      <div class="bs-component">
        <div class="well well">
          <ul>
			            <li>If you want to refund an order : 
			            	<ul>
			            		<li>Go to  <a href="orders.html" title="Account- My Orders or Click here" style="color:black">My Account -&gt; My Orders  <i class="fa fa-shopping-cart"></i></a></li>
			            		<li>Choose the order you want to refund</li>
			            		<li>Then click on refund button </li>
			            	</ul>
			            </li>
			            <li>Please avoid opening multiple tickets, Just open one and include all the info you want in it</li>
			            
			          </ul>
        </div>
      </div>
    </div>
 </div>

';
//<input type="text" placeholder="Seller request.." class="form-control" id="subject" required></input>
 $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
//echo "SELECT * FROM ticket WHERE uid='$uid' ORDER by id desc";
  $qq = @mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' ORDER by id desc") or die("error here");
echo '	 		<br>
 
    <div class="tab-pane fade in" id="mytickets"> 

<table width="100%" class="table table-striped table-bordered table-condensed" id="table">
      <thead>
        <tr>
              <th scope="col"></th>
          <th scope="col">ID</th>
          <th scope="col" style="width:20%">Date Created</th>     
          <th scope="col" style="width:30%">Title</th>      
          <th scope="col">Status</th>
          <th scope="col">Last Reply</th>
          <th scope="col">Last Updated</th>
        </tr>
      </thead>
 <tbody id="tbody2">';
 while($row = mysqli_fetch_assoc($qq)){
     $st = $row['status'];
    switch ($st){
      case "0" :
       $st = "closed";
       break;
      case "1" :
       $st = "open";
       break;
      case "2":
       $st = "open";
       break;
    }
    $idticket = $row['id'];
	if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
?>
<tr onmouseover="this.style.cursor='pointer'" onclick="pageDiv('ticket<?php echo $idticket; ?>','Ticket #<?php echo $idticket; ?> - VPOX SHOP','showTicket<?php echo $idticket; ?>.html',0);" style="cursor: pointer;">   
<?php
if ($row['seen'] == "1") {
	echo "
     <td>  </td>
 <td> <b>".htmlspecialchars($row['id'])." </b></td>
    <td><b> ".htmlspecialchars($row['date'])." </b></td>
    <td><b> ".htmlspecialchars($row['subject'])." </b></td>
    <td> <b>".$st." </b></td>
	    <td><b> ".htmlspecialchars($row['lastreply'])." </b></td>
	    <td><b> ".htmlspecialchars($lastup)." </b></td>
            </tr>
"; } else {
echo "
     <td>  </td>
 <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".htmlspecialchars($row['date'])." </td>
    <td> ".htmlspecialchars($row['subject'])." </td>
    <td> ".$st."</td>
	    <td> ".htmlspecialchars($row['lastreply'])." </td>
	    <td> ".htmlspecialchars($lastup)." </td>
            </tr>
     ";
 } }

 echo '

 </tbody>
 </table>'; 
				?>
