<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
  header("location: login.html");
  exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = mysqli_real_escape_string($dbcon, $_GET['p_data']);
?>

<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="files/bootstrap/3/css/bootstrap.css?1" />
  <link rel="stylesheet" type="text/css" href="files/css/flags.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
  <script type="text/javascript" src="files/js/jquery.js?1"></script>
  <script type="text/javascript" src="files/bootstrap/3/js/bootstrap.js?1"></script>
  <script type="text/javascript" src="files/js/sorttable.js"></script>
  <script type="text/javascript" src="files/js/table-head.js?3334"></script>
  <script type="text/javascript" src="files/js/bootbox.min.js"></script>
  <script type="text/javascript" src="files/js/clipboard.min.js"></script>

  <link rel="shortcut icon" href="files/img/favicon.ico" />
  <meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" /> 
  <meta name="referrer" content="no-referrer" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Vpox</title>
</head>

<style>
  #table {
    .sortable
  }

  table th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25BE" 
  }

  .label-as-badge {
    border-radius: 0.5em;
  }

  body {
    padding-top:50px;
  }

  table.floatThead-table {
    border-top: none;
    border-bottom: none;
    background-color: #fff;
  }

  @media (min-width: 768px) {
    .dropdown:hover .dropdown-menu {
      display: block;
    }
  }

  #mydiv {
    height: 400px;
    position: relative;
  }

  .ajax-loader {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    margin: auto; /* presto! */
  }
</style>

<script type="text/javascript">
  function ajaxinfo() {
    $.ajax({
      type: 'GET',
      url: 'ajaxinfo.html',
      timeout: 10000,
      success: function(data) {
        if (data != '01') {
          var data = JSON.parse(data);
          for (var prop in data) {
            $("#" + prop).html(data[prop]).show();
          }
        } else {
          window.location = "logout.html";
        }
      }
    });
  }

  setInterval(function() {
    ajaxinfo()
  }, 3000);

  ajaxinfo();

  $(document).keydown(function(event) {
    if(event.which=="17")
    cntrlIsPressed = true;
  });

  $(document).keyup(function() {
    cntrlIsPressed = false;
  });

  var cntrlIsPressed = false;

  function pageDiv(n,t,u,x) {
    if(cntrlIsPressed){
      window.open(u, '_blank');
      return false;
    }
    
    var obj = { Title: t, Url: u };
    if ( ("/"+obj.Url) != location.pathname) {
      if (x != 1) {
        history.pushState(obj, obj.Title, obj.Url);
      } else {
        history.replaceState(obj, obj.Title, obj.Url);
      }
    }
    document.title = obj.Title;
    ///$("#mainDiv").html('<div id="mydiv"><img src="files/img/load2.gif" class="ajax-loader"></div>').show();
    /*
    $.ajax({
      type:       'GET',
      url:        'divPage'+n+'.html',
      success:    function(data){
        $("#mainDiv").html(data).show();
        newTableObject = document.getElementById('table');
        sorttable.makeSortable(newTableObject);
        $(".sticky-header").floatThead({top:60});
        if(x==0){
          ajaxinfo();
        }
      }
    }); 
    */
    if (typeof stopCheckBTC === 'function') { 
      var a = stopCheckBTC();
    }
  }

  $(window).on("popstate", function(e) {
    location.replace(document.location);
  });

  $(window).on('load', function() {
    $('.dropdown').hover(function(){ $('.dropdown-toggle', this).trigger('click'); });
    pageDiv('payment<?php echo $p_data; ?>','Add Balance - Olux SHOP','paymentnow.html?p_data=<?php echo $p_data; ?>',0);
    var clipboard = new Clipboard('.copyit');
    clipboard.on('success', function(e) {
      setTooltip(e.trigger, 'Copied!');
      hideTooltip(e.trigger);
      e.clearSelection();
    });
  });


  function setTooltip(btn, message) {
    console.log("hide-1");
    $(btn).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
    console.log("show");
  }

  function hideTooltip(btn) {
    setTimeout(function() {$(btn).tooltip('hide'); console.log("hide-2");}, 1000);
  }
</script>

<style>
  .navbar {
    background-color: #001f3f;
  }
</style>

