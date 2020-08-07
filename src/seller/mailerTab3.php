<form  method="POST" action="mailerMass.html" target="myifram">
<input type="hidden" name="userid" value="<?php echo $_REQUEST['id'] ?>">
	<label for="text">PHP Mailer List:</label>
	<textarea name="inputs" class="form-control " rows="3" placeholder="http://domain.com/path/file.php" required></textarea>
<div class="col-md-3">
<table class="table ">
	<tbody><tr>
		<th>Price</th>
	</tr>
	<tr>
		<td><input placeholder="5" type="text" name="price" class="form-control input-sm price_validation" required></td>
	</tr>
</tbody></table>


<div class="col-lg-10">
<button  type="submit" name="submit" class="btn btn-primary ">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

</div>

</div>
</form>

<div class="well well-sm col-md-6" style="    margin-top: 164px;float:inherit;cursor:default;"><b>[Respone]</b><div id="result"></div></div>
<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="mailerMass.html"></iframe>

<script>
/*==============Number Validation===========================*/
$(document).ready(function() {
    $(".price_validation").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
 
});
/*==============End Here===========================*/
</script>
