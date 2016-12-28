<?php if ($error_warning) { ?>

<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>

<!-- Login Code -->

<div id="login" class="login-container login col-sm-12">
  <form  action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    
    <h2> <?php echo $text_loginform; ?></h2>
        <div class="leftside">
    <?php if($socialstatus==1){?>
    <div class="col-sm-12 <?php if($socialarea=='top'){?> social<?php } else { ?> hide<?php } ?> ">
      
      <?php echo $sociallogin; ?> </div>
    <?php } ?>
    <div class="form-group required">
      <div class="col-sm-12">
        <input type="text" name="email" value="<?php echo $email; ?>" id="email1" class="form-control" placeholder="Email"/>
        <span class="name-icon fui-mail gray"></span> </div>
    </div>
    <div class="form-group required">
      <div class="col-sm-12">
        <input type="password" name="password" value="<?php echo $password; ?>" id="password1" class="form-control" placeholder="Password"/>
        <span class="name-icon fui-lock gray"></span>
        <?php if($foregetstatus==1){?>
        <a class="click" rel="forgotten" rel1="registration" rel2="login"><?php echo $text_forgotten; ?></a>
        <?php } ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
       <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" placeholder="<?php echo $redirect;?>" id="redirect" class="form-control" />
        <input class="btn btn-primary form-control" type="button" value="<?php echo $button_login; ?>" id="loginpage"/>
      </div>
    </div>
  </div><!--end leftside-->

    <div class="rightside">
    <?php if($socialstatus==1){?>
    <div class="col-sm-12 <?php if($socialarea=='bottom'){?> social<?php } else { ?> hide<?php } ?> ">
      
      <?php echo $sociallogin; ?> </div>
    <?php } ?>
    <div class="col-sm-12 social">

      <p> <a class="click" rel="registration"  rel1="login" rel2="forgotten"><?php echo $text_regpage; ?></a></p>
     <!--  <p><?php echo $text_noaccount; ?> <a class="click" rel="registration"  rel1="login" rel2="forgotten"><?php echo $text_regpage; ?></a></p> -->
    </div>
  </form>
</div>
</div><!--end rightside-->

<!-- Login Code --> 

<div id="registration" style="display:none" class="register-container register col-sm-12" style="padding-right:0px">
  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php if($socialstatus==1){?>
    <div class="col-sm-12 <?php if($socialarea=='top'){?> social<?php } else { ?> hide<?php } ?> ">
      
      <?php echo $sociallogin; ?> </div>
    <?php } ?>
    <h2 class="registerbox"><?php echo $entry_accounttitle; ?></h2>
    <div class="leftside">
    <?php if($firstname_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="firstname" value="<?php echo $firstname; ?>" id="firstname" class="form-control" placeholder="<?php echo $firstname_lable;?>"/>
    </div>
    <?php } ?>
    <?php if($lastname_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="lastname" value="<?php echo $lastname; ?>" id="lastname" class="form-control" placeholder="<?php echo $lastname_lable;?>" data-validate-length-range="6" data-validate-words="2"/>
    </div>
    <?php } ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="email" value="<?php echo $email; ?>" id="email" class="form-control" placeholder="<?php echo $email_lable;?>"/>
    </div>
    <?php if($telephone_status==1){ ?>
    <div class="col-sm-6 form-group">
     <!-- <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $telephone_lable;?>" id="telephone" class="form-control" /> -->
    <input type="text" name="countrycode" id="isd_codes" style="width:100px; height:46px;" class="form-control" tabindex="5"><input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $telephone_lable;?>" id="telephone" class="form-control" style="width: 58%;"/>
    </div>
    <?php } ?>
    <?php if($fax_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $fax_lable;?>" id="fax" class="form-control" />
    </div>
    <?php } ?>
    <?php if($company_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $company_lable;?>" id="input-company" class="form-control" />
    </div>
    <?php } ?>
    <?php if($address_1_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $address_1_lable;?>" id="address-1" class="form-control" />
    </div>
    <?php } ?>
    <?php if($address_2_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $address_2_lable;?>" id="address-2" class="form-control" />
    </div>
    <?php } ?>
    <?php if($city_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $city_lable;?>" id="input-city" class="form-control" />
    </div>
    <?php } ?>
    <?php if($postcode_status==1){ ?>
    <div class="col-sm-6 form-group">
      <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $postcode_lable;?>" id="input-postcode" class="form-control" />
    </div>
    <?php } ?>
  
    <?php if($country_status==1){ ?>
    <div class="col-sm-6 form-group">
      <select name="country_id" id="input-country" class="form-control">
        <option value=""><?php echo $text_select; ?></option>
        <?php foreach ($countries as $country) { ?>
        <?php if ($country['country_id'] == $country_id) { ?>
        <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <?php } ?>
    <?php if($zone_status==1){ ?>
    <div class="col-sm-6 form-group">
      <select name="zone_id" id="input-zone" class="form-control">
      </select>
    </div>
    <?php } ?>
    <div class="col-sm-6 form-group">
      <input type="password" name="password" value="<?php echo $password; ?>" id="password" class="form-control" placeholder="<?php echo $pwd_lable;?>"/>
    </div>
    <div class="col-sm-6 form-group">
      <input type="password" name="confirm" value="<?php echo $password; ?>" id="confirm-password" class="form-control" placeholder="<?php echo $cpwd_lable;?>"/>
    </div>
    <?php if($privacy_status==1){ ?>
    <div class="col-sm-12 form-group"> <span class="privacy" style="font-size:.7em; padding:5px;"><?php echo $privacy_lable; ?></span>
      <?php if ($agree) { ?>
      <input type="checkbox" id="input-agree" name="agree" value="1" checked="checked" />
      <?php } else { ?>
      <?php if($privacyautochk==1){ ?>
      <input type="checkbox" id="input-agree" name="agree" value="1" checked="checked" />
      <?php } ?>
      <input <?php if($privacyautochk==1){ ?> class="hide" <?php }?> type="checkbox" id="input-agree" name="agree" value="1" />
      <?php } ?>
    </div>
    <?php } ?>
    <div class="col-sm-12 form-group">
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" placeholder="<?php echo $redirect;?>" id="redirect" class="form-control" />
      <input class="btn btn-primary form-control" type="button" value="<?php echo $button_submitbutton; ?>" id="signup"/>
    </div>
</div>


<div class="rightside">
    <?php if($socialstatus==1){?>
    <div class="col-sm-12 <?php if($socialarea=='bottom'){?> social <?php } else { ?> hide<?php } ?> ">
      
      <?php echo $sociallogin; ?> </div>
    <?php } ?>
    <div class="col-sm-12 social">
      <?php if(isset($loginstatus)){?>
      <p><?php echo $text_account_alrdy; ?> <a class="click" rel="login" rel1="registration" rel2="forgotten"><?php echo $text_loginpage; ?></a></p>
      <?php } ?>
    </div>
</div>



  </form>
</div>
<!-- New Code --> 



<!-- Forget Code -->
<div id="forgotten" style="display:none"  class="forgotten-container forgotten col-sm-12">
     <h2><!-- <?php echo $text_email; ?> -->Forgot Password </h2>
         <div class="leftside">
  <?php if($socialstatus==1){?>
  <div class="col-sm-12 <?php if($socialarea=='top'){?> social<?php } else { ?> hide<?php } ?> ">
    

    <?php echo $sociallogin; ?> </div>
  <?php } ?>
  <div class="form-group required">
    <div class="col-sm-12">
      <input type="text" name="email" value="<?php echo $email; ?>" id="forgetemail" class="form-control" placeholder="Email"/>
      <span class="name-icon fui-mail gray"></span> </div>
  </div>

  <div class="form-group forgt">
    <div class="col-sm-12" style="margin-top:10px">
     <!--  <div class="pull-left"> <a style="padding:10px;" class="click btn btn-default" rel="login" rel1="registration" rel2="forgotten"><?php echo $button_back; ?></a> </div> -->
      <div class="pull-right">
       <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" placeholder="<?php echo $redirect;?>" id="redirect" class="form-control" />
       <!--  <input type="button" value="<?php echo $button_continue; ?>" class="btn btn-primary" id="forgett" style="padding:10px;"/> -->
       <input type="button" value="Submit" class="btn btn-primary" id="forgett" style="padding:10px;"/>


      </div>
    </div>
  </div>  
    </div>

        <div class="rightside">
  <?php if($socialstatus==1){?>
  <div class="col-sm-12 icons  <?php if($socialarea=='bottom'){?> social<?php } else { ?> hide<?php } ?> ">
    
    <?php echo $sociallogin; ?> </div>
  <?php } ?>
</div>
</div>
<!-- forget Code -->
</div>
</div>
</div>
</div>
<!-- signup Modal end--> 
<script>

 $(".click").click(function(){    
   var id=$(this).attr("rel");
   var id1=$(this).attr("rel1");
   var id2=$(this).attr("rel2");
   
  $("#"+id).show();
   $("#"+id1).hide();
   $("#"+id2).hide();
 
  });

    $('#signup').bind('click', function() {
  $.ajax({
  url: 'index.php?route=common/login/addregister',
  type: 'post',
  data: $('.register input[type=\'text\'],.register input[type=\'password\'], .register input[type=\'hidden\'], .register input[type=\'radio\']:checked, .register input[type=\'checkbox\']:checked, .register select, .register textarea'),
  dataType: 'json',
  beforeSend: function() {
      $('#signup').button('loading');
    },
   complete: function() {
            $('#signup').button('reset');
        },  
  success: function(json) {
  $('.alert, .text-danger').remove();

    
    if (json['error']) {
      if(typeof (json['error']['firstname'])!='undefined'){
      $('#firstname').after('<div class="text-danger"><span>' + json['error']['firstname'] + '</span></div>');
      }
      if(typeof (json['error']['lastname'])!='undefined'){
      $('#lastname').after('<div class="text-danger"><span>' + json['error']['lastname'] + '</span></div>');
      }
          
      if(typeof (json['error']['email'])!='undefined'){
      $('#email').after('<div class="text-danger"><span>' + json['error']['email'] + '</span></div>');
      }
      
      <?php if($telephone_errorss==1){?>          
      if(typeof (json['error']['telephone'])!='undefined'){
      $('#telephone').after('<div class="text-danger"><span>' + json['error']['telephone'] + '</span></div>');
      }
      <?php } ?>  
      <?php if(empty($fax_errorss)){?>  
      if(typeof (json['error']['fax'])!='undefined'){
      $('#fax').after('<div class="text-danger"><span>' + json['error']['fax'] + '</span></div>');
      } 
      <?php } ?>  
      <?php if(empty($address_1_errorss)){?>    
      if(typeof (json['error']['address_1'])!='undefined'){
      $('#address-1').after('<div class="text-danger"><span>' + json['error']['address_1'] + '</span></div>');
      }
      <?php } ?>      
      <?php if(empty($address_2_errorss)){?>  
      if(typeof (json['error']['address_2'])!='undefined'){
      $('#address-2').after('<div class="text-danger"><span>' + json['error']['address_2'] + '</span></div>');
      } 
      <?php } ?>
      <?php if(empty($company_errorss)){?>
      if(typeof (json['error']['company'])!='undefined'){
      $('#input-company').after('<div class="text-danger"><span>' + json['error']['company'] + '</span></div>');
      } 
        <?php } ?>
      <?php if(empty($city_errorss)){?>
      if(typeof (json['error']['city'])!='undefined'){
      $('#input-city').after('<div class="text-danger"><span>' + json['error']['city'] + '</span></div>');
      } 
      <?php } ?>
      <?php if(empty($postcode_errorss)){?>
      if(typeof (json['error']['postcode'])!='undefined'){
      $('#input-postcode').after('<div class="text-danger"><span>' + json['error']['postcode'] + '</span></div>');
      } 
      <?php } ?>
        
      
      if(typeof (json['error']['country_id'])!='undefined'){
      $('#input-country').after('<div class="text-danger"><span>' + json['error']['country_id'] + '</span></div>');
      } 
      if(typeof (json['error']['zone_id'])!='undefined'){
      $('#input-zone').after('<div class="text-danger"><span>' + json['error']['zone_id'] + '</span></div>');
      } 
        
      if(typeof (json['error']['password'])!='undefined'){
      $('#password').after('<div class="text-danger"><span>' + json['error']['password'] + '</span></div>');
      }
      
      if(typeof (json['error']['confirm'])!='undefined'){
      $('#confirm-password').after('<div class="text-danger"><span>' + json['error']['confirm'] + '</span></div>');
      }
      
      
      if(typeof (json['error']['agree'])!='undefined'){
      $('.registerbox').after('<div class="alert alert-danger"> <i class="fa fa-exclamation-triangle"></i> ' + json['error']['agree'] + '<button type="button" class="close" style="background:none;color:#000;padding:0px;" data-dismiss="alert">&times;</button></div>');
      }
      
      $('.warning').fadeIn('slow');
    }

    if (json['success']) {
        if (json['success']) { 
          var url = json['redirect'];
          var url = url.replace(/&amp;/g, "&");
          $(location).attr('href',url);
        }
      }
    }
    });
  });
  
  
   $('#loginpage').bind('click', function(e) {
  $.ajax({
  url: 'index.php?route=common/login/addlogin',
  type: 'post',
  data: $('.login input[type=\'text\'],.login input[type=\'password\'], .login input[type=\'hidden\'], .login input[type=\'radio\']:checked, .login input[type=\'checkbox\']:checked, .login select, .login textarea'),
  dataType: 'json',
  beforeSend: function() {
      $('#loginpage').button('loading');
    },
   complete: function() {
            $('#loginpage').button('reset');
        },  
  success: function(json) {
  $('.alert, .text-danger').remove();

    
    if (json['error']) {
      
      if(typeof (json['error']['email'])!='undefined'){
      $('#email1').parent('div').before('<div class="alert alert-danger"> <i class="fa fa-exclamation-circle"></i> ' + json['error']['email'] + '<button type="button" class="close" style="background:none;color:#000;padding:0px;" data-dismiss="alert">&times;</button></div>');
      }
      if(typeof (json['error']['password'])!='undefined'){
      $('#password1').parent('div').before('<div class="alert alert-danger"> <i class="fa fa-exclamation-triangle"></i> ' + json['error']['password'] + '<button type="button" class="close" style="background:none;color:#000;padding:0px;" data-dismiss="alert">&times;</button></div>');
      }
            
      $('.warning').fadeIn('slow');
    }

    if (json['success']) {
        
         
        var url = json['redirect'];
                  var url = url.replace(/&amp;/g, "&");
                        $(location).attr('href',url);

    }
    }
    });
  });
  
  $('#forgett').bind('click', function() {
    var redirect = $('#redirect').val();
    //alert(redirect);
  $.ajax({
  url: 'index.php?route=common/login/forgetpwd',
  type: 'post',
  data: $('#forgotten input[type=\'text\'], #forgotten input[type=\'hidden\']'),
  dataType: 'json',
  beforeSend: function() {
      $('#forgett').button('loading');
    },
   complete: function() {
            $('#forgett').button('reset');
        },  
  success: function(json) {
  $('.alert, .text-danger').remove();

    
    if (json['error']) {
      
      if(typeof (json['error']['forgetemail'])!='undefined'){
      $('#forgetemail').parent('div').before('<div class="alert alert-danger"> <i class="fa fa-exclamation-circle"></i> ' + json['error']['forgetemail'] + '<button type="button" class="close" style="background:none;color:#000;padding:0px;" data-dismiss="alert">&times;</button></div>');
      }
      $('.warning').fadeIn('slow');
    }

    if (json['success']) {
        //location='index.php?route=account/account';
        var url = json['redirect'];
                  var url = url.replace(/&amp;/g, "&");
                        $(location).attr('href',url);


    }
    }
    });
  });
  </script> 
<script>
$(document).ready(function(){
 
  
 
  
  
});
</script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
  $.ajax({
    url: 'index.php?route=account/account/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('input[name=\'postcode\']').parent().parent().addClass('required');
      } else {
        $('input[name=\'postcode\']').parent().parent().removeClass('required');
      }

      html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
          html += '<option value="' + json['zone'][i]['zone_id'] + '"';

          if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
            html += ' selected="selected"';
          }

          html += '>' + json['zone'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }

      $('select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<style>

#quickloginModal .modal-content{background-color:<?php echo $contanercolor?>}
#quickloginModal h2{color:<?php echo $headingcolor?>}
#quickloginModal select.form-control, #quickloginModal  input.form-control[type="text"],#quickloginModal input.form-control[type="password"]{border-bottom:solid 1px <?php echo $inputbordercolor?>; color:<?php echo $textcolor?>;background-color:<?php echo $contanercolor?>;margin-bottom:10px;}
#quickloginModal .btn{background:<?php echo $btnbgcolor?>!important;color:<?php echo $btncolor?>!important}
#quickloginModal .socialtitle{color:<?php echo $scfontcolor?>!important}

<?php echo $customcss;?>
</style>

<style type="text/css">
.intl-tel-input {padding-top:5px;}
.intl-tel-input .country-list{width:200px!important;}
.intl-tel-input.allow-dropdown input#isd_codes
{
    padding: 10px 0 10px 47% !important;
}
</style>
 <link rel="stylesheet" href="<?php echo HTTP_IMAGE; ?>build/css/intlTelInput.css">
<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
<script type="text/javascript" src="<?php echo HTTP_IMAGE; ?>build/js/intlTelInput.js"></script>

<script>
    $(function() {
$("#isd_codes").intlTelInput({
allowExtensions: true,
autoFormat: false,
autoHideDialCode: false,
//autoPlaceholder: false,
autoPlaceholder: "polite",
defaultCountry: "auto",
ipinfoToken: "yolo",
nationalMode: false,
numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//preferredCountries: ['cn', 'jp'],
preferredCountries: [ "th", "us"],
preventInvalidNumbers: true,
utilsScript: "lib/libphonenumber/build/utils.js"
});
});
  </script>
