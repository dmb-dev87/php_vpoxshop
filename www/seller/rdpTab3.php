<form  method="POST" action="rdpMass.php" target="myifram">
<input type="hidden" name="oid" value="<?php echo $_REQUEST['id'] ?>">
<div class="row">
	<div class="form-group col-lg-8 ">
		<label for="rdp_host">Host/IP</label>
		<textarea  name="rdp_host" id="rdp_host" class="form-control" placeholder="Host/IP : IP|USER|PASS|ACCESS TYPE|WINDOWS TYPE|RAM|PRICE" required="" style="height:150px;"></textarea>
	</div>
</div>
 
<div class="row">

<div class="form-group col-lg-10">
	<button type="submit" name="submit" class="btn btn-primary btn-md">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

	</div>
</div>
</form>



<div class="well well-sm col-md-6" style="    margin-top: 14px;float:inherit;cursor:default;"><b>[Respone]</b><div id="result"></div></div>
<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="rdpMass.php"></iframe>

