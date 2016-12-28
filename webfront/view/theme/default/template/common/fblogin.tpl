<?php echo $header; ?>
<!-- Banner -->
<div class="container-fluid" >
  <div class="row">
    <div class=" banner-backg">
    
   <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="tree"><img src="catalog/view/theme/default/image/tree.png" alt="Girl Travels"></div>
      <div class="video-thumb"> <a style="cursor:pointer;" data-toggle="modal" data-target=".bs-example-modal-sm"><img src="catalog/view/theme/default/image/video-icon.png"/></a></div>
      

  <div  id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
   <p> <iframe id="how_video" height="500px"  width="800px" src="https://www.youtube.com/embed/pk6Cc-aKI7s?rel=0&autoplay=0"></iframe> </p>
    </div>
  </div>
</div> 

</div>
      
<!-- Login pannel -->
<div class="col-md-8 col-sm-8 col-xs-12" ng-app="myApp" ng-controller="customersCtrl">

  <div class="login-pannel">
  <div class="col-md-6 login-left-panel">
	<div class="join"><?php echo $text_signin;?> </div>
	        <div class="clr"></div> 
                    <a class="facebook" href="<?php echo $fblogin;?>"> Facebook</a>
                    <a class="google" href="#"> Google+</a>
                    <a class="twitter" href="#"> Twitter</a> 
                   <div class="mail-text"><?php echo $text_signingup;?></div>
                  
  </div> 

<!-- New user registration pannel start -->

<div class="col-md-6">
<div class="reg-thankyou" ng-class="registrationSuccess" >   
<div class="thankyou-box">
	<h1>Drop in Your Details</h1>
  <img src="catalog/view/theme/default/image/smile-png.png">  
  <h3>Your query has been successfully submitted</h3>
  <h4>Thanks for dropping us a note. Your details have been stored and the concerned person will get in touch with you shortly!</h4>  
</div>
</div>
<div class="signup-panel" ng-class="registrationDiv" >      
    <div class="form-box">
        <div class="form-top">
            <div class="form-top-left">
                    <h3><?php echo $text_signupnow;?></h3>
            </div>
        </div>
	</div>
    
        <div class="form-bottom" >
           <!-- <form name="regForm" role="form" action="<?php echo $action;?>" method="POST" class="registration-form">-->

            <form name="fbRegForm" id="fbRegForm" role="form" method="POST" class="registration-form">
                <div class="form-group">  
					<div class="row" ng-init="gender=1">
						<?php if($gender == 'male'){?> 
							<div class="col-xs-1"> 
								<input type="radio"  ng-model="gender" name="gender" checked="checked" value="1"> 
							</div> 
							<div class="col-xs-2" id="gender_male" style="color:#323232;"><img src="catalog/view/theme/default/image/male.png" alt="male"></div>                      
						<?php } ?>

						<?php if($gender == 'female'){?> 
							<div class="col-xs-1"> 
								<input type="radio"  ng-model="gender" name="gender" checked="checked" value="2">
							</div>
							<div class="col-xs-2" id="gender_female" style="color:#323232;"><img src="catalog/view/theme/default/image/female.png" alt="Female"></div>  
						<?php } ?>
					</div> 
                </div>
                <div class="form-group "> 
                  <div class="input-group">
                    <span class="input-group-addon ng-binding"><i class="fa fa-user"></i></span> 
                    <input type="text" id="dispname"  name="dispname" maxlength="10"  placeholder="Display Name.. Max 10 Chars"  class="form-first-name form-control" data-toggle="tooltip" value="<?php echo $username;?>" ng-model="NameValue" required>
				   </div> 
				   <div class="bubble" id="errorDispName" style=""></div> 
				</div>
				 
				 
                <div class="form-group"> 
                  <div class="input-group"> 
                      <span class="input-group-addon ng-binding"><i class="fa fa-envelope"></i></span> 
                    <input type="text" name="email" placeholder="Email.. user@domian.com" disabled="disabled" class="form-email form-control" id="email" data-toggle="tooltip"   value="<?php echo $fbemail;?>" ng-class="EmailClass" ng-model="EmailValue" required>
					</div>
					<div class="bubble" id="errorEmail" style=""></div> 				
                </div>
			
                <div class="form-group"> 
                    <div class="input-group"> 
                      <span class="input-group-addon ng-binding" style="padding:6px 15px !important;"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password"  name="password" maxlength="12" data-minlength="4" placeholder="Password.. Min 4 Chars" class="form-password form-control"  data-toggle="tooltip" value="" required>					
                </div> 
				<div class="bubble" id="errorDob" style=""></div> 
                  </div> 
				  
                <div class="form-group"> 
                    <div class="input-group"> 
                      <span class="input-group-addon ng-binding"><i class="fa fa-calendar"></i></span>

                    <div class='input-group date' id='datetimepicker1'>

					<input type="text" placeholder="DOB" name="dob" id="dob" value="" required>
                       
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
						
                    </div>
					
                    </div>
					 
                </div>
                <button type="button" name="fbReg"  class="btn btn-primary pull-left"><?php echo $text_signupme;?></button>
                <button type="button" id="cancelbtn" class="btn"><?php echo $text_cancel;?></button>
            </form>
        </div>
    </div>
