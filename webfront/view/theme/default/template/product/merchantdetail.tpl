<?php echo $header; ?>
<?php //echo $content_top; ?>
<script src="https://maps.googleapis.com/maps/api/js?&key=AIzaSyDLAcZPXapOVnn9vRbaqel3MMp3ZRjTM3U&v=3.exp&sensor=true"></script>
<section id="detail">
  <div class="container">
    <div class="row mar_top45">
      <div class="col-md-8">
        <div class="detail_left">
          <div class="full_cont">
            <div class="detail_left_cont">
              <h3>
                <?=$name;?>
              </h3>
              <div style="clear:both"></div>
              <p>
                <?=$city;?>
                <?=$location;?>
              </p>
              <div class="new-resto-detail-2-line">
                <div class="box-detail-rating-gray">
                  <div class="box-detail-rating-yellow_b" style="width:<?=$price_level;?>%;"></div>
                </div>
                <div class="box-price-gray">
                  <div class="box-detail-price-yellow_b" style="width:<?=$rating;?>%;"></div>
                </div>
              </div>
            </div>
            <div class="detail_right_cont">
              <div class="rating">
                <?=$arating;?>
                <i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
          </div>
          <div id="owl-demo" class="owl-carousel">
            <div class="item"><img src="<?=$firstImage?>"  height="450"   /></div>
            <?php foreach ($images as $image) { ?>
            <div class="item"> <img src="<?=$image['thumb']?>"    height="450"   /></div>
            <?php } ?>
            <!---  <p class="slider_text">
                <?=$reserved?>
            </    reservation made recently</p> --> 
            </div>
             
          
          <div class="tab">
            <ul>
              <li><a href="javascript:(void);" title="detail" class="active tab2a">
                <?=$tab_detail?>
                </a></li>
              <li><a href="javascript:(void);" title="ecommended menu" class="tab2b">
                <?=$tab_recommanded?>
                </a></li>
              <li><a href="javascript:(void);" title="rating (629)" class="tab2c">terms</a></li>
              <li> 
                <!-- <a href="javascript:(void);" title="map" class="tab2d">map</a> --> 
                
                <!-- <input id="btnShow" type="button" value="Show Maps" /> --> 
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myMapModal">map</button>
                
               <!--  <a href="#myMapModal" class="btn" data-toggle="modal">map</a>  -->
                <!-- <a href="javascript:(void);" title="map" id="btnShow">map</a> --> 
                <!--  <div id="dialog" style="display: none">
        <div id="dvMap" style="height: 380px; width: 580px;">
        </div>
    </div> --> 
                
              </li>
            </ul>
            <div class="tab_contant">
              <div class="tab1"><b>
                <?=$entry_about?>
                </b>
                <p>
                  <?=$description?>
                </p>
                <div class="forminside">
                  <div class="inside_full">
                    <label>
                      <?=$entry_address?>
                      :</label>
                    <div class="field">
                      <?=$address;?>
                    </div>
                  </div>
                  <div class="inside_full">
                    <label>
                      <?=$entry_atmosphere?>
                      :</label>
                    <div class="field">
                      <?php if($atmosphere){?>
                      <?php foreach ($atmosphere as $atmos) { ?>
                      <?=$atmos['name']?>
                      <br>
                      <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="inside_full">
                    <label>
                      <?=$entry_facilities?>
                      :</label>
                    <div class="field">
                      <?php if($facilities){?>
                      <?php foreach ($facilities as $facilitie) { ?>
                      <?=$facilitie['name']?>
                      <br>
                      <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="inside_full">
                    <label>
                      <?=$entry_spoken_language?>
                      :</label>
                    <div class="field">
                      <?php if($spoken_language){?>
                      <?php foreach ($spoken_language as $spoken_languag) { ?>
                      <?=$spoken_languag['name']?>
                      <br>
                      <?php } ?>
                      <?php } ?>
                    </div>
                    <div class="inside_full">
                      <label>
                        <?=$entry_opening_time?>
                        :</label>
                      <div class="field">
                        <?=$from_opeining_hours?>
                        to
                        <?=$to_opening_hours?>
                      </div>
                    </div>
                    <!-- <div id="googleMap" style="width:500px;height:380px;"></div> -->
                    <?php
                 // Get lat and long by address         
                  //$address = $dlocation; // Google HQ
                  $prepAddr = str_replace(' ','+',$address);
                  $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
                  $output= json_decode($geocode);
                  if(isset($latitude) && !empty($latitude)){

                    $lat = $latitude;

                  }
                  else{

                    $lat = $output->results[0]->geometry->location->lat;

                  }

                  if(isset($longitude) && !empty($longitude)){

                    $longt = $longitude;

                  }
                  else{
                      
                      $longt = $longitude = $output->results[0]->geometry->location->lng;
                  }
                  
                  ?>
                    <input type="hidden" name="lat" id="lat" value="<?php echo $lat; ?>">
                    <input type="hidden" name="longt" id="longt" value="<?php echo $longt; ?>">

                    <?php $maptitle = str_replace("'", "", $name); ?>
                    <div class="inside_full">
                      <label>share this page :</label>
                      <div id="shareIcons"></div>

                      <!-- <div class="field"> <a href="#" title="facebook"><img src="image/facebook.jpg" alt="facebook" title="facebook"></a> <a href="#" title="twitter"><img src="image/twitter.jpg" alt="twitter" title="twitter"></a> <a href="#" title="linkedin"><img src="image/linkedin.jpg" alt="linkedin" title="linkedin"></a> </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab2">
                <table border="0" class="comman_table">
                  <tr>
                    <td>menu</td>
                    <td>duration</td>
                    <td>price</td>
                    <td>discount</td>
                    <td align="right"><select name="recService" id="recService">
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="30">30%</option>
                        <option value="40">40%</option>
                        <option value="50">50%</option>
                      </select>
                      <input type="hidden" name="merchant_id" value="<?=$merchant_id?>"></td>
                  </tr>
                  <tbody id="discountRow">
                    <?php foreach($merchant_recomanded as $merchant_recomand) { ?>
                    <tr >
                      <td><?=$merchant_recomand['name']?></td>
                      <td><?=$merchant_recomand['duration']?></td>
                      <td><del>
                        <?=round($merchant_recomand['price'])?>
                        </del></td>
                      <td><?php echo ($merchant_recomand['price']  - (($merchant_recomand['price'] * 10)/100))?></td>
                      <td></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
                <!-- <div class="btn_more"><a href="#">more...</a></div> -->
                <div class="forminside">
                  <div class="inside_full">
                    <p>*Services and pricing subject to change without notice.</p>
                    <p>*All prices in THB and are exclusive of VAT and service charge according to the policy of the restaurants.</p>
                   <!--  <label>share this page :</label>
                    <div id="shareIcons"></div> -->
                    <!-- <div class="field"> <a href="#" title="facebook"><img src="image/facebook.jpg" alt="facebook" title="facebook"></a> <a href="#" title="twitter"><img src="image/twitter.jpg" alt="twitter" title="twitter"></a> <a href="#" title="linkedin"><img src="image/linkedin.jpg" alt="linkedin" title="linkedin"></a> </div> -->
                  </div>
                </div>
              </div>
              <div class="tab3">
                <h3 style="margin-top:0px;">terms & condition</h3>
                <?=$terms?>
              </div>
              <div class="tab4">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4" id="orderform">
        <div class="detail_right">
          <h4>enter reservation details</h4>
          <div class="detail_right_cont1">
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-calendar" aria-hidden="true"></i></div>
              <select class="date-select normal-font font-weight-normal" id="bookingdate" name="bookingDate">
                <?php $date = time();
                  $curdate = time();
                  
                //  print $curdate;exit;
                  
                for ( $i=1; $i<32; $i++ ) {
                  
                    if($curdate == $date){
                      $dateOption = 'today';
                        
                    }elseif($i==2){
                      $dateOption = 'tomorrow';
                         
                    }else{
                      $dateOption = date("D d M Y", $date);
                        
                    }
                
                 ?>
                <option value="<?php echo date("Y-m-d", $date); ?>" <?php if($bookingDate == date("Y-m-d", $date)) { echo 'selected="selected"'; } ?> >&nbsp;<?php echo $dateOption ;?> </option>
                <?php 
                  $date = strtotime(date("Y-m-d", $date) . " +1 day" ); 
                 }?>
              </select>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-users" aria-hidden="true"></i></div>
              <select class="date-select normal-font font-weight-normal" id="bookingPerson" name="bookingPerson">
                <option value="" selected="">Select Person</option>
                <?php for ( $i=1; $i<10; $i++ ) {?>
                <option value="<?=$i?>"  <?php if($i== $bookingPerson){ echo 'selected="selected"';}?> >
                <?=$i?>
                Person</option>
                <?php }?>
              </select>
            </div>
            <div class="row"> <a class="js-open-modal loginpopup" href="javascript:void(0)" data-modal-id="loginpopup" style="display:none">
              <button ng-click="submitted=true" class="btn_login " type="button">click to select service</button>
              </a> </div>
            <div class="row1">
              <div class="row-img1" id="f1"><img src="image/fav_icon_grey.png" style="padding:6px;"/><!-- <i class="fa fa-hand-scissors-o" aria-hidden="true"> </i>--></div>
              <div class="group_field"> <a class="js-open-modal" href="javascript:void(0)" data-modal-id="popup">
                <input type="text" class="date-select normal-font font-weight-normal" name="bookingServices" value="<?=$bookingServices?>" placeholder="click to select service" >
                </a> </div>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
              <div class="group_field">
                <input type="text" class="date-select normal-font font-weight-normal" name="bookingDuration" value="<?=$bookingDuration?>" placeholder="duration" readonly >
              </div>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-usd" aria-hidden="true"></i></div>
              <div class="group_field">
                
               <!--  <input type="text" class="date-select normal-font font-weight-normal" id="bookingVlaue" name="bookingVlaue" value="<?=$bookingPrice?>" placeholder="price" readonly> -->

            

                <input type="text" class="date-select normal-font font-weight-normal" id="bookingVlaue" name="bookingVlaue" value="<?php $bookingP = str_replace(',','',$bookingPrice); echo (int)$bookingP; ?>" placeholder="price" readonly>
              </div>
            </div>
            <div class="slot-loading " id="slot-loading"  style="margin-bottom:10px;">
              <div class="row-img4" id="f1"><i class="fa fa-empire" aria-hidden="true"></i><span>Pick your Time and Discount</span></div>
              <div class="swiper-container" id="disocuntSlots">
                <div class="swiper-wrapper column">
                  <?php if($discounts){ $activeDisc = false; $i=1;?>
                  <?php foreach ($discounts as $discount){  ?>
                  <?php if($bookingPerson <= ($discount['seats'] - $discount['used_seats'])){ ?>
                  <a href="javascript:void(0)" title="offer" id="slottoday<?php echo $discount['merchant_disc_id'];?>" class="swiper-slide red-slide" onClick="selectDiscountToday(<?php echo $discount['merchant_disc_id'];?>)" >
                  <p id="todaydiscT<?php echo $discount['merchant_disc_id'];?>">
                    <?=$discount['start_time']?>
                  </p>
                  <b id="todaydiscP<?php echo $discount['merchant_disc_id'];?>">
                  <?=$discount['discount']?>
                  %</b>
                  <p>off</p>
                  </a>
                  <?php }?>
                  <?php }?>
                  <?php } else { ?>
                  <p style="margin-top: 20%; margin-left: 10%;">Venue Closed. Try another day.</p>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-user" aria-hidden="true"></i></div>
              <div class="group_field">
                <input type="text" class="date-select normal-font font-weight-normal" id="name" name="customerName" value="<?=$customerName?>" placeholder="guest name">
                <?php if(!$loged) { ?>
                <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <?php }?>
              </div>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-envelope" aria-hidden="true"></i></div>
              <div class="group_field">
                <input type="text" class="date-select normal-font font-weight-normal" value="<?=$customerEmail?>" name="email" placeholder="email">
              </div>
            </div>
            <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-phone" aria-hidden="true"></i></div>
              <div class="group_field">
                <input type="text" class="date-select normal-font font-weight-normal" id="mobile" name="mobile" value="<?=$customerMobile?>" placeholder="phone number">
              </div>
            </div>
            <!-- <div class="row1">
              <div class="row-img1" id="f1"><i class="fa fa-gift" aria-hidden="true"></i></div>
              <div class="group_field">
                <input type="text" class="date-select normal-font font-weight-normal"  name="promoCode" placeholder="promo code">
              </div>
            </div>-->
            <input type="hidden" name="bookingProductId" value="" >
             <input type="hidden" name="bookingPrice" value="<?=$bookingPrice?>" >
            <input type="hidden" name="bookingDiscountTime" value="" >
            <input type="hidden" name="bookingDisocuntId" value="" >
            <input type="hidden" name="bookingMerchantId" value="<?=$merchant_id;?>" >
            <input type="hidden" name="bookingMerchantName" value="<?=$name;?>" >
            <input id="bookingDiscount" name="bookingDiscount" type="hidden">
            <button ng-click="submitted=true" class="btn_login" id="reviewReservation" type="button">click to review reservation</button>
          </div>
          
          <!-- Error Popup Start -->
          <div class="widget-tfl" id="widget-tfl" style="display: none;">
            <div class="row1 widget-tfl-box"  >
              <div class="widget-tfl-txt"><b id="errText"></b>
                <select class="date-select normal-font font-weight-normal" id="popupBookingServices" name="popupBookingServices" style="display:none">
                  <option value="" selected="">Select a Service</option>
                  <?php foreach ($merchant_services as $merchant_service) { ?>
                  <option value="<?=$merchant_service['product_id']?>">
                  <?=$merchant_service['name']?>
                  </option>
                  <?php }?>
                </select>
                </br>
                </br>
                </br>
                <a href="javascript:void(0)" id="clsoeBtn">
                <h4>Close</h4>
                </a> </div>
            </div>
          </div>
          <!-- Error Popup End --> 
          
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Service Popup Start -->
<div id="popup" class="modal-box "> <a href="javascript:void(0)" class="js-modal-close close">×</a>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xm-12" >
      <div id="loadmore-group-resto" class="home-box-loadmore"> <a class="btn-home-more" title="more" href="javascript:void(0);">Services</a> </div>
    </div>
  </div>
  <div class="modal-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>name of service</th>
          <th>duration</th>
          <th>price</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($merchant_services as $merchant_service) { ?>
        <tr id="bookedRow<?=$i?>">
          <th scope="row"><?=$i?></th>
          <td><?=$merchant_service['name']?></td>
          <td><?=$merchant_service['duration']?></td>
          <td><?=($merchant_service['amount'])?></td>
          <td><button  ng-click="submitted=true" class="btn_popup js-modal-close"  onClick="selectService('<?=$merchant_service['name']?>','<?=$merchant_service['duration']?>','<?=round($merchant_service['price'])?>', '<?=$merchant_service['product_id']?>','<?=$i?>')" type="button">select</button><!-- <a href="index.php?route=product/merchantdetail&merchant_id=<?php echo $merchant_service['merchant_id']; ?>&product_id=<?php echo $merchant_service['product_id'];?>"><button type="button" class="btn_popup js-modal-close"> select </button></a> -->
          </td>
        </tr>
        <?php $i++; }?>
        <!--<tr >
          <td colspan="5"><a href="javascript:void(0)" class="js-modal-close">
            <button ng-click="submitted=true" class="btn_popup "  type="button">Done</button>
            </a></td>
        </tr>-->
      </tbody>
    </table>
  </div>
</div>
<!-- Service Popup End --> 

<!-- Login Popup Start -->
<div id="loginpopup" class="modal-box "> <a href="javascript:void(0)" class="js-modal-close close">×</a>
  <div id="loadmore-group-resto" class="home-box-loadmore"> <a class="btn-home-more" title="more" href="javascript:void(0);">Login</a> </div>
  <div class="modal-body">
    <div id="faq">
      <p style=" text-align: center;">log in to access your account<br>
        and see your reservation history.</p>
      <form name="loginForm"  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="login_section "><span id="warningerror"></span></div>
        <div class="login_section ">
          <div class="login_input"> <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="email" id="frmUserEmail" class="input-box normal-font" name="frmUserEmail" placeholder="<?php echo $entry_email;?>"  ng-model="frmUserEmail" required>
            <span  id="error_email" ng-show="submitted && loginForm.frmUserEmail.$error.required"></span> </div>
        </div>
        <div class="login_section errorpasword">
          <div class="login_input"> <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <input type="password" id="frmUserPassword"  class="input-box normal-font" name="frmUserPassword" placeholder="<?php echo $entry_password;?>" ng-model="frmUserPasswordmail" required ng-minlength="6">
            <input type="hidden" id="frmUserRedirect"  class="input-box normal-font" name="frmUserRedirect" placeholder="<?php echo $entry_password;?>" ng-model="frmUserPasswordmail" required ng-minlength="6" value="<?=$redirect?>">
            <span id="error_password" ng-show="submitted && loginForm.frmUserPassword.$error.required"></span> </div>
        </div>
        <div class="login_section">
          <p class="remember"><?php echo $text_forgotten;?></p>
        </div>
        <div class="login_section">
          <button type="button"  id="button-login" class="btn_login" ng-click="submitted=true"><?php echo $text_login;?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Login Popup End -->
<script>
    $(document).ready(function() {

      var owl = $("#owl-demo");

      owl.owlCarousel({
        navigation : false,
        singleItem : true,
        transitionStyle : "fade"
      });

      //Select Transtion Type
      $("#transitionType").change(function(){
        var newValue = $(this).val();

        //TransitionTypes is owlCarousel inner method.
        owl.data("owlCarousel").transitionTypes(newValue);

        //After change type go to next slide
        owl.trigger("owl.next");
      });
    });
    </script>

     <style type="text/css">.btn-default{border:none!important; color:#777!important;}
    .btn {padding: 10px 20px !important; float:left; color:#777; outline:none; border: 1px solid #fff; }div.modal-dialog{width:594px !important;}</style> 
<style type="text/css">
#map-canvas {
width: 560px;
  height:480px;
}
</style>
<!-- Map Popup Start -->
<div class="modal fade" id="myMapModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Map</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div id="map-canvas" class="" width=""></div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> 
        <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --> 
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 
<!-- Map Popup End --> 

<?php echo $footer; ?> 

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>--> 
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css"
        rel="stylesheet" type="text/css" />
<style type="text/css">
.ui-widget-header{background:#00aebd!important; border-color:#00aebd!important; } .ui-icon .ui-icon-closethick{display:none;}
</style>
<script src="webfront/view/javascript/sss/sss.min.js"></script>
<link rel="stylesheet" href="webfront/view/javascript/sss/sss.css" type="text/css" media="all">
<script>
jQuery(function($) {
$('.slider').sss();
});
</script> 
<script type="text/javascript">

var map;        
var myCenter=new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $longt; ?>);
var marker=new google.maps.Marker({
    position:myCenter
});
var infowindow = new google.maps.InfoWindow({
                                content: contentString
                            });

 var contentString = '<div id="content">'+
                                                  '<div id="siteNotice">'+
                                                  '</div>'+
                                                  '<h1 id="firstHeading" class="firstHeading"><?php echo $maptitle;?></h1>'+
                                                  '<div id="bodyContent">'+
                                                  '<p><?php echo $address; ?>'+
                                                  '</p>'+
                                                   '</div>'+
                                                    '</div>';

function initialize() {
          var mapProp = {
                            center:myCenter,
                            zoom: 17,
                            draggable: false,
                            scrollwheel: false,
                            mapTypeId:google.maps.MapTypeId.ROADMAP
                        };

 
  
                          map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
                          marker.setMap(map);
    
                          google.maps.event.addListener(marker, 'click', function() {
      
                                          infowindow.setContent(contentString);
                                            infowindow.open(map, marker);
    
                          }); 
}
google.maps.event.addDomListener(window, 'load', initialize);

google.maps.event.addDomListener(window, "resize", resizingMap());

$('#myMapModal').on('show.bs.modal', function() {
   //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
   resizeMap();
})

function resizeMap() {
   if(typeof map =="undefined") return;
   setTimeout( function(){resizingMap();} , 400);
}

function resizingMap() {
   if(typeof map =="undefined") return;
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
}
</script> 
<script type="text/javascript"><!--


   //This function for select disocunt
function selectDiscountToday(ocurance){ //alert(ocurance);
  $("#disocuntSlots").removeClass('discStar')  
  $("#disocuntSlots").find('a').removeClass("discStar");
  $('#slottoday'+ocurance).addClass('discStar');
  $("input[name=\'bookingDiscount\']").val($("#todaydiscP"+ocurance).html());
  $("input[name=\'bookingDisocuntId\']").val(ocurance);
  $("input[name=\'bookingDiscountTime\']").val($("#todaydiscT"+ocurance).html());
}

$('#bookingdate').change(function(event){ 

  var selectdate = $(this).val();
  var fullDate = new Date()
  
  //alert(selectdate);
  //console.log(fullDate);

    $.ajax({
    url: 'index.php?route=product/merchantdetail/getDisocunt&merchant_id=<?php echo $merchant_id?>',
    type: 'post',
   // data: $('input[name=\'frmUserEmail\'],input[name=\'frmUserPassword\'],input[name=\'frmUserRedirect\'], select, input[name=\'frmUserEmail\']'),
  data: $('input[name=\'frmUserEmail\'],input[name=\'frmUserPassword\'],input[name=\'frmUserRedirect\'],select, input[name=\'frmUserEmail\'], input[name=\'bookingDuration\'],input[name=\'bookingPrice\'], select'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
      //$('#detail').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
      $('#disocuntSlots').html('');
      $('#disocuntSlots').html('<img src="webfront/view/theme/default/image/riwigoloader.gif">');     
    },
    complete: function() {       
      //jQuery("#preloader").delay(500).fadeOut("slow");
    },
    success: function(json) {
      $('.alert, .text-danger').remove();

      if (json['success']) { //alert('success');
        $('#disocuntSlots').html('');
        $('#disocuntSlots').html(json['discountdata']);
    
    
        //$('#disocuntSlots').html('<img src="webfront/view/theme/default/image/riwigoloader.gif">'); 
      }     
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
    });


});

$('#bookingPerson').change(function(event){ 
  
    var selectdate = $(this).val();
    var fullDate = new Date();

  

    

     
  
   
    
    //alert(selectdate);
    //console.log(fullDate);
  
      $.ajax({
      url: 'index.php?route=product/merchantdetail/getDisocunt&merchant_id=<?php echo $merchant_id?>',
      type: 'post',
      data: $('input[name=\'frmUserEmail\'],input[name=\'frmUserPassword\'],input[name=\'frmUserRedirect\'],input[name=\'bookingDuration\'],input[name=\'bookingPrice\'], select'),
      dataType: 'json',
      crossDomain: true,
      beforeSend: function() {
        $('#disocuntSlots').html('');
        $('#disocuntSlots').html('<img src="webfront/view/theme/default/image/riwigoloader.gif">');   
      },
      complete: function() {
        //$('#button-login').button('reset');
        // will first fade out the loading animation
        //.jQuery("#status").fadeOut();
        // will fade out the whole DIV that covers the website.
        //jQuery("#preloader").delay(500).fadeOut("slow");
      },
      success: function(json) {
        $('.alert, .text-danger').remove();

        if (json['success']) {
          //alert(json['price']);
          $('#disocuntSlots').html('');
          $('#disocuntSlots').html(json['discountdata']);
          
          $('#bookingVlaue').val(json['price']); 
   
      
        }     
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        
      }
      });
  
  
});

$('#recService').change(function(){ 
    var value = $(this).val();
  $.ajax({
    url: 'index.php?route=product/merchantdetail/disc',
    type: 'post',
    data: $('.comman_table select, input[name=\'merchant_id\']'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
          $('#detail').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
    },
    complete: function() {
            jQuery("#preloader").delay(1000).fadeOut("slow");
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      //alert(json);
      $("#discountRow" ).html('');
      $("#discountRow" ).html(json);
                          
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$(function(){
         $('.timeslots').hide();
        $('#bookingdate').change(function(event){

            var selectdate = $(this).val();
            var fullDate = new Date()
            //console.log(fullDate);
 
            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);

            var twoDigitDate = ((fullDate.getDate().length+1) === 1)? (fullDate.getDate()) : '0' + (fullDate.getDate());

         
 
            var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;
            console.log(currentDate);
            console.log(selectdate);
            //alert(currentDate);
             if(selectdate==currentDate){
                $('.newtimeslots').show();
                 $('.timeslots').hide();
                 //alert('match');
                 event.preventDefault();
             }
             if(selectdate!=currentDate){
                 $('.timeslots').show();
                  $('.newtimeslots').hide();
                  //alert('notmatch');
            }

        });
    });

$('#button-login').on('click', function() { 

  $.ajax({
    url: 'index.php?route=account/login/validatePopup',
    type: 'post',
    data: $('input[name=\'frmUserEmail\'],input[name=\'frmUserPassword\'],input[name=\'frmUserRedirect\']'),
    dataType: 'json',
    crossDomain: true,
    beforeSend: function() {
                    $('#detail').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
                    
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
             var url = url.replace(/&amp;/g, "&");
                        //$(location).attr('href',url);
            $("input[name=\'customerName\']").val(json['customerName']);
            $("input[name=\'email\']").val(json['customerEmail']);
            $("input[name=\'mobile\']").val(json['customerMobile']);
            $('.js-modal-close').trigger('click');
            
                    }     
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});


$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

  $('a[data-modal-id]').click(function(e) {
    e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
    var modalBox = $(this).attr('data-modal-id');
    $('#'+modalBox).fadeIn($(this).data());
  });  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
  $(".modal-box, .modal-overlay").fadeOut(500, function() {
    $(".modal-overlay").remove();
  });
});
 
$(window).resize(function() {
  $(".modal-box").css({
    top: ($(window).height() - $(".modal-box").outerHeight()) / 4,
    left: ($(window).width() - $(".modal-box").outerWidth()) / 4
  });
});
 
$(window).resize();
 
});


 


function selectService(bookingServices,bookingDuration, bookingVlaue, bookingProductId,bookedRow ){  //alert(bookingProductId);
  $("input[name=\'bookingVlaue\']").val(bookingVlaue);
  $("input[name=\'bookingProductId\']").val(bookingProductId);
  $("input[name=\'bookingServices\']").val(bookingServices);
  $("input[name=\'bookingDuration\']").val(bookingDuration + ' Min');
  $(".table-hover tbody tr").removeClass('bookedService');

  $("#bookedRow"+bookedRow).addClass('bookedService'); 
  $.session.set('product_id', bookingProductId);

}


$('#clsoeBtn').on('click', function(){ $("#widget-tfl").css('display','none')});

//data: $('#orderform input[type=\'text\'], #orderform input[type=\'date\'], #orderform input[type=\'datetime-local\'], #orderform input[type=\'time\'], #orderform inputtype=\'password\'], #orderform input[type=\'checkbox\']:checked, #orderforminput[type=\'radio\']:checked, #orderformtextarea, #orderformselect'),

$('#reviewReservation').on('click', function() { //alert('hi');
  $.ajax({
    url: 'index.php?route=product/merchantdetail/order',
    type: 'post',
        data: $('#orderform input[type=\'text\'], #orderform input[type=\'hidden\'], #orderform select'),
        dataType: 'json',
    beforeSend: function() {
      //$('#button-coupon').button('loading');
      $('#detail').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');  
    },
    complete: function() {
      //$('#button-coupon').button('reset');
      jQuery("#preloader").delay(1000).fadeOut("slow");
      
    },
    success: function(json) {
      $('.alert').remove();
      
      if(json['bookingPerson']){
        
        $("#widget-tfl").css('display','block')
        
        $("#errText").html(json['bookingPerson']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');  
        
      }else if(json['bookingServices']){
        
        $("#widget-tfl").css('display','block')
        
        $("#errText").html(json['bookingServices']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');  
        
      }else if(json['bookingDiscount']){
        
        $("#widget-tfl").css('display','block')
        
        $("#errText").html(json['bookingDiscount']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');  
        
      }else if(json['email']){
        $('html, body').animate({ scrollTop: 0 }, 'slow');  
        //$('.loginpopup').trigger('click');
       
     //$('#quickloginModal').modal('show');
      
    //$('#quickloginModal').modal('show');
    
    $('#quickloginModal').modal('show');
      
    
    setTimeout(function() {   //calls click event after a certain time
       $('.click').trigger('click');
    }, 100);
    
    //alert('hi');
    
      }else if(json['mobile']){
        
        $("#widget-tfl").css('display','block')
        
        $("#errText").html(json['mobile']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');  
        
      }else if (json['error']) {
        //$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); 
        //$("#widget-tfl").css('display','block')

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }

      if (json['redirect']) {
        location = json['redirect'];
      }
    }
  });
});
//--></script> 
<script>
$(document).ready(function () {
  if($(".tab ul li a")){
  $(".tab ul li a").click(function(e) {
    $(".tab ul li a").removeClass("active");
        $(this).addClass("active");
    });
  }
  
  $(".tab ul li a.tab2a").click(function(e) {
    $(".tab1").show();
    $(".tab2,.tab3,.tab4").hide();
    });
  
  $(".tab2").hide();
  $(".tab ul li a.tab2b").click(function(e) {
    $(".tab2").show();
    $(".tab1,.tab3,.tab4").hide();
    });
  
  $(".tab3").hide();
  $(".tab ul li a.tab2c").click(function(e) {
    $(".tab3").show();
    $(".tab2,.tab1,.tab4").hide();
    });
  
  $(".tab4").hide();
  $(".tab ul li a.tab2d").click(function(e) {
    $(".tab4").show();
    $(".tab2,.tab3,.tab1").hide();
    });
  
  $('#main-nav  ul.drop').dropotron({ offsetY: -10 });
});
</script> 

<!-- <script>
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script> -->

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials-theme-flat.css" />

 
    <script src="<?php echo HTTP_IMAGE; ?>socialshare/dist/jssocials.js"></script>
    <script>
    $(function() {

        var url = "<?php echo HTTP_SERVER; ?>index.php?route=product/merchantdetail&merchant_id=<?php echo $merchant_id; ?>";
        var text = "Riwigo";

     

        $("#shareIcons").jsSocials({
            url: url,
            text: text,
            showLabel: false,
            showCount: false,
            shares: ["facebook", "twitter", "linkedin"]
        });

     

        $("#shareStandard").jsSocials({
            showLabel: false,
            showCount: false,

            shares: [{
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.text = "(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.3\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));";
                    $result.append(script);

                    $("<div>").addClass("fb-share-button")
                        .attr({
                            "data-href": "https://developers.facebook.com/docs/plugins/",
                            "data-layout": "button_count"
                        })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "https://apis.google.com/js/platform.js";
                    $result.append(script);

                    $("<div>").addClass("g-plus")
                        .attr({
                            "data-action": "share",
                            "data-annotation": "bubble"
                        })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "//platform.linkedin.com/in.js";
                    $result.append(script);

                    $("<script>").attr({ type: "IN/Share", "data-counter": "right" })
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.src = "//assets.pinterest.com/js/pinit.js";
                    $result.append(script);

                    $("<img>").attr("src", "//assets.pinterest.com/images/pidgets/pin_it_button.png")
                        .append($("<a>").attr({
                            "href": "https://www.pinterest.com/pin/create/button/",
                            "data-pin-do": "buttonPin"
                        }))
                        .appendTo($result);

                    return $result;
                }
            }, {
                renderer: function() {
                    var $result = $("<div>");

                    var script = document.createElement("script");
                    script.text = "window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src=\"https://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,\"script\",\"twitter-wjs\"));";
                    $result.append(script);

                    $("<a>").addClass("twitter-share-button")
                        .text("Tweet")
                        .attr("href", "https://twitter.com/share")
                        .appendTo($result);

                    return $result;
                }
            }]
        });


        var currentTheme = "flat";

        var switchTheme = function() {
            var newTheme = $("#themeSelector").val();
            var $cssLink = $("link[href$='" + currentTheme + ".css']");
            var cssPath = $cssLink.attr("href");
            $cssLink.attr("href", cssPath.replace(currentTheme, newTheme));
            currentTheme = newTheme;
        };

        var switchFontSize = function() {
            var fontSize = parseInt($("#fontSizeSelector").val(), 10);
            $("body").css("fontSize", fontSize);
        };

        $("#themeSelector").on("change", switchTheme);
        $("#fontSizeSelector").on("change", switchFontSize);

    });
</script>