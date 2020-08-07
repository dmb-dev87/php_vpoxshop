<?php
  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');


  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: index.html");
   exit();
}

if(isset($_POST['verify'])){
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
	$_SESSION['error']= 'success';
	 header("location: login.html");
	
	}else{
		
		$_SESSION['error']= 'error';
	}
}

 
?>
<!doctype html>
<html>
<link rel="stylesheet" type="text/css" href="files/bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="files/js/jquery.js"></script>
<script type="text/javascript" src="files/bootstrap/3/js/bootstrap.js"></script>

<link rel="shortcut icon" href="files/img/favicon.ico" />
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Vpox SHOP</title>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400);
html, body {
    background: url(img/bg.png);
}

.container {
    padding: 40px 0;
    position: relative;
	right:30px;
}

.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}
h6 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:5px;
 text-align: center;
}
.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}


</style>

</head>
<body>
 
<!--Pulling Awesome Font -->
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login" id="logindiv">
			<h4> <b><span class='glyphicon glyphicon-fire'></span> Vpox SHOP - Varification</b> </h4>
			<?php 
			if($_SESSION['error'] == 'error'){
			?>
<div id='errorbox'>
<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert">×</button><p>Varification Failed!</p></div>
</div>
			<?php } ?>
<form method='post' action='' class="check_capch">
     <div class="g-recaptcha" data-sitekey="6LfL0e8UAAAAAG6TlJ_RK4qpGj92Mel53NFDDluR" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
    <div class='wrapper'>
            <button type="submit" id="divButton" class="btn btn-primary btn-md check_capch" name="verify">Verify <i class="glyphicon glyphicon-ok"></i></button>
    </div>
</form>
            </div>

        </div>
    </div>                    

</div>
</body>
</html>
 