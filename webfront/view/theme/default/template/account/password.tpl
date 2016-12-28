<?php echo $header; ?> 
<!--account -->

<div class="container">
<div class="row ordrhstry">

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
    </div><!--end col-md-4-->

<div class="col-md-8">
    <section id="faq">
        <div class="row user_profile">
            <div class="col-md-12">
                <div class="row">
                    
                </div><!--end col-md-4-->


                <div class="row admin_profile">
                <div class="admin_right change_password">
                 
                     <div class="admin_right change_password">
                    <h3>Change Password</h3>
                </div>
                <div class="change" id="success" style="padding-left: 10px;"></div>  
                <div class="change">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="password">
                        <span  id="error_password" ng-show="submitted && loginForm.frmUserEmail.$error.required"></span>    
                </div>
                <div class="change">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <input type="password" name="confirm" placeholder="Confirm password">
                        <span  id="error_confirm" ng-show="submitted && loginForm.frmUserEmail.$error.required"></span>    
                </div>
                    
                 <div class="change mar40">
                     <button type="button" id="button-request-password">Done</button>
                 </div>
                    
                </div>
            </div>
        </div>
    </section>
</div><!--end col-md-8-->

</div><!--end ordhstry-->
</div><!-- end container-->

    


<script type="text/javascript"><!--
$('#button-request-password').on('click', function() { 

    $.ajax({
            url: 'index.php?route=account/password/validate',
            type: 'post',
            data: $('input[type=\'password\']'),
            dataType: 'json',
            crossDomain: true,
            beforeSend: function() {
                $('#faq').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');

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

                if (json['error_password']) {
                     
                    $('#error_password').prepend('<div class="text-danger">' + json['error_password'] + '  </div>');

                }else if(json['error_confirm']){
                        
                    $('#error_confirm').prepend('<div class="text-danger">' + json['error_confirm'] + '  </div>');

                }else if (json['success']) { //alert('success');
                     $('#success').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>' + json["success"] + '<button data-dismiss="alert" class="close" type="button">×</button></div>');
                }           
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
    });
});
//--></script>
<?php echo $footer; ?>