<?php echo $header; ?><?php echo $home_search; ?>
<section id="main_container">
<div class="container adds">
  <a href="http://novotelhuahin.com/inbalance-by-novotel/inbalance-spa/" target="_blank"><img src="image/ads.png" alt="ads" ></a>
  </div>
  <div class="container"> <?php echo $home_category; ?> <?php echo $home_services; ?> <?php echo $home_merchant; ?> </div>
</section>
<div class="container-fluid knowspa">
  <div class="blcky"></div>
  <div class="newhome-box">
    <div class="box-center float-right">
      <div class="title-wanttoput normal-font font-weight-normal"> <b> Want to put your Spa or Salon on Riwigo? </b> </div>
      <div class="detail-wanttoput normal-font font-weight-normal"> <em> It's super easy! Just write an email to us at </em>
        <div class="row">
          <div class="col-md-6"><a href="index.php?route=account/register">I have a Spa Salon</a></div>
          <div class="col-md-6"> <a href="index.php?route=information/information&amp;information_id=7">I know a Spa or Salon </a></div>
        </div>
      </div>
      <div class="footer-btnlogin-box"> <a href="admin" class="a-email detail-wanttoput normal-font font-weight-normal" title="click here" target="_blank">Click here for</a> <span class="normal-font"> Partner Login</span> </div>
    </div>
  </div>
</div>
<div class="container-fluid news">
  <div class="newhome-box">
    <div class="title-wanttoput normal-font font-weight-normal"> <b> Want to receive the latest promotions from riwigo? </b>
      <div class="detail-wanttoput normal-font font-weight-normal"> subscribe to our e-newsletter. </div>
    </div>
    <div class="subscribe-box">
      <input type="email" name="email-subscribe" id="email-subscribe" class="input-subscribe" placeholder="your email">
      <a href="javascript:void(0);" title="subscribe" onclick="usersubscribe();" class="bnt-footer-subscribe">subscribe</a> </div>
  </div>
</div>
<?php //echo $home_media; ?> 
<?php echo $footer; ?>