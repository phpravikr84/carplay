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
        <li class="active" data-url="#" data-usepost="False"><a href="<?=$order_history?>"><span class="menutext">Booking History</span></a></li>
        <li data-url="#" data-usepost="False"><a href="<?=$profile?>"><span class="menutext">Profile</span></a></li>
        <li data-url="#" data-usepost="False"><a href="<?=$password?>"><span class="menutext">Change password</span></a></li>
        <li data-url="#" data-usepost="True"><a href="<?=$signout?>"><span class="menutext">Sign out</span></a></li>
      </ul>
    </div>
    
    <div class="col-md-8">
      <div class="row">
        <h2>Bookings</h2>
        <div class="col-md-12">
        <?php if (isset($cancelOrderMessage) && $cancelOrderMessage !='') { ?>
          <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $cancelOrderMessage;  ?></div>      
          <?php } ?>
          <ul class="nav nav-tabs">
            <li class="active"><a href="<?=$order_history?>#home">Total Booking</a></li>
            <li><a href="<?=$order_history?>#menu1">Upcoming</a></li>
            <li><a href="<?=$order_history?>#menu2">Cancelled</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <div class="frst1">
                <?php $book = 0; foreach ($orders as $order) { ?>
                
                <div class="orderlist1">
                    <div class="hotel_booking">
                      <div class="pic_hotel"> <img src="<?=$order['thumb']?>" class="static" alt="" height="100" width="120"> </div>
                      <div class="detail_hotel_booking">
                        <p class="content_blue"> <b> <a class="hotelLinks" href="index.php?route=product/merchantdetail&merchant_id=<?php echo $order['merchant_id']; ?>" title="Pinnacle Grand Jomtien Resort">
                          <?=$order['merchant_name']?>
                          </a> </b> </p>
                        <p class="address_hotel">
                          <?=$order['address']?>
                        </p>
                      </div>
                      <div class="date_hotel_booking">
                        <p> <span class="date_hotel_on">Booked on</span> <span class="date_hotel"><?php echo $order['date_added']; ?></span> </p>
                      </div>
                    </div>
                  <!--end hotel_booking--> 
                    <div class="allbox">
                      <div class="allbox_left">
                        <p class="booking_left"> Booking ID </p>
                        <p class="booking_right"> <?php echo $order['order_id']; ?> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Date: </p>
                        <p class="booking_right"> <span><?php echo $order['booking_date']; ?> </span> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Time: </p>
                        <p class="booking_right"> <span> <?=$order['bookingDiscountTime']?></span> </p>
                        <p class="booking_left"> Discount: </p>
                        <p class="booking_right"> <span> <?=$order['disocunt']?></span> </p>
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <p class="booking_left"> Service: </p>
                        <p class="booking_right">
                          <?=$order['service_name']?>
                        </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Duration </p>
                        <p class="booking_right">
                          <?=$order['duration']?>
                        </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Persons </p>
                        <p class="booking_right">
                          <?=$order['persons']?>
                        </p>
                        <div class="clear"></div>
                      </div>
                      <div class="allbox_right">
                        
                        <p><span class="money_hotel"><strike><?php echo $order['total']; ?></strike></span></p>
                        <p><span class="money_hotel"><?php echo $order['net_amount']; ?></span></p>
                        <p><span class="money_hotel">Your Saving</span></p>
                        <p><span><?php echo $order['disc_amount']; ?></span></p>
                        <div>
                          <p class="text_conditions"> <a href="index.php?route=information/information&information_id=12" title="This booking is Non-Refundable and cannot be amended or modified. Failure to arrive at your hotel will be treated as a No-Show and no refund will be given (Hotel policy).">Booking Conditions</a> </p>
                        </div>
                        <div class="manage_booking">
                          <div> <a href="<?php echo $order['view']; ?>" target="blank">view booking</a> <span class="sprite_arrow pic_arrow1" style="*margin-bottom: 2px !important;"></span> </div>
                          <?php if($order['status'] != 'Canceled'){?>
                             
                            
                            <button type="button" class="btn btn-info btn-lg sprite_arrow pic_arrow1"   onClick="cancelButton('<?php echo $order['order_id']; ?>')" data-toggle="modal" data-target="#myModal">cancel booking</button>
                            
                          <?php  } ?>
                        </div>
                      </div>
                    </div>
                  <!--end allbox-->
                    </div><!--end orderlist1-->
                    
                <?php $book++; }?>
                <?php if($book == 0){?>
                <h2 style="margin-top:10px;"> No Bookings</h2>
                <?php }?>
              </div>
              <!--end frst1 status--> 
     
     
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Riwigo</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure want to cancel booking!</p>
                    <input type="hidden" name="orderid" id="orderid" value="" >
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="cancelBooking" class="btn btn-default" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  </div>
                </div>
            
              </div>
            </div>
                 
              
            </div>
            <!--end #home status-->
            <div id="menu1" class="tab-pane fade">
              <?php $upcommingbook =0; foreach ($orders as $order) { ?>
              <?php if($order['book_date'] >= date('Y-m-d') and $order['status'] != 'Canceled'){?>
              
              <div class="orderlist1">
              <div class="hotel_booking">
                <div class="pic_hotel"> <img src="<?=$order['thumb']?>" class="static" alt="" height="100" width="120"> </div>
                <div class="detail_hotel_booking">
                  <p class="content_blue"> <b> <a class="hotelLinks" href="index.php?route=product/merchantdetail&merchant_id=<?php echo $order['merchant_id']; ?>" title="Pinnacle Grand Jomtien Resort">
                    <?=$order['merchant_name']?>
                    </a> </b> </p>
                  <p class="address_hotel">
                    <?=$order['address']?>
                  </p>
                </div>
                <div class="date_hotel_booking">
                  <p> <span class="date_hotel_on">Booked on</span> <span class="date_hotel"><?php echo $order['date_added']; ?></span> </p>
                </div>
              </div>
              <!--end hotel_booking-->
              
              <div class="allbox">
                      <div class="allbox_left">
                        <p class="booking_left"> Booking ID </p>
                        <p class="booking_right"> <?php echo $order['order_id']; ?> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Date: </p>
                        <p class="booking_right"> <span><?php echo $order['booking_date']; ?> </span> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Time: </p>
                        <p class="booking_right"> <span> <?=$order['bookingDiscountTime']?></span> </p>
                        <p class="booking_left"> Discount: </p>
                        <p class="booking_right"> <span> <?=$order['disocunt']?></span> </p>
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <p class="booking_left"> Service: </p>
                        <p class="booking_right">
                          <?=$order['service_name']?>
                        </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Duration </p>
                        <p class="booking_right">
                          <?=$order['duration']?>
                        </p>
                        <div class="clear"></div>
                      </div>
                      <div class="allbox_right">
                        
                         <p><span class="money_hotel"><strike><?php echo $order['total']; ?></strike></span></p>
                        <p><span class="money_hotel"><?php echo $order['net_amount']; ?></span></p>
                        <p><span class="money_hotel">Your Saving</span></p>
                        <p><span><?php echo $order['disc_amount']; ?></span></p>
                        <div>
                          <p class="text_conditions"> <a href="index.php?route=information/information&information_id=12" title="This booking is Non-Refundable and cannot be amended or modified. Failure to arrive at your hotel will be treated as a No-Show and no refund will be given (Hotel policy).">Booking Conditions</a> </p>
                        </div>
                        <div class="manage_booking">
                          <div> <a href="<?php echo $order['view']; ?>" target="blank">view booking</a> <span class="sprite_arrow pic_arrow1" style="*margin-bottom: 2px !important;"></span> </div>
                          <?php if($order['status'] != 'Canceled'){?>
                             
                            
                            <button type="button" class="btn btn-info btn-lg sprite_arrow pic_arrow1"   onClick="cancelButton('<?php echo $order['order_id']; ?>')" data-toggle="modal" data-target="#myModal">cancel booking</button>
                            
                          <?php  } ?>
                        </div>
                      </div>
                    </div>
              <!--end allbox-->
              </div>
              <?php  $upcommingbook++;}?>
              <?php }?>
              <?php if($upcommingbook == 0){?>
                <h2 style="margin-top:10px;"> No Bookings</h2>
                <?php }?>
            </div>
            <div id="menu2" class="tab-pane fade">
              <?php $canceledbook=0; foreach ($orders as $order) { ?>
                <?php if($order['status'] == 'Canceled'){?>
                <div class="orderlist1">
                    <div class="hotel_booking">
                      <div class="pic_hotel"> <img src="<?=$order['thumb']?>" class="static" alt="" height="100" width="120"> </div>
                      <div class="detail_hotel_booking">
                        <p class="content_blue"> <b> <a class="hotelLinks" href="index.php?route=product/merchantdetail&merchant_id=<?php echo $order['merchant_id']; ?>" title="Pinnacle Grand Jomtien Resort">
                          <?=$order['merchant_name']?>
                          </a> </b> </p>
                        <p class="address_hotel">
                          <?=$order['address']?>
                        </p>
                      </div>
                      <div class="date_hotel_booking">
                        <p> <span class="date_hotel_on">Booked on</span> <span class="date_hotel"><?php echo $order['date_added']; ?></span> </p>
                      </div>
                    </div>
                  <!--end hotel_booking--> 
                    <div class="allbox">
                      <div class="allbox_left">
                        <p class="booking_left"> Booking ID </p>
                        <p class="booking_right"> <?php echo $order['order_id']; ?> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Date: </p>
                        <p class="booking_right"> <span><?php echo $order['booking_date']; ?> </span> </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Booking Time: </p>
                        <p class="booking_right"> <span> <?=$order['bookingDiscountTime']?></span> </p>
                        <p class="booking_left"> Discount: </p>
                        <p class="booking_right"> <span> <?=$order['disocunt']?></span> </p>
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <p class="booking_left"> Service: </p>
                        <p class="booking_right">
                          <?=$order['service_name']?>
                        </p>
                        <div class="clear"></div>
                        <p class="booking_left"> Duration </p>
                        <p class="booking_right">
                          <?=$order['duration']?>
                        </p>
                        <div class="clear"></div>
                      </div>
                      <div class="allbox_right">
                        
                        <p><span class="money_hotel"><strike><?php echo $order['total']; ?></strike></span></p>
                        <p><span class="money_hotel"><?php echo $order['net_amount']; ?></span></p>
                        <p><span class="money_hotel">Your Saving</span></p>
                        <p><span><?php echo $order['disc_amount']; ?></span></p>
                        <div>
                          <p class="text_conditions"> <a href="index.php?route=information/information&information_id=12" title="This booking is Non-Refundable and cannot be amended or modified. Failure to arrive at your hotel will be treated as a No-Show and no refund will be given (Hotel policy).">Booking Conditions</a> </p>
                        </div>
                        <div class="manage_booking">
                          <div> <a href="<?php echo $order['view']; ?>" target="blank">view booking</a> <span class="sprite_arrow pic_arrow1" style="*margin-bottom: 2px !important;"></span> </div>
                          <?php if($order['status'] != 'Canceled'){?>
                             
                            
                            <button type="button" class="btn btn-info btn-lg sprite_arrow pic_arrow1"   onClick="cancelButton('<?php echo $order['order_id']; ?>')" data-toggle="modal" data-target="#myModal">cancel booking</button>
                            
                          <?php  } ?>
                        </div>
                      </div>
                    </div>
                  <!--end allbox-->
                    </div>
                <?php $canceledbook++;}?>
                <?php }?>
                <?php if($canceledbook == 0){?>
                <h2 style="margin-top:10px;"> No Bookings</h2>
                <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end col-md-8--> 
  </div
  ><!--end row--> 
</div>
<!--end container--> 
<script>

function cancelButton(orderID){$("#orderid").val(orderID);}
  
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
  
  $("#cancelBooking").click(function(){
    var url = "index.php?route=account/order/cancel&order_id="+$("#orderid").val();
      $(location).attr('href',url);      
    });
});
</script> 
<?php echo $footer; ?>