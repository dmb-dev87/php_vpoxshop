<?php
  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');


  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: index.html");
   exit();
}
?>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<h4> <b><span class='glyphicon glyphicon-fire'></span> Vpox SHOP - Signup</b> </h4>
<div id='errorbox'>
</div>
<form method='post' action='signupform.html' class='ajax'>
    <input type='text' id='username' name='username' class='form-control input-sm chat-input' placeholder='Enter Username' required/>
    <br>
    <input type='password' id='password_signup' name='password_signup' class='form-control input-sm chat-input' placeholder='Enter Password' required/>
    <br>
    <input type='password' id='password_signup2' name='password_signup2' class='form-control input-sm chat-input' placeholder='Confirm Password' required/>
    <br>
    <input type='text' id='email' name='email' class='form-control input-sm chat-input' placeholder='Enter Email' required/>

    <br>
	
	
    <div class='wrapper'>
	<div class="g-recaptcha" data-sitekey="6LfL0e8UAAAAAG6TlJ_RK4qpGj92Mel53NFDDluR" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
	<br>	
       <button type='submit' id='divButton' class='btn btn-primary btn-md'>SignUp <span class='glyphicon glyphicon-log-in'></span></button>

    </div>
</form>
<br>
<br>
<div class='wrapper'>
    <button type='button' class='btn btn-default btn-xs' onclick="logindiv(1,'Login - Vpox SHOP','login.html',0);">Already Have Account ? Login</button>
</div>

<script type="text/javascript">
          $('form.ajax').on('submit' , function() {
              $("#divButton").prop('disabled', true);
                var that = $(this),
                    url = that.attr('action');
                    type = that.attr('method');
                    data = {};
                that.find('[name]').each(function(index , value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    data[name] = value;

                })
                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response){
                        var response = JSON.parse(response);
                         $("#errorbox").html(response['errorbox'] ).show();

                    if(response['state'] == 0) {             $("#divButton").prop('disabled', false);}
                    if (response['url'] != 0){
                        if (response['url'] == 3){setTimeout(function(){ logindiv(4,'Verification - Vpox SHOP','login.html',0); }, 1500);}
                        else if (response['url'] == 1){setTimeout(function(){ logindiv(1,'Login - Vpox SHOP','verification.html',0); }, 1500);}
                        else {setTimeout(function(){ window.location = response['url']; }, 3000);}
                     }

                    }
                });

                return false;

            });
            </script>