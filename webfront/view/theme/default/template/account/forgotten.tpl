<?php echo $header; ?>
 <section id="login">
	<div class="container mar_top25">
    <section id="faq">
        <div class="row">
        	<div class="col-md-12">
            	<div class="login_section">
                	<h3>Forgot password?</h3>
                    <p class="pass">To retrieve your password, Please enter the email you've used for registration:</p>
                </div>
                <form  ng-app="myApp" name="loginForm" novalidate>
                    <div class="login_section"><span id="warningerror"></span></div>
                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="email" id="frmUserEmail" class="input-box normal-font" name="frmUserEmail" placeholder="email"  ng-model="frmUserEmail" required>
                <span id="error_forget" ng-show="submitted && loginForm.frmUserEmail.$error.required"></span>
                 
                </div>
                </div>
                <div class="login_section">
                <button type="button" id="button-forgotten"  ng-click="submitted=true" class="btn_login" >request password</button>
                </div>
                </form>
            </div>
        </div>
    </section>
    </div>
</section>
<script type="text/javascript"><!--
 $('#button-forgotten').on('click', function() { 

	$.ajax({
		url: 'index.php?route=account/forgotten/validate',
		type: 'post',
		data: $('input[name=\'frmUserEmail\'],input[name=\'frmUserPassword\']'),
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
                    $('.alert, .text-danger').remove();

                    if(json['warning']) {
                        $('#warningerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle">&nbsp;</i> ' + json['warning'] + ' </div>');
                    }else if (json['success']) { //alert('success');
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