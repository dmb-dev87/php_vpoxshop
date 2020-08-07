<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon,"SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	   <?php
          $uid     = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
          $q = mysqli_query($dbcon, "SELECT resseller FROM users WHERE username='$uid'")or die(mysqli_error());
          $r = mysqli_fetch_assoc($q);
		  $reselerif = $r['resseller'];
       if ($reselerif == "1") { 
          $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
          $q = mysqli_query($dbcon, "SELECT soldb FROM resseller WHERE username='$uid'")or die(mysqli_error());
          $r = mysqli_fetch_assoc($q);
		
							echo'';
	   } else { }
						        ?>
<link rel="shortcut icon" href="../files/img/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vpox Seller</title>
	<link rel="stylesheet" type="text/css" href="../files/css/flags.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../buyer/assets/flags.css">
    <link rel="stylesheet" type="text/css" href="css/tickets.css">
	<script type="text/javascript" src="./assets/jquery.js"></script>
	<script type="text/javascript" src="./assets/bootstrap.js"></script>
	<script type="text/javascript" src="./assets/bootbox.min.js"></script>
	<script type="text/javascript" src="./assets/sorttable.js"></script>
    <link href="./assets/style.css" rel="stylesheet">

    <style>
.sort {
  .sortable
}
.sort th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25BE" 
}
</style>
<style>
.content {
	display:none;
}

</style>
<script type="text/javascript">
    function ajaxinfo(){
      $.ajax({
      type:       'GET',
      url:        'ajaxinfo.html',
      timeout: 10000 ,

           success: function(data){
              if (data != '01'){
                var data = JSON.parse(data);
                  for (var prop in data) {
                  $("#"+prop).html(data[prop] ).show();
                }
              }
              else {
                window.location = "logout.html";
              }
           }
         });

  }
    setInterval(function(){ajaxinfo()}, 3000);

 ajaxinfo();
	</script>
</head>


<body>

    <div id="wrapper">
    <div id="sidebar-wrapper">
                     <ul class="sidebar-nav">
 
                <li class="sidebar-brand"><a href="./index.html"><div class="navbar-brand" style="padding: 19.5px 0px;" onclick="location.href=&#39;index.html&#39;"><font color="white"><b><span class="glyphicon glyphicon-fire"></span> Seller Panel</b></font></div></a></li>
                <li><a href="<?php echo BASEURL;?>" onclick="window.open(this.href);return false;"><font color="white">Back to Vpox SHOP <span class="glyphicon glyphicon-share-alt"></span></font></a></li>

                <li><font color="white"><b>Seller Dashboard</b></font></li>
                    <li><a href="./index.html" style="cursor: pointer;"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;&nbsp;Main</a></li>
		  <?php
          $uid     = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
          $qerd = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$uid'")or die(mysqli_error());
          $rers = mysqli_fetch_assoc($qerd);
        ?>
                    <li><a href="./sales.html" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Sales <div id="sales" class="label label-info"></div></a></li>
                    <li><a href="./withdraw.html" style="cursor: pointer;"><i class="fa fa-usd"></i>&nbsp;&nbsp;Withdraw</a></li>
                    <li><a href="./reports.html" style="cursor: pointer;"><i class="fa fa-flag" aria-hidden="true"></i>&nbsp;&nbsp;My Reports <?php 
					$s1 = mysqli_query($dbcon, "SELECT * FROM reports WHERE resseller='$uid' AND status='1' OR status='2'");
					$r1=mysqli_num_rows($s1);
					if (strpos($r1,'0') !== false) {
} else {
echo '<div id="reports" class="label label-danger"></div>'; }?></a></li>			

                <li><font color="white"><b>Tools Management</b></font></li>
                    <li><a href="./rdp.html" style="cursor: pointer;"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;&nbsp;RDP <span id="rdp" class="label label-info"></span></a></li>
					<li><a href="./ssh.html" style="cursor: pointer;"><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;&nbsp;SSH(VPS) <span id="ssh" class="label label-info"></span></a></li>
                    <li><a href="./shell.html" style="cursor: pointer;"><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;&nbsp;Shell <span id="shell" class="label label-info"></span></a></li>
					
                    <li><a href="./cpanel.html" style="cursor: pointer;"><i class="fa fa-tools" aria-hidden="true"></i>&nbsp;&nbsp;cPanel <span id="cpanel" class="label label-info"></span></a></li>
				<li><a href="./mailer.html"><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;&nbsp;PHP Mailer <span id="mailer" class="label label-info"></span></a></li>
	<li><a href="./smtp.html"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;SMTP <span id="smtp" class="label label-info"></span></a></li>
	<li><a href="./dsmtp.html"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Dedicated SMTP <span id="dsmtp" class="label label-info"></span></a>
	<!--<ul>
		<li><a href="./dsmtp.html?smtp=ionos"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;1and1 IONOS<span id="dsmtp" class="label label-info"></span></a></li>
		<li><a href="./dsmtp.html?smtp=strato"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Strato webmail<span id="dsmtp" class="label label-info"></span></a></li>
		<li><a href="./dsmtp.html?smtp=tonline"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;T-online webmail<span id="dsmtp" class="label label-info"></span></a></li>
		<li><a href="./dsmtp.html?smtp=rackspace"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Rackspace webmail<span id="dsmtp" class="label label-info"></span></a></li>
		<li><a href="./dsmtp.html?smtp=godaddy"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;GoDaddy webmail<span id="dsmtp" class="label label-info"></span></a></li>
		<li><a href="./dsmtp.html?smtp=office365"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Office365 webmail<span id="dsmtp" class="label label-info"></span></a></li>
	</ul>-->
	</li>
                    <li><a href="./leads.html"><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;&nbsp;Leads <span id="leads" class="label label-info"></span></a></li>
                    <li><a href="./scampage.html"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;Scampage <span id="scams" class="label label-info"></span></a></li>
                    <li><a href="./tutorial.html"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Tutorial/Method <span id="tutorials" class="label label-info"></span></a></li>
           <li><a href="./banks.html"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;&nbsp;Bank Accounts <span id="banks" class="label label-info"></span></a></li>
	      <li><a href="./premium.html"><img src="../img/premium.png" height="22px" width="22px">&nbsp;&nbsp;Premium/Shop/Dating <span id="premium" class="label label-info"></span></a></li>		
            </ul>

 


        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <b><span id="menu-toggle" onmouseover="this.style.cursor='pointer'"><span class="glyphicon glyphicon-indent-right"></span></span></b>
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <div id="divPage">
 <script>
    var v_aa =0;
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if (v_aa == 1) {
          $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-right"></span>').show();
          v_aa =0;
        }
        else {
          $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-left"></span>').show();
          v_aa =1;     
        }
        
    });

    </script>
<div class="row">
<script>
	$(function() {
		$(".preload").fadeOut(900, function() {
			$(".content").fadeIn(0);
		});
	});
	function TabDiv(n,u){
        $("#all").html('').show();
        $("#delete").html('').show();
        $("#add").html('').show();
        $("#massadd").html('').show();
        $("#unsold").html('').show();

        $("#"+n).html('<div id="mydiv"><img  src="../img/loadTab.gif" class="ajax-loader"></div>').show();
        $.ajax({
            type:       'GET',
            url:        u,
            success:    function(data)
            {
                $("#"+n).html(data).show();
                newTableObject = document.getElementById('table');sorttable.makeSortable(newTableObject);
            }
        });  
    }
</script>  
<div class="preload">
    <div id="mydiv">
        <img src="img/wait.gif" class="ajax-loader">
    </div>  
</div>

<div class="content">

