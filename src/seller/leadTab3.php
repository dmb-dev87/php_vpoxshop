<form  method="POST" action="leadmass.php" target="myifram">

<input type="hidden" name="oid" value="<?php echo $_REQUEST['id'] ?>">

	<label for="text">List:</label>

	<textarea name="details" class="form-control " rows="6" placeholder="Download link|Email Nunber (K)|Description|Email Domain|Country|Price" required></textarea>

<div class="col-md-3">

<table class="table ">

	<tbody> 

 

</tbody></table>

<div class="col-lg-10">

<button  type="submit" name="submit" class="btn btn-primary ">Add  <span class="glyphicon glyphicon-indent-left"></span></button>

<input type="hidden" name="start" value="work" />



</div>



</div>

</form>



<div class="well well-sm col-md-6" style="    margin-top: 164px;float:inherit;cursor:default;"><b>[Respone]</b><div id="result"></div></div>

<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="leadmass.php"></iframe>

