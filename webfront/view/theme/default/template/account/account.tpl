<?php echo $header; ?>

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
                    <div class="user_left">
                        <div class="profile_img">
                            <img src="image/user.png">
                        </div>
                        

                        <div class="user_details">
                            <h5><?php echo ucfirst($firstname);?></h5>
                            <p><b>member&nbsp;:&nbsp;</b>since <?php echo $date_added;?></p>
                            <p><b>last online&nbsp;:&nbsp;</b><?php echo date('d M Y');?> </p> 
                        </div>                     
                
                    </div>
                </div><!--end col-md-4-->


                <div class="row admin_profile">
                <div class="admin_right">
                    <h3>general information</h3>    
                        <div class="edit"><a href="<?php echo $edit;?>"><i class="fa fa-pencil" aria-hidden="true"></i><p><?php echo $text_edit;?></p></a></div>
                    <div class="forminsideadmin">
                        <label>name:</label>
                        <div class="fieldadmin"><?php echo $firstname;?></div>
                    </div>
                     
                    <div class="forminsideadmin">
                        <label>gender</label>
                        <div class="fieldadmin"><?php echo $gender;?></div>
                    </div>
                    <div class="forminsideadmin">
                        <label>email</label>
                        <div class="fieldadmin"><?php echo $email;?></div>
                    </div>
                    <div class="forminsideadmin">
                        <label>phone:</label>
                        <div class="fieldadmin"><?php echo $mobile;?> </div>
                    </div>
                    <div class="forminsideadmin">
                        <label>nationality:</label>
                        <div class="fieldadmin"><?php echo $nationality;?> </div>
                    </div>
                    <div class="forminsideadmin">
                        <label>display language</label>
                        <div class="fieldadmin"><?php echo $displang;?></div>
                    </div>
                </div>
                <!-- <div class="admin_right mar20 log">
                    <h3><?php echo $text_fb_connect;?></h3>
                    <a href="#" title="share on facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><?php echo $text_login_fb;?></a>
                </div> -->
                <div class="admin_right check log">
                    <h3><?php echo $text_my_newsletter;?></h3>
                    <div class="squaredThree">
                        <input type="checkbox"   id="squaredThree" name="check" <?php if($newsletters==1){?>checked="checked"<?php }?> />
                        <label for="squaredThree"></label>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </section>
</div><!--end col-md-8-->

</div><!--end ordhstry-->
</div><!-- end container-->


<?php echo $footer; ?> 