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
                          <input type="text" placeholder="select date" id="datetimepicker1" name="locationDate"/>
                        </li>
                        <li> <i class="fa fa-clock-o" aria-hidden="true"></i>
                          <select name="locationTimeslot" id="loc_curr_date" class="form-control selectpicker">
                            <option><span>Time</span></option>
                            <?php foreach ($text_time_slot as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li> <i class="fa fa-user" aria-hidden="true"></i>
                          <select name="locationPeoples" id="peoples" class="form-control selectpicker" >
                            <option><span>People</span></option>
                            <?php foreach ($text_peoples as $key => $text_people) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_people;?></option>
                            <?php }?>
                          </select>
                        </li>
                        <li class="selectacategory"> <i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i>
                          <select name="locationCategory" id='locationCategory' class="form-control selectpicker">
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
                          <select name="locationPlace" id="locationPlace"   class="form-control selectpicker">
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
                        <li>  <i class="fa fa-clock-o" aria-hidden="true"></i>
                             <select name="merchantTimeslot" id="loc_curr_date" class="form-control selectpicker">
                            <option><span>Time</span></option>
                            <?php foreach ($text_time_slot as $key => $text_time_slo) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_time_slo;?></option>
                            <?php }?>
                          </select>
                           
                           </li>
                        <li>  
                        <i class="fa fa-user" aria-hidden="true"></i>
                          <select name="merchantPeoples" id="peoples" class="form-control selectpicker" >
                            <option><span>People</span></option>
                            <?php foreach ($text_peoples as $key => $text_people) { ?>
                            <option value="<?php echo $key;?>"><?php echo $text_people;?></option>
                            <?php }?>
                          </select>
                            </li>
                        <li class="selectacategory"> 
                        <i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i> 
                          <select name="anymerchant" id="anymerchant"   class="form-control selectpicker">
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
		
			var locationDate = $('#firstTab input[name=\'locationDate\']').prop('value');
		
			if (locationDate) {
				url += '&filter_locationDate=' + encodeURIComponent(locationDate);
			}
			
			var locationTimeslot = $('#firstTab select[name=\'locationTimeslot\']').val();
		
			if (locationTimeslot) {
				url += '&filter_locationTimeslot=' + encodeURIComponent(locationTimeslot);
			}
			
		
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
			
			anymerchant = 1;
			
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
		
		
		
		$('#content input[name=\'search\']').bind('keydown', function(e) {
			if (e.keyCode == 13) {
				$('#button-search').trigger('click');
			}
		});
	</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#locationCategory').gentleSelect({ 
            columns: 3,
			maxDisplay: 1,
            itemWidth: 200,
            title: "Select a category",
	    	hideOnMouseOut: true
        });
		
		$('#locationPlace').gentleSelect({ 
            columns: 3,
			maxDisplay: 1,
            itemWidth: 200,
            title: "select a location",
	    	hideOnMouseOut: true
        });
		
		$('#anymerchant').gentleSelect({ 
            columns: 3,
			maxDisplay: 1,
            itemWidth: 200,
            title: "select a merchant",
	    	hideOnMouseOut: true
        });
		 
    });


    
    </script> 