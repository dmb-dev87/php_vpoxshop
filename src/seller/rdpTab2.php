
<form id="rdpAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="rdp_host">Host/IP</label>
		<input type="text" name="rdp_host" id="rdp_host" class="form-control input-sm" placeholder="1.1.1.1" required="">
	</div>
</div>
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="rdp_login">Login</label>
		<input type="text" name="rdp_login" id="rdp_login" class="form-control input-sm" placeholder="admin" required="">
	</div>
	<div class="form-group col-lg-3 ">
		<label for="rdp_pass">Password</label>
		<input type="text" name="rdp_pass" id="rdp_pass" class="form-control input-sm" placeholder="abc123" required="">
	</div>
</div>
<div class="row">

<div class="col-md-6">
<table class="table ">
	<tbody><tr>
		<th>Access</th>
		<th>Windows</th>
		<th>RAM</th>
		<th>Price</th>
	</tr>
	<tr>
		<td>
			<select class="form-control input-sm" name="access" required="">
				<option selected="">USER</option>
				<option>ADMIN</option>
			</select>
		</td>
		<td>
		<select class="form-control input-sm" name="windows" required="">
				<option>ME</option>
				<option>2000</option>
				<option>XP</option>
				<option>2003</option>
				<option>Vista</option>
				<option>7</option>
				<option>8</option>
				<option>10</option>
				<option>2008</option>
				<option selected="">2012</option>
				<option>2016</option>
				<option>2019</option>
		</select>
		</td>
		<td style="display:flex;"><input placeholder="512/1/2" type="text" name="ram" class="form-control input-sm number_validation" required="" style="width:45px">
		<select class="form-control input-sm" name="ramstorage" required="" style="width:70px">
				<option selected="">MB</option>
				<option>GB</option>
				<option>TB</option>
			</select></td>
		<td><input placeholder="5" type="text" name="price" class="form-control input-sm price_validation" required=""></td>
	</tr>
</tbody></table>
</div>
<div class="form-group col-lg-10">
	<button type="submit" name="submit" class="btn btn-primary btn-md">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

	</div>
</div>
</form>
<div class="row">
	<div class="well well-sm col-md-6" ><b>[Response]</b><div id="result"></div></div>
</div>
<script type="text/javascript">
$("#rdpAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'rdpAdd.html',
           data: $("#rdpAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				$('#rdp_host').val('');
				$('#rdp_login').val('');
				$('#rdp_pass').val('');
            }
            $("#result").html(data['text']).show();
            }

});

    return false; // avoid to execute the actual submit of the form.
});
</script>
<script>
/*==============Number Validation===========================*/
$(document).ready(function() {
    $(".number_validation").keydown(function (e) {
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