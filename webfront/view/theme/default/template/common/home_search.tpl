<section id="slider">
  <div class="flex-container mar_top45">
    <div class="flexslider">
      <ul class="slides">
        <?php foreach($banners as $banner) { ?>
        <li><img src="<?php echo $banner['image']; ?>" alt="" title="<?php echo $banner['title']; ?>" /></li>
        <!-- <li><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="" /></li> -->
        <?php } ?>
      </ul>
    </div>
    <div class="overlay_bg">
      <div class="container top25">
        <div class="row">
          <div class="col-md-12"> <img src="image/slider_top_img.png" class="top_img" alt="" title="">
            <div class="home_search">
              <div class="btn_search">
                <div class="btn_first"><a href="javascript:(void);" class="active" title="by location"><?php echo $text_bylocation;?></a></div>
                <div class="btn_last"><a href="javascript:(void);" title="by spa shop"><?php echo $text_byshop;?></a></div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="search_area">
                    <div class="search_first taba" id="firstTab">
                      <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                          <input type="text" placeholder="select date" id="datetimepicker1" name="locationDate" value="" />
                        </li>
                        <li id="loc_curr_datelist"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                          <select name="locationTimeslot" id="loc_curr_date" class="selectpicker">
                            <option><span>Time</span></option>
                            <?php 

                                             
                                            date_default_timezone_set("Asia/Bangkok");
                                            $cur_hours_bk = date("H");
                                            $cur_minutes_bk = date("i");

                                                if($cur_minutes_bk == 00)
                                                {
                                                $bkminutes =$cur_minutes_bk;
                                                $bktime = $cur_hours_bk.":".$bkminutes;
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk == 30)
                                                {
                                                $bkminutes = $cur_minutes_bk;
                                                $bktime = $cur_hours_bk.":".$bkminutes;
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk < 30)
                                                {
                                                $bkhours = $cur_hours_bk+1;
                                                $bktime = $bkhours.":00";
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk > 30 && $cur_minutes_bk < 60)
                                                {
                                                $bkhours = $cur_hours_bk+1;
                                                $bktime = $bkhours.":30";
                                                //echo $bktime;
                                                }

                                                 $text_time_slot;          
                                                $output_array = array();   
                                                foreach ($text_time_slot as $k => $v){
                                                array_push($output_array, $v);
                                                }

                                                
                                               

                                                $btime = array_keys($output_array, $bktime);
                                                //echo $btime[0]

                                                //$bkey = array_search($btime, $bktime); 

                                                $timeslots = array_slice($output_array, $btime[0]);


                            foreach ($timeslots as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo; ?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li id="loc_next_datelist"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                          <select name="locationTimeslot" id="loc_next_date" class="selectpicker">
                            <option><span>Time</span></option>
                            <?php foreach ($text_time_slot as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li> <i class="fa fa-user" aria-hidden="true"></i>
                          <select name="locationPeoples" id="peoples" class="selectpicker" >
                            <option><span>People</span></option>
                            <?php foreach ($text_peoples as $key => $text_people) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_people;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li class="selectacategory"> <i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i>
                          <select name="locationCategory" id='locationCategory' class="selectpicker">
                            <option><span>Select a Category</span></option>
                            <?php foreach ($categories as $category) { ?>
                            <option value="<?=$category['category_id']?>">
                            <?=$category['name']?>
                            </option>
                            <?php foreach ($category['children'] as $cat) { ?>
                            <option value="<?=$cat['category_id']?>">
                            <?=$cat['name']?>
                            </option>
                            <?php }?>
                            <?php }?>
                          </select>
                        </li>
                        <li class="selectacategory"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                          <select name="locationPlace" id="locationPlace"   class="selectpicker">
                            <option><span>Select a Location</span></option>
                            <?php if(count($locations) >0){?>
                            <?php foreach ($locations as $lcoation) { ?>
                            <option value="<?=$lcoation['location_id']?>">
                            <?=$lcoation['name']?>
                            </option>
                            <?php }?>
                            <?php }else{?>
                            <option value="0">No Locations</option>
                            <?php }?>
                          </select>
                        </li>
                        <li>
                          <input type="submit" value="Search" id="byLocation">
                        </li>
                      </ul>
                    </div>
                    <div class="search_first tabb" id="secondTab">
                      <ul>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                          <input type="text" name="merchantDate" id="datetimepicker2" placeholder="select a date"/>
                        </li>
                        <li id="merchant_current_datelist"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                          <select name="merchantTimeslot" id="loc_curr_date" class="selectpicker">
                            <option><span>Time</span></option>
                            <?php 

                                          date_default_timezone_set("Asia/Bangkok");
                                            $cur_hours_bk = date("H");
                                            $cur_minutes_bk = date("i");

                                                if($cur_minutes_bk == 00)
                                                {
                                                $bkminutes =$cur_minutes_bk;
                                                $bktime = $cur_hours_bk.":".$bkminutes;
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk == 30)
                                                {
                                                $bkminutes = $cur_minutes_bk;
                                                $bktime = $cur_hours_bk.":".$bkminutes;
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk < 30)
                                                {
                                                $bkhours = $cur_hours_bk+1;
                                                $bktime = $bkhours.":00";
                                                //echo $bktime;
                                                }

                                                if($cur_minutes_bk > 30 && $cur_minutes_bk < 60)
                                                {
                                                $bkhours = $cur_hours_bk+1;
                                                $bktime = $bkhours.":30";
                                                //echo $bktime;
                                                }

                                                 $text_time_slot;          
                                                $output_array = array();   
                                                foreach ($text_time_slot as $k => $v){
                                                array_push($output_array, $v);
                                                }

                                                

                                                 $btime = array_keys($output_array, $bktime);
                                                //echo $btime[0]

                                                //$bkey = array_search($btime, $bktime); 

                                                $timeslots = array_slice($output_array, $btime[0]);

                            foreach ($timeslots as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li id="merchant_next_datelist"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                          <select name="merchantTimeslot" id="loc_curr_date" class="selectpicker">
                            <option><span>Time</span></option>
                            <?php foreach ($text_time_slot as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li> <i class="fa fa-user" aria-hidden="true"></i>
                          <select name="merchantPeoples" id="peoples" class="selectpicker" >
                            <option><span>People</span></option>
                            <?php foreach ($text_peoples as $key => $text_people) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_people;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li class="selectacategory"> <i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i>
                          <select name="anymerchant" id="anymerchant"   class="selectpicker">
                            <option><span>Select A Merchant</span></option>
                            <?php foreach ($merchants as $merchant) { ?>
                            <option value="<?=$merchant['merchant_id']?>">
                            <?=$merchant['name']?>
                            </option>
                            <?php }?>
                          </select>
                        </li>
                        <li>
                          <input type="submit" value="search" id="byMerchant">
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bottom_icons">
              <div class="row">
                <div class="col-md-4"><a href="javascript:(void);"><img src="image/search1.png" alt="" title=""></a></div>
                <div class="col-md-4"><a href="javascript:(void);"><img src="image/search2.png" alt="" title=""></a></div>
                <div class="col-md-4"><a href="javascript:(void);"><img src="image/search3.png" alt="" title=""></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript"><!--
    $('#byLocation').bind('click', function() {
      
      url = 'index.php?route=product/category';
      
      var locationCategory =  $('#firstTab select[name=\'locationCategory\']').val();
    
      if (locationCategory) {
        url += '&path=' + encodeURIComponent(locationCategory);
      }
    
      // var locationDate = $('#firstTab input[name=\'locationDate\']').prop('value');
    
      // if (locationDate) {
      //   url += '&filter_locationDate=' + encodeURIComponent(locationDate);
      // }
      
      // var locationTimeslot = $('#firstTab select[name=\'locationTimeslot\']').val();
    
      // if (locationTimeslot) {
      //   url += '&filter_locationTimeslot=' + encodeURIComponent(locationTimeslot);
      // }
      
    
      var peoples =  $('#firstTab select[name=\'locationPeoples\']').val();
    
      if (peoples) {
        url += '&filter_peoples=' + encodeURIComponent(peoples);
      }
      
      var locationPlace =  $('#firstTab select[name=\'locationPlace\']').val();
    
      if (locationPlace) {
        url += '&filter_location_id=' + encodeURIComponent(locationPlace);
      } 
     
      location = url;
    });
    
    $('#byMerchant').bind('click', function() {
      url = 'index.php?route=product/merchantdetail';
      
      var redirect =true;
      
      //Location  Date
      var merchantDate = $('#secondTab input[name=\'merchantDate\']').prop('value');
    
      if (merchantDate) {
        url += '&filter_date=' + encodeURIComponent(merchantDate);
      }
      
      //Location Time Slot
      var locationTimeslot = $('#secondTab select[name=\'merchantTimeslot\']').val();
    
      if (locationTimeslot) {
        url += '&filter_time_slot=' + encodeURIComponent(locationTimeslot);
      }
      
      //Peoples
      var peoples =  $('#secondTab select[name=\'merchantPeoples\']').val();
    
      if (peoples) {
        url += '&filter_peoples=' + encodeURIComponent(peoples);
      }
      
      //Merchants
      var anymerchant =  $('#secondTab select[name=\'anymerchant\']').val(); 
      
      //anymerchant = 1;
      
      if (anymerchant != 'Select A Merchant') {
        url += '&merchant_id=' + encodeURIComponent(anymerchant);
      }else{ 
        alert('Selecat a Merchant')
        redirect =false;
      }
       
      if(redirect == true){
        location = url;
      }
      
    });
    
    $('#content input[name=\'search\']').bind('keydown', function(e) {
      if (e.keyCode == 13) {
        $('#button-search').trigger('click');
      }
    });
    
    
    
    $('#content input[name=\'search\']').bind('keydown', function(e){
      if (e.keyCode == 13) {
        $('#button-search').trigger('click');
      }
    });
  </script> 
<script type="text/javascript">
  $(document).ready(function(){
      
//By Location
      $('#loc_next_datelist').hide();
        $('#datetimepicker1').change(function(){

            var selectdate = $(this).val();
        
            var fullDate = new Date()
            console.log(fullDate.getDate());
 
            // var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '' + (fullDate.getMonth()+1);

            // var twoDigitDate = ((fullDate.getDate().length+1) === 1)? (fullDate.getDate()) : '' + (fullDate.getDate());


             var twoDigitMonth = ((fullDate.getMonth()+1) >= 10) ? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);

            var twoDigitDate = ((fullDate.getDate()) >= 10) ? (fullDate.getDate()) : '0' + (fullDate.getDate());

         
 
            var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
            console.log(currentDate);
            console.log(selectdate);
            //alert(currentDate);
             if(selectdate==currentDate){
                //$('#loc_curr_datelist').show();
                 $('#loc_next_datelist').hide();
                 //alert('match');
                 //event.preventDefault();
                 $('#loc_curr_datelist').css({ 'display': "list-item" });
                 console.log('match');
             }
             if(selectdate!=currentDate){
                 //$('#loc_next_datelist').show();
                  $('#loc_curr_datelist').hide();
                  $('#loc_next_datelist').css({ 'display': "list-item" });
                  //alert('notmatch');
                  console.log('notmatch');
            }

        });

  // By Merchant

  //By Location
      $('#merchant_next_datelist').hide();
        $('#datetimepicker2').change(function(){

            var selectdate = $(this).val();
        
            var fullDate = new Date()
            console.log(fullDate.getDate());
 
            // var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '' + (fullDate.getMonth()+1);

            // var twoDigitDate = ((fullDate.getDate().length+1) === 1)? (fullDate.getDate()) : '' + (fullDate.getDate());


             var twoDigitMonth = ((fullDate.getMonth()+1) >= 10) ? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);

            var twoDigitDate = ((fullDate.getDate()) >= 10) ? (fullDate.getDate()) : '0' + (fullDate.getDate());

         
 
            var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
            console.log(currentDate);
            console.log(selectdate);
            //alert(currentDate);
             if(selectdate==currentDate){
                //$('#merchant_current_datelist').show();
                 $('#merchant_next_datelist').hide();
                 //alert('match');
                 //event.preventDefault();
                 $('#merchant_current_datelist').css({ 'display': "list-item" });
                 console.log('match');
             }
             if(selectdate!=currentDate){
                 $('#merchant_current_datelist').hide();
                  //$('#merchant_next_datelist').show();
                   $('#merchant_next_datelist').css({ 'display': "list-item" });
                  //alert('notmatch');
                  console.log('notmatch');
            }

        });


    });
  </script> 
<script type="text/javascript">
    $(document).ready(function() { });


    
    </script> 