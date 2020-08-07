
<input type="hidden" name="oid" class="oid" value="<?php echo $_REQUEST['id'] ?>">

<div class="row">

	<div class="form-group col-lg-8 ">

		<label for="">Host/IP</label>

		<textarea  name="host" id="host" class="form-control geth" placeholder="Host/IP : HOST|PORT|USER|PASS" required="" style="height:150px;"></textarea>

	</div>

</div>

 

<div class="row">

<div class="col-md-6">
<table class="table ">
	<tbody><tr>
		 
		<th>Price</th>
	</tr>
	<tr>

				<td><input placeholder="5" type="text" name="price" class="form-control input-sm price" required=""></td>
	</tr>
</tbody></table>
</div>

<div class="form-group col-lg-10">

	<button type="submit" name="submit" class="btn btn-primary btn-md sub">Add  <span class="glyphicon glyphicon-indent-left"></span></button>

<input type="hidden" name="start" value="work" />



	</div>

</div>








<div class="well well-sm col-md-6" style="    margin-top: 14px;float:inherit;cursor:default;"><b>[Respone]</b><div id="result"></div></div>
<div class="well-sm col-md-12 resultnew"></div>

<!--<iframe style="border:none" width="100%" height="100%" scrolling="yes" name="myifram" id="myifram" src="smtpmass.php"></iframe>-->



<script type="text/javascript">
$(".sub").click(function() {
	$('.resultnew').html('');
  $('button').prop('disabled', true);
  var geth = $('.geth').val();
  var price = $('.price').val();
  var oid = $('.oid').val();
var res = geth.split("\n");
var length = res.length;
 

/*if(length > '20'){
	$('.resultnew').text('limit reached Max 20 smtp for request');
}else{*/
	for($i=0;$i<=length-1;$i++){
	  var ib = $i;
	
		 var smtp = res[$i];
    $.ajax({
           type: "POST",
           url: 'smtpmass.php',
           data: {smtp:smtp,oid:oid,price:price,countd:ib,total:length},
           success: function(data){
          var getDataValue1 =  window.setInterval(function(){
		  $('.resultnew').append('<div class="">'+data+'</div>');
		  
          window.clearInterval(getDataValue1);
             
        },2000);
	}
});
   
		}
	/*}*/
	
 $('button').prop('disabled', false);
    return false; // avoid to execute the actual submit of the form.
});
</script>