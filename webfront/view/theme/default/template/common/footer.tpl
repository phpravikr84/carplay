<div class="container-fluid knowspa">
  <div class="blcky"></div>
  <div class="newhome-box">
    <div class="box-center float-right">
      <div class="title-wanttoput normal-font font-weight-normal"> <b> Want to put your Spa or Salon on Riwigo? </b> </div>
      <div class="detail-wanttoput normal-font font-weight-normal"> <em> It's super easy! Just write an email to us at </em>
        <div class="row">
          <div class="col-md-6"><a href="index.php?route=account/spa">I have a Spa Salon</a></div>
           <div class="col-md-6"> <!-- <a href="index.php?route=information/information&information_id=7"> --><a href="index.php?route=account/sparecommended">I know a Spa or Salon </a></div>
        </div>
      </div>
      <div class="footer-btnlogin-box"> <a href="admin" class="a-email detail-wanttoput normal-font font-weight-normal" title="click here" target="_blank">Click here for<span class="normal-font"> Partner Login</span> </a></div>
    </div>
  </div>
</div>
<div class="container-fluid news">
  <div class="newhome-box">
    <div class="title-wanttoput normal-font font-weight-normal"> <b> Want to receive the latest promotions from riwigo? </b>
      <div class="detail-wanttoput normal-font font-weight-normal"> subscribe to our e-newsletter. </div>
    </div>
    <div class="subscribe-box">
      <input type="email" name="email-subscribe" id="emailsubscribe" class="input-subscribe" placeholder="your email">
      <!-- <a href="javascript:void(0);" title="subscribe" onclick="usersubscribe();" class="bnt-footer-subscribe">subscribe</a>  -->
       <button type="button" title="subscribe" id="usersubscribe" class="bnt-footer-subscribe">subscribe</button>  <br/><p style="font-size:11px; color:#333; padding-top:10px;" id="subscription"> </p></div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="row">
      <?php if ($informations) { ?>
      <div class="col-md-3 col-sm-12">
        <ul class="list-unstyled">
          <li><a href="#"><img src="image/logo.png" /></a></li>
          <li><a href="#"><p>Riwigo ® is a registered trademark of Riwigo Solutions Co., Ltd. Thailand</p></a></li>
        </ul>
      </div>
      <?php } ?>
      <div class="col-md-3 col-sm-12">
        <h5>About Us <span class="dashh"></span></h5>
        <ul class="list-unstyled">
          <li><a href="#">Riwigo.com website is fast, easy to use, and leverage world-class futuristic technology to offer instant confirmation for every booking. Additionally, all the reviews are submitted by customers and are 100% authentic.</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-12">
        <h5>USEFUL LINK <span class="dashh"></span></h5>
        <ul class="list-unstyled">
          <li><a href="<?=$contact?>">contact Us</a></li>
          <li><a href="<?=$aboutus?>">about Us</a></li>
          <li><a href="<?=$faq?>">faq</a></li>
           <li><a href="<?=$howrw?>">how riwigo woriks</a></li>
           
          <li><a href="<?=$terms?>">terms & conditions</a></li>
          <li><a href="<?=$privacy?>">privacy policy</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-12">
        <h5>Address <span class="dashh"></span></h5>
        <ul class="list-unstyled">
          <li>
            <a href="#">Thailand: Riwigo thailand - head office
            Sukhumvit Soi 19 (Asoke) road,
            Klongtoey nua, wattman, Bangkok 10110, Thailand
            support@riwigo.com</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid ftr">
      <p><?php echo $powered; ?></p>
  </div>
</footer>

<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->

<script>
$(document).ready(function(){

  $("#usersubscribe").click(function(){

        var email = $('#emailsubscribe').val();
        //alert(email);

          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          var res = regex.test(email);
          if(res==true){
          $.ajax({
            url:'index.php?route=account/mailsubscribe/subscription',
            type:'post',
            data:'subscribemail='+email,
            success:function($data){
                console.log($data);
                $("#subscription").html($data);
            },
            error:function(){
              console.log("Mail not subscribe");
            }

          });
        }
        else{

          $("#subscription").html('Invalid Mail');
        }
  });

});

</script>

</body></html>