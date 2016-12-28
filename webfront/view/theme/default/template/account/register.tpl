<?php echo $header; ?>
<section id="login">
	<div class="container mar_top65">
    <section id="faq" class="regWidth">
        <div class="row">
        	<div class="col-md-12">
            	<div class="login_section">
                	<h3><?php echo $heading_title;?></h3>
                </div>
                <form  ng-app="myApp" name="loginForm" novalidate>
                 <div class="login_section">
                 <div class="login_input">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" id="frmUserFirstName" name="name" class="input-box normal-font" placeholder="full name" 
                               ng-model="frmUserFirstName" required>
                <span id="error_name" ng-show="submitted && loginForm.frmUserFirstName.$error.required">    </span>
                </div>
                </div>
                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="email" id="email" class="input-box normal-font" name="email" placeholder="<?php echo $entry_email; ?>"  ng-model="email" required>
                <span id="error_email" ng-show="submitted && loginForm.email.$error.required"></span>
                </div>
                </div>

                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <input type="number" id="telephone" class="input-box normal-font" name="telephone" placeholder="<?php echo $entry_telephone; ?>"  ng-model="telephone" required>
                <span id="error_telephone" ng-show="submitted && loginForm.telephone.$error.required"></span>
                </div>
                </div>

                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <input type="password" id="password"  class="input-box normal-font" name="password" placeholder="<?php echo $entry_password; ?>" ng-model="passwordmail" required ng-minlength="6">
                <span id="error_password" ng-show="submitted && loginForm.password.$error.required"></span>
                </div>
                </div>
                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
               <input type="password" id="frmUserCPassword"  class="input-box normal-font" name="frmUserCPassword" placeholder="<?php echo $entry_confirm; ?>" 
                ng-model="frmUserCPassword" valid-password-c required ng-minlength="6" >
                <span  id="error_confpwd" ng-show="submitted && loginForm.frmUserCPassword.$error.required"></span> 
                </div>
                </div>
                <div class="row">
                 <div class="col-md-1 col-sm-1"><input type="checkbox" name="terms"/></div>
                 <div class="col-md-11 col-sm-11 terms">I agree to Riwigo Terms &amp; Policy.</div>
                 </div>
               <?php //echo $captcha;?>
                <div class="login_section">
                    <button type="button" id="button-register" ng-click="submitted=true" class="btn_login" ><?php echo $button_register;?></button>
                <button type="submit" class="btn_fb" ng-click="submitted=true"><?php echo $button_facebook;?></button>
                <button type="submit" class="btn_google" ng-click="submitted=true"><?php echo $button_googleplus;?></button>
                </div>



                </form>
            </div>
        </div>
    </section>
    </div>
</section>

<script type="text/javascript"><!--
 $('#button-register').on('click', function() { 

	$.ajax({
		url: 'index.php?route=account/register/validate',
		type: 'post',
		data: $('input[name=\'email\'],input[name=\'telephone\'],input[name=\'password\'],input[name=\'frmUserCPassword\'],input[name=\'name\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
              $('#login').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');    
		},
		complete: function() {
                    //$('#button-login').button('reset');
                    // will first fade out the loading animation
                    //.jQuery("#status").fadeOut();
                    // will fade out the whole DIV that covers the website.
                   jQuery("#preloader").delay(1000).fadeOut("slow");
		},
		success: function(json) {
                    
                    if(json['name']){
                        $('#error_name').html('');
                         $('#error_name').prepend('<div class="text-danger">' + json['name'] + '  </div>');
                    }else{
                        $('#error_name').html('');
                    }
                        
                    if(json['email']){
                        $('#error_email').html('');
                         $('#error_email').prepend('<div class="text-danger">' + json['email'] + '  </div>');
                    }else{          
                        $('#error_email').html('');
                    }

                    if(json['telephone']){
                        $('#error_telephone').html('');
                         $('#error_telephone').prepend('<div class="text-danger">' + json['telephone'] + '  </div>');
                    }else{          
                        $('#error_telephone').html('');
                    }


                    if(json['password']){
                        $('#error_password').html('');
                        $('#error_password').prepend('<div class="text-danger">' + json['password'] + '  </div>');
                    }
                    
                    if(json['warning']) {
                        $('#warningerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle">&nbsp;</i> ' + json['warning'] + ' </div>');
                    }
                    
                    if (json['success']) { //alert('success');
                        var url = json['redirect_url'];
                        $(location).attr('href',url);
                    }			
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script>
<?php echo $footer; ?>
