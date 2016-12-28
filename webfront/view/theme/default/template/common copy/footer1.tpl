<footer>
  <div class="content-footer">
    <div class="container">
      <div class="newhome-footer-content">
        <div class="row">
        <!--   
          <div class="col-md-4">
            <div class="newhome-box">
              <div class="title-wanttoput normal-font font-weight-normal"> <b>
                <?=$text_footer1?>
                </b> </div>
              <div class="detail-wanttoput normal-font font-weight-normal">
                <?=$text_footer2?>
              </div>
              <div class="subscribe-box">
                <div class="icon-search-date icons-email-subscribe"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                <input type="email" name="email-subscribe" id="email-subscribe" class="input-subscribe" placeholder="your email">
                <a href="javascript:void(0);" title="subscribe" onClick="usersubscribe();" class="bnt-footer-subscribe">subscribe</a> </div>
            </div>
          </div>
          
       <div class="col-md-4">
            <div class="newhome-box">
              <div class="float-right">
                <div class="title-wanttoput normal-font font-weight-normal padding-left12"> <b>
                  <?=$text_footer5?>
                  </b> </div>
                <!--<a href="#" class="footer-img-social" id="social-facebook" title="Facebook"> <img src="image/facebook.jpg" alt="facebook" title="facebook" pagespeed_url_hash="2690739995"> </a> <a href="#" class="footer-img-social" title="Instagram"> <img src="image/instagram.jpg" alt="instagram" title="instagram" pagespeed_url_hash="2069329595"> </a> <a href="#" class="footer-img-social" title="Twitter"> <img src="image/twitter.jpg" alt="twitter" title="Twitter"> </a> <a href="#" class="footer-img-social" title="Linkedin"> <img src="image/linkedin.jpg" alt="linkedin" title="Linkedin"> </a> <a href="#" class="footer-img-social" title="Youtube"> <img src="image/youtube.jpg" alt="youtube" title="youtube" pagespeed_url_hash="4232928632"> </a> <a href="#"> <img src="image/icon-download-ios.svg" alt="app store" title="app store" class="img-app-footer"> </a> <a href="#"> <img src="image/icon-download-android.svg" alt="google play" title="google play" class="img-app-footer"> </a> 
                -->
                <a href="#" class="footer-img-social fb" id="social-facebook" title="Facebook"></a>
					<a href="#" class="footer-img-social inst" title="Instagram"> </a>
					<a href="#" class="footer-img-social twit" title="Twitter">  </a>
					<a href="#" class="footer-img-social link" title="Linkedin"> </a>
					<a href="#" class="footer-img-social you" title="Youtube">  </a>
					<a href="#" class="playstr"> <img src="image/icon-download-ios.svg" alt="app store" title="app store" class="img-app-footer"> </a>
					<a href="#" class="playstr"> <img src="image/icon-download-android.svg" alt="google play" title="google play" class="img-app-footer"> </a>
                
                </div>
            </div>
          </div>-->
          
          
          
        </div>
      </div>
      <div class="row">
        <div class="link-staticpage">
          <ul class="footernav">
            <li> <a href="<?php echo $contact?>" title="<?php echo $text_contact;?>" class="txt-newhome-footer"><?php echo $text_contact;?></a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="<?php echo $aboutus;?>" title="<?php echo $text_aboutus;?>" class="txt-newhome-footer"><?php echo $text_aboutus;?></a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="<?php echo $faq;?>" title="FAQ" class="txt-newhome-footer">FAQ</a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="#" title="press release" class="txt-newhome-footer">press release</a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="#" title="career" class="txt-newhome-footer">career</a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="<?php echo $terms;?>" title="terms and conditions" class="txt-newhome-footer"><?php echo $text_terms;?></a> </li>
            <li> <a class="txt-newhome-footer vertical-line">|</a> </li>
            <li> <a href="<?php echo $privacy;?>" title="privacy policy" class="txt-newhome-footer"><?php echo $text_privacy;?></a> </li>
          </ul>
          <p class="footer-coppyright"> copyright 2016 all right reserved </p>
        </div>
      </div>
      <div class="row">
        <div class="leave"><a href="#" title="leave"><img src="image/leave.jpg" alt="" title=""></a></div>
      </div>
    </div>
  </div>
</footer>
<div id="back-top"> <a href="#top"><span></span></a> </div>
<script>
$(document).ready(function () {
	$('#main-nav  ul.drop').dropotron({ offsetY: -10 });
});
</script> 
<script>
$(document).ready(function(e) {
	$(".drop_1").mouseover(function(e) {
     $(".active-cuisine1").hide();    
    });
	$(".drop_2").mouseover(function(e) {
     $(".active-cuisine").hide();    
    });
	 $(".active-cuisine").hide(); 
	 $(".active-cuisine1").hide();
	$(".active-cuisine").mouseover(function(e) {
            $(".active-cuisine").css("display", "block"); 
			$(".active-cuisine1").css("display", "none"); 
			$(".ms-options-wrap button").css("border-radius", "0");
			$(".ms-options-wrap button").css("border", "none");
            });
			$(".active-cuisine,.active-cuisine1").mouseout(function(e) {
            $(".active-cuisine,.active-cuisine1").css("display", "block"); 
			$(".ms-options-wrap button").css("border-radius", "0px");
            });
			$(".active-cuisine1").mouseover(function(e) {
            $(".active-cuisine1").css("display", "block"); 
            });
			$(".active-cuisine1").mouseout(function(e) {
            $(".active-cuisine1").css("display", "block"); 
			$(".active-cuisine").css("display", "none"); 
            });
			
		if($(".ms-options-wrap button")){
			$(".ms-options-wrap button").mouseover(function(e) {
            $(".active-cuisine,.active-cuisine1").css("display", "block"); 
			$(".ms-options-wrap button").css("border-radius", "0");
			$(".ms-options-wrap button").css("border", "none");
            });
			}
			else{
			$(".active-cuisine,.active-cuisine1").css("display", "none");	
				}
				if($(".ms-options-wrap button")){
			$(".ms-options-wrap button").mouseout(function(e) {
            $(".active-cuisine,.active-cuisine1").css("display", "none"); 
            });
			}
			else{
			$(".active-cuisine,.active-cuisine1").css("display", "none");	
				}
});
</script>