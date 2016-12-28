<?php echo $header; ?>
<section id="main_container">
    <div class="container  mar_top65">
    <section id="editprofile">
        <div class="row user_profile">
            <div class="col-md-12">
              <div class="col-md-4">
      <div id="sub_menu">
        <p class="text_account">
          <?=$customer_name?>
        </p>
        <div class="account_email">
          <?=$customer_email?>
        </div>
      </div>
      <ul class="menu">
        <li class="active" data-url="#" data-usepost="False"><a href="<?=$order_history?>"><span class="menutext">Bookings</span></a></li>
        <li data-url="#" data-usepost="False"><a href="<?=$profile?>"><span class="menutext">Profile</span></a></li>
        <li data-url="#" data-usepost="False"><a href="<?=$password?>"><span class="menutext">Change password</span></a></li>
        <li data-url="#" data-usepost="True"><a href="<?=$signout?>"><span class="menutext">Sign out</span></a></li>
      </ul>
    </div>
                <div class="col-md-8 admin_profile">
                <div class="admin_right">
                    <h3>general information</h3>
                    
                    <div class="forminsideadmin height45">
                        <label>first name:</label>
                        <div class="fieldadmin"><input type="text" name="firstname" value="<?php echo $firstname;?>"></div>
                    </div>
                    <div class="forminsideadmin height45">
                        <label>last name:</label>
                        <div class="fieldadmin"><input type="text" name="lastname" value="<?php echo $lastname;?>"></div>
                    </div>
                    <div class="forminsideadmin height45">
                        <label>gender</label>
                        <div class="fieldadmin">
                            <div class="radio_field">
                                <input type="radio" name="gender" value="male" <?php if($gender=='male'){?> checked="checked" <?php }?>>male
                                <input type="radio" name="gender" value="female" <?php if($gender=='female'){?> checked="checked" <?php }?>>female
                            </div>
                        </div>
                    </div>
                    <div class="forminsideadmin height45">
                        <label>email</label>
                        <div class="fieldadmin height45"><input type="email" name="email" value="<?php echo $email;?>"></div>
                    </div>
                     
                    <div class="forminsideadmin height45">
                        <label>phone:</label>
                        <div class="fieldadmin"><input type="text" name="countrycode" value="<?php echo $countrycode;?>" class="phone_detail" maxlength="3" ><input type="text" name="mobile" class="phone_detail1" value="<?php echo $mobile;?>"></div>
                    </div>
                    <div class="forminsideadmin height45">
                        <label>nationality:</label>
                        <div class="fieldadmin">
                            <select name="nationality" >
                                <option value="Thailand" <?php if($nationality=='Thailand'){?> selecated="selecated" <?php }?> >Thailand</option>
                                <option value="India" <?php if($nationality=='India'){?> selecated="selecated" <?php }?> >India</option>
                                <option value="China" <?php if($nationality=='China'){?> selecated="selecated" <?php }?> >China</option>
                                <option value="America" <?php if($nationality=='America'){?> selecated="selecated" <?php }?> >America</option>
                                <option value="Australlia" <?php if($nationality=='Australlia'){?> selecated="selecated" <?php }?> >Australlia</option>
                            </select>
                        </div>
                    </div>
                    <div class="forminsideadmin height45">
                        <label>display language</label>
                        <div class="fieldadmin">
                            <select name="displang">
                                <option value="English"  <?php if($displang=='English'){?>selecated="selecated" <?php }?> >English</option>
                                <option value="Hindi" <?php if($displang=='Hindi'){?> selecated="selecated" <?php }?>>Hindi</option>
                                <option value="French" <?php if($displang=='French'){?> selecated="selecated" <?php }?>>French</option>
                                <option value="Russian" <?php if($displang=='Russian'){?> selecated="selecated" <?php }?>>Russian</option>
                                <option value="Latin" <?php if($displang=='Latin'){?> selecated="selecated" <?php }?>>Latin</option>
                            </select>
                        </div>
                    </div>
                </div>
               <!--  <div class="admin_right mar20 log">
                    <h3>facebook connect</h3>
                    <a href="#" title="share on facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>log in with facebook</a>
                </div> -->
                <div class="admin_right check log">
                    <h3>newsletter</h3>
                    <div class="squaredThree">
                        <input type="checkbox"  id="squaredThree" name="newsletter" value="1" <?php if($newsletter==1){?>checked="checked"<?php }?> />
                        <label for="squaredThree"></label>
                    </div>
                </div>
                <div class="change mar40">
                    <button type="button" id="updateAccount">Save</button>
                 </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</section>
<script type="text/javascript"><!--
$('button[id^=\'updateAccount\']').on('click', function() {
    $.ajax({
        url: 'index.php?route=account/edit/validate',
        type: 'post',
        data: $('input[type=\'text\'],input[type=\'email\'], input[type=\'radio\']:checked, input[type=\'checkbox\']:checked, select'),
        dataType: 'json',
        crossDomain: true,
        beforeSend: function() {
                    // $('#main_container').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
                    var mobile = $(".phone_detail1").val();
                    var str_length = mobile.length;
                    if(str_length!=9){

                        $(".phone_detail1").css("border-color", "red");
                        $('#main_container').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
                    }

                    if(str_length==9){

                        $(".phone_detail1").css("border-color", "#ccc");
                        $('#main_container').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');

                    }
                    
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
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});

$('.datetime').datetimepicker({
    pickDate: true,
    pickTime: true
});

$('.time').datetimepicker({
    pickDate: false
});
//--></script>
<?php echo $footer; ?>