<nav class="navbar navbar-default navbar-fixed-top ">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <div class="navbar-brand" onClick="location.href='index.html'" onMouseOver="this.style.cursor='pointer'"><b><span class="glyphicon glyphicon-fire"></span> Vpox SHOP <small><!--<span class="glyphicon glyphicon-refresh"></span>--></small></b></div></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-server"></i>&nbsp;Hosts <span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="rdp.html" onclick="pageDiv(1,'RDP - VpoxShop','rdp.html',0); return false;"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;RDPs <span class="label label-primary label-as-badge" id="rdp"></span></a></li>
			<li><a href="ssh.html" onclick="pageDiv(16,'Ssh - VpoxShop','ssh.html',0); return false;"><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;_SSH(VPS) <span class="label label-primary label-as-badge" id="ssh"></span></a></li>
            <li><a href="cPanel.html" onclick="pageDiv(2,'cPanel - VpoxShop','cPanel.html',0); return false;"><i class="fa fa-tools" aria-hidden="true"></i>&nbsp;cPanels <span class="label label-primary label-as-badge" id="cpanel"></span></a></li>
            <li><a href="shell.html" onclick="pageDiv(3,'Shell - VpoxShop','shell.html',0); return false;"><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;Shells <span class="label label-primary label-as-badge" id="shell"></span></a></li>  
			  
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-mail-bulk" aria-hidden="true"></i>&nbsp;Send <span class="doar" id="mail"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="mailer.html" onclick="pageDiv(4,'PHP Mailer - VpoxShop','mailer.html',0); return false;"><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;PHP Mailers <span class="label label-primary label-as-badge" id="mailer"></span></a></li>
            <li><a href="smtp.html" onclick="pageDiv(5,'SMTP - VpoxShop','smtp.html',0); return false;"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;SMTPs <span class="label label-primary label-as-badge" id="smtp"></span></a></li>  
			
          </ul>
        </li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-paper-plane" aria-hidden="true"></i>
Dedicated SMTPs <span class="doar" id="dsmtps"></span></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php
			$typesmtp=$_GET['smtp'];
$arr=array('ionos','strato','tonline','rackspace','godaddy','office365');
$arr1=array('1and1 IONOS','Strato','T-online','Rackspace','GoDaddy','Office365');
foreach($arr as $key=>$val)
{
			?>
			<li><a href="dsmtp.html?smtp=<?php echo $val;?>" onclick="pageDiv(17,'DSMTP - VpoxShop','dsmtp.html?smtp=<?php echo $val;?>',0); return false;"><?php
			echo $arr1[$key];
			?> <span class="label label-primary label-as-badge" id="dsmtp_<?php echo $val;?>"></span></a></li>  
			<?php
}
			?>
          </ul>
        </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;Leads <span class="doar" id="all_leads"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="leads.html" onclick="pageDiv(6,'Leads - VpoxShop','leads.html',0); return false;"><i class="fa fa-at" aria-hidden="true"></i>&nbsp;Leads <span class="label label-primary label-as-badge" id="leads"></span></a></li>
          </ul>
        </li>  
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Accounts <span class="doar" id="accounts"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="premium.html" onclick="pageDiv(7,'Premium/Dating/Shop - VpoxShop','premium.html',0); return false;"><img src="img/premium.png" height="22px" width="22px">&nbsp;Premium/Dating/Shop <span class="label label-primary label-as-badge" id="premium"></span></a></li>
            <li><a href="banks.html" onclick="pageDiv(8,'Banks - VpoxShop','banks.html',0); return false;"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Banks <span class="label label-primary label-as-badge" id="banks"></span></a></li>  
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;Others <span class="doar" id="accounts"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="scampage.html" onclick="pageDiv(9,'Scampages - VpoxShop','scampage.html',0); return false;"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Scampage <span class="label label-primary label-as-badge" id="scams"></span></a></li>
            <li><a href="tutorial.html" onclick="pageDiv(10,'Tutorials - VpoxShop','tutorial.html',0); return false;"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Tutorial <span class="label label-primary label-as-badge" id="tutorials"></span></a></li>  
          </ul>
        </li>
                      
      </ul>
      <ul class="nav navbar-nav navbar-right">
                        <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT resseller FROM users WHERE username='$uid'") or die(mysqli_error());
$r         = mysqli_fetch_assoc($q);
$reselerif = $r['resseller'];
if ($reselerif == "1") {
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    $q = mysqli_query($dbcon, "SELECT soldb FROM resseller WHERE username='$uid'") or die(mysqli_error());
    $r = mysqli_fetch_assoc($q);

    echo '<li><a href="seller/index.html"><span class="badge" title="Seller Panel"><span class="glyphicon glyphicon-cloud"></span><span id="seller"></span></span></a></li>';
} else {
} ?>      
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Tickets <span id="alltickets">
<?php
$sze112  = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' and seen='1'");
$r844941 = mysqli_num_rows($sze112);
if ($r844941 == "1") {
    echo '<span class="label label-danger">1</span>';
}
?>
<?php
$sze112  = mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' and seen='1'");
$r844941 = mysqli_num_rows($sze112);
if ($r844941 == "1") {
    echo '<span class="label label-danger">1</span>';
}
?>
</span><span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="tickets.html" onclick="pageDiv(11,'Tickets - VpoxShop','tickets.html',0); return false;"><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Tickets <span class="label label-info"><span id="tickets"></span></span><?php
$s1 = mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' and seen='1'");
$r1 = mysqli_num_rows($s1);
if ($r1 == "1") {
    echo '<span class="label label-success"> 1 New</span>';
}
?></span></a></li>
            <li><a href="reports.html" onclick="pageDiv(12,'Reports - VpoxShop','reports.html',0); return false;"><i class="fa fa-flag" aria-hidden="true"></i>&nbsp;Reports <span class="label label-info"><span id="reports"></span></span> <?php
$s1 = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' and seen='1'");
$r1 = mysqli_num_rows($s1);
if ($r1 == "1") {
    echo '<span class="label label-success"> 1 New</span>';
}
?></span> </a></li>

           </ul>
        </li>

        <li><a href="addBalance.html" onclick="pageDiv(13,'Add Balance - VpoxShop','addBalance.html',0); return false;"><span class="badge balc"><b><span id="balance"></span></b> <i class="fas fa-plus-circle"></i><span> </a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;My Account  <span class="doar" id="alhosts"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="setting.html" onclick="pageDiv(14,'Setting - VpoxShop','setting.html',0); return false;"><i class="fas fa-user-cog"></i>&nbsp;Setting </a></li>
            <li><a href="orders.html" onclick="pageDiv(15,'Orders - VpoxShop','orders.html',0); return false;"> <i class="fas fa-shopping-cart"></i>&nbsp;My Orders</a></li>
            <li><a href="addBalance.html" onclick="pageDiv(13,'Add Balance - VpoxShop','addBalance.html',0); return false;"><i class="fas fa-dollar-sign"></i>&nbsp;Add Balance </a></li> 
            <li><a href="logout.html" ><i class="fas fa-sign-out-alt"></i>&nbsp;Logout </a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>