<!-- New user registration pannel end -->
</div> 
  </div>

  </div>
 
</div>
 
 
<?php echo $footer; ?>
<script type="text/javascript">
 
	$("button[name='fbReg']").click(function(){  //alert('hi');

		$.ajax({
			url: 'index.php?route=account/fblogin/validateForm',
			type: 'post',
			dataType: 'json',
			data: $('select, input[type=\'text\'],input[type=\'password\'],input[type=\'date\'], input[type=\'hidden\'], input[type=\'radio\']:checked, input[type=\'checkbox\']:checked,textarea'),
			beforeSend: function() {
				var docHeight = $(document).height(); 
				$("body").append("<div id='overlay'><span style='margin-left:50%;margin-top:50%;'><img src='catalog/view/theme/default/image/loader.gif' alt='Girltravels Loader' ></span></div>");

				$("#overlay")
				  .height(docHeight)
				  .css({
					 'opacity' : 0.4,
					 'position': 'absolute',
					 'top': 0,
					 'left': 0,
					 'background-color': 'black',
					 'width': '100%',
					 'z-index': 999999
				  });
				$("button[name='fbReg']").button('loading');
			},
			complete: function() {
				$('#overlay').remove();  
				$("button[name='fbReg']").button('reset')
				 
			},
			success: function(json) { //alert(json['dispname'])
				if (json['message']) {
					$('#rt').before('<div class="alert"><button data-dismiss="alert" class="close">×</button><strong>Warning!</strong>  ' + json['message'] + '</div>');
				}
				if (json['dispname']) { 
					$("#errorDispName").css('');
					$("#errorDispName").fadeIn();
					$("#errorDispName").css({"display":"block","top": "70px","left": "-228px"});
					$("#errorDispName").html(json['dispname']);  
				}else{
					$("#errorDispName").css('');
					$("#errorDispName").fadeOut();
					$("#errorDispName").css({"display":"none","top": "70px","left": "-228px"});
					$("#errorDispName").html(''); 
				}
				if (json['email']) { 
					$("#errorEmail").css('');
					$("#errorEmail").fadeIn();
					$("#errorEmail").css({"display":"block","top": "127px","left": "-228px"});
					$("#errorEmail").html(json['email']);  
				}else{
					$("#errorEmail").css('');
					$("#errorEmail").fadeOut();
					$("#errorEmail").css({"display":"none","top": "127px","left": "-228px"});
					$("#errorEmail").html(''); 
				}
				if (json['password']) { 
					$("#errorPassword").css('');
					$("#errorPassword").fadeIn();
					$("#errorPassword").css({"display":"block","top": "179px","left": "-228px"});
					$("#errorPassword").html(json['password']);  
				}else{
					$("#errorPassword").css('');
					$("#errorPassword").fadeOut();
					$("#errorPassword").css({"display":"none","top": "179px","left": "-228px"});
					$("#errorPassword").html(''); 
				}
				
				if (json['dob']) { 
					$("#errorDob").css('');
					$("#errorDob").fadeIn();
					$("#errorDob").css({"display":"block","top": "237px","left": "-228px"});
					$("#errorDob").html(json['dob']);  
				}else{
					$("#errorDob").css('');
					$("#errorDob").fadeOut();
					$("#errorDob").css({"display":"none","top": "237px","left": "-228px"});
					$("#errorDob").html(''); 
				} 
				
				if (json['success']) {  //alert(json['redirect']):
					   
						url = json['redirect'];
						url = url.replace("&amp;", "&");
						$(location).attr('href',url);
					 
				}
			}
		});
	});
	
 
</script>