<?php echo $header; ?>
  
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  
  <section id="login">
	<div class="container mar_top65">
    <section id="faq" class="loginWidth">
        <div class="row">
        	<div class="col-md-12 ">
            	<p ><?php echo $text_login_head;?></p>
                <form name="loginForm"  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">    
                    <div class="login_section "><span id="warningerror"></span></div>
                    <div class="login_section ">
                    <div class="login_input">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" id="frmUserEmail" class="input-box normal-font" name="frmUserEmail" placeholder="<?php echo $entry_email;?>"  ng-model="frmUserEmail" required>
                        <span  id="error_email" ng-show="submitted && loginForm.frmUserEmail.$error.required"></span>                
                    </div>
                </div>
                <div class="login_section errorpasword">
                    <div class="login_input">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <input type="password" id="frmUserPassword"  class="input-box normal-font" name="frmUserPassword" placeholder="<?php echo $entry_password;?>" 
                    ng-model="frmUserPasswordmail" required ng-minlength="6">
                    <span id="error_password" ng-show="submitted && loginForm.frmUserPassword.$error.required"></span>    
                </div>
                </div>
                <div class="login_section">
                <p class="remember"><?php echo $text_forgotten;?></p>
                </div>
                <div class="login_section">
                    <button type="button"  id="button-login" class="btn_login" ng-click="submitted=true"><?php echo $text_login;?></button>
                    <button type="button" id="button-fb-login" class="btn_fb" ng-click="submitted=true"><?php echo $text_login_fb;?></button>
                    <button type="submit" class="btn_google" ng-click="submitted=true"><?php echo $text_login_gplus;?></button>
                </div>
                <div class="login_section">
                <p class="remember"><?php echo $text_register;?></p>
                <p class="remember"><?php echo $text_dont_register;?></p>
                </div>
                </form>
            </div>
        </div>
    </section>
    </div>
</section>


<script type="text/javascript"><!--
    
 $('#button-fb-login').on('click', function() { 
    $('#login').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
    var url = 'index.php?route=account/fblogin';
    $(location).attr('href',url);
    jQuery("#preloader").delay(1000).fadeOut("slow");
 });
 
 $('#button-login').on('click', function() { 

	$.ajax({
		url: 'index.php?route=account/login/validate',
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

                    if (json['error']) {
                        if(json['error']['email'])
                             $('#error_email').prepend('<div class="text-danger">' + json['error']['email'] + '  </div>');
                        
                        if(json['error']['password'])
                            $('#error_password').prepend('<div class="text-danger">' + json['error']['password'] + '  </div>');
                    
                    }else if(json['warning']) {
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

            
           
               
		$(function() {
			if ($(window).scrollTop() > 200) {
				$("#back-top").show();
			} else {
				$("#back-top").hide();
			}
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
			});

			// scroll body to 0px on click
			$('#back-top a').click(function() {
				$('body,html').animate({
					scrollTop : 0
				}, 800);
				return false;
			});
			
			
			
		});
		
		
	
	
$(function() {
	if ($(window).scrollTop() > 200) {
		$("#back-top").show();
	} else {
		$("#back-top").hide();
	}
	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});
	$('#back-top a').click(function() {
		$('body,html').animate({
			scrollTop : 0
		}, 800);
		return false;
	});
});
//--></script>
<?php echo $footer; ?>