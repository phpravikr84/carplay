<!--<fieldset>
  <legend><?php echo $text_captcha; ?></legend>
  <div class="form-group required">
    <?php if (substr($route, 0, 9) == 'checkout/') { ?>
    <label class="control-label" for="input-payment-captcha"><?php echo $entry_captcha; ?></label>
    <input type="text" name="captcha" id="input-payment-captcha" class="form-control" />
    <img src="index.php?route=captcha/basic_captcha/captcha" alt="" />
    <?php } else { ?>
    <label class="col-sm-2 control-label" for="input-captcha"><?php echo $entry_captcha; ?></label>
    <div class="col-sm-10">
      <input type="text" name="captcha" id="input-captcha" class="form-control" />
      <img src="index.php?route=captcha/basic_captcha/captcha" alt="" />
      <?php if ($error_captcha) { ?>
      <div class="text-danger"><?php echo $error_captcha; ?></div>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</fieldset>-->

 <div class="login_section">
                <div class="login_input">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <div  class="captcha"  ><img src="index.php?route=captcha/basic_captcha/captcha" alt="" /></div> 
                </div>
                </div>
                <div class="login_section">
                <p class="remember">can't read the text? click <a href="javascript: void(0)" onClick="reCaptcha();" style="color:#fd7c01;">here</a> to refresh</p>
                </div>
                <div class="login_section">
                <div class="login_input">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <input type="text" id="frmCaptch" class="input-box normal-font" name="cpassword" placeholder="please enter a valid captcha code">
                </div>
                </div>