<form id="cpanelAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="cpanel_host">Host/IP</label>
		<input type="text" name="cpanel_host" id="cpanel_host" class="form-control input-sm" placeholder="https://domain.com:2083" required="">
	</div>
</div>
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="cpanel_login">Login</label>
		<input type="text" name="cpanel_login" id="cpanel_login" class="form-control input-sm" placeholder="user" required="">
	</div>
	<div class="form-group col-lg-3 ">
		<label for="cpanel_pass">Password</label>
		<input type="text" name="cpanel_pass" id="cpanel_pass" class="form-control input-sm" placeholder="abc123" required="">
	</div>
</div>
<div class="row">

<div class="col-md-5">
<table class="table ">
	<tbody><tr>
		<th>Price</th>

	</tr>
	<tr>
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

<div class="well well-sm col-md-6" style="cursor:default;"><b>[Response]</b><div id="result"></div></div>
<script type="text/javascript">
$("#cpanelAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'cpanelAdd.html',
           data: $("#cpanelAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				$('#cpanel_host').val('');
				$('#cpanel_login').val('');
				$('#cpanel_pass').val('');
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