<body style="padding-top: 70px; padding-bottom: 70px;">
  <nav class="navbar navbar-default navbar-fixed-top ">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <div class="navbar-brand" onClick="location.href='index.html'" onMouseOver="this.style.cursor='pointer'">
          <b><span class="glyphicon glyphicon-fire"></span> Vpox SHOP <small><span class="glyphicon glyphicon-refresh"></span></small></b>
        </div>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="topFixedNavbar1">
        <ul class="nav navbar-nav">
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-server"></i>&nbsp;Hosts <span class="doar" id="alhosts"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="rdp.html" ><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;RDPs <span class="label label-primary label-as-badge" id="rdp"></span></a></li>
              <li><a href="cPanel.html" ><i class="fa fa-tools" aria-hidden="true"></i>&nbsp;cPanels <span class="label label-primary label-as-badge" id="cpanel"></span></a></li>
              <li><a href="shell.html" ><i class="fas fa-file-code" aria-hidden="true"></i>&nbsp;Shells <span class="label label-primary label-as-badge" id="shell"></span></a></li>  
            </ul>
          </li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-mail-bulk" aria-hidden="true"></i>&nbsp;Send <span class="doar" id="mail"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="mailer.html" ><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;PHP Mailers <span class="label label-primary label-as-badge" id="mailer"></span></a></li>
              <li><a href="smtp.html" ><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;SMTPs <span class="label label-primary label-as-badge" id="smtp"></span></a></li>  
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Leads <span class="doar" id="all_leads"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="leads.html" ><i class="fa fa-at" aria-hidden="true"></i>&nbsp;Leads <span class="label label-primary label-as-badge" id="leads"></span></a></li>
            </ul>
          </li>
	  			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;Accounts <span class="doar" id="accounts"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="premium.html" ><img src="img/premium.png" height="22px" width="22px">&nbsp;Premium/Dating/Shop <span class="label label-primary label-as-badge" id="premium"></span></a></li>
              <li><a href="banks.html" ><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Banks <span class="label label-primary label-as-badge" id="banks"></span></a></li>  
            </ul>
          </li> 
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-leaf" aria-hidden="true"></i>&nbsp;Others <span class="doar" id="accounts"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="scampage.html" ><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Scampage <span class="label label-primary label-as-badge" id="scams"></span></a></li>
              <li><a href="tutorial.html" ><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Tutorial <span class="label label-primary label-as-badge" id="tutorials"></span></a></li>  
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
          $q = mysqli_query($dbcon, "SELECT resseller FROM users WHERE username='$uid'") or die(mysqli_error());
          $r = mysqli_fetch_assoc($q);
          $reselerif = $r['resseller'];
          if ($reselerif == "1") {
            $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
            $q = mysqli_query($dbcon, "SELECT soldb FROM resseller WHERE username='$uid'") or die(mysqli_error());
            $r = mysqli_fetch_assoc($q);
            echo '<li><a href="seller/index.html"><span class="badge" title="Seller Panel"><span class="glyphicon glyphicon-cloud"></span><span id="seller"></span></span></a></li>';
          } else {
          } 
          ?>      
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
              <li><a href="tickets.html" ><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Tickets <span class="label label-info"><span id="tickets"></span></span>	
                <?php
                $s1 = mysqli_query($dbcon, "SELECT * FROM ticket WHERE uid='$uid' and seen='1'");
                $r1 = mysqli_num_rows($s1);
                if ($r1 == "1") {
                  echo '<span class="label label-success"> 1 New</span>';
                }
                ?>
                </span></a>
              </li>
              <li><a href="reports.html" ><i class="fa fa-flag" aria-hidden="true"></i>&nbsp;Reports <span class="label label-info"><span id="reports"></span></span>
                <?php
                $s1 = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' and seen='1'");
                $r1 = mysqli_num_rows($s1);
                if ($r1 == "1") {
                  echo '<span class="label label-success"> 1 New</span>';
                }
                ?>
                </span> </a>
              </li>
            </ul>
          </li>
          <li><a href="addBalance.html" ><span class="badge balc"><b><span id="balance"></span></b> <i class="fas fa-plus-circle"></i><span> </a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;My Account <span class="doar" id="alhosts"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!-- onclick="pageDiv(14,'Setting - VpoxShop','setting.html',0); return false;" -->
              <li><a href="setting.html" ><i class="fas fa-user-cog"></i>&nbsp;Setting <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
              <!-- onclick="pageDiv(15,'Orders - VpoxShop','orders.html',0); return false;" -->
              <li><a href="orders.html" ><i class="fas fa-shopping-cart"></i>&nbsp;My Orders <span class="glyphicon glyphicon-shopping-cart pull-right"></span></a></li>
              <!-- onclick="pageDiv(13,'Add Balance - VpoxShop','addBalance.html',0); return false;" -->
              <li><a href="addBalance.html" ><i class="fas fa-dollar-sign"></i>&nbsp;Add Balance <span class="glyphicon glyphicon-usd pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="logout.html" ><i class="fas fa-sign-out-alt"></i>&nbsp;Logout <span class="glyphicon glyphicon-off pull-right"></span></a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <?php 
  $usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
  $getpa = mysqli_query($dbcon,"select * from payment where `user`='$usrid' AND p_data='$p_data'");
  $comrow  = mysqli_fetch_assoc($getpa);
  $balance = $comrow['amountusd'];
  $getus = mysqli_query($dbcon,"select * from users where `username`='$usrid'");
  $comrowus  = mysqli_fetch_assoc($getus);
  $olbalance = $comrowus['balance'];
  $total_bal = $olbalance+$balance;
  $s1 = mysqli_query($dbcon, "UPDATE `payment` SET `state` = 'complete',`old_bal`='$olbalance',`af_bal`='$total_bal' WHERE `user`='$usrid' AND p_data='$p_data'"); 
  $ssd = mysqli_query($dbcon, "UPDATE `users` SET `balance` = '$total_bal' WHERE `username`='$usrid'"); 
  header("location: paymentnow.html?p_data=".$p_data."");
  ?>

  <div id="mainDiv">
    <h1>Your payment has been successfully processed</h1>
  </div>
</body>
</html>
