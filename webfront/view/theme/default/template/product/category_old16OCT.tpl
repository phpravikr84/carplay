<?php echo $header; ?>

<section id="slider" class="product">
  <div class="flex-container mar_top45">
    <div class="flexslider banner"> <img src="https://s3.amazonaws.com/riwigo-storage/images/img/2627b0cdd50affce407016d4138986c9_riwigo-inner-banner.jpg" class="lazy img-responsive"  alt="" title=""/> </div>
    <div class="overlay_bg">
      <div class="container top_pos25">
        <div class="row">
          <div class="col-md-12">
            <div class="Absolute-Center">
              <div class="title_banner_group">
                <select class="drowdown-group" id="drowdown-group-resto" name="drowdown-group-resto" >
                  <?php foreach($categories as $category){?>
                  <option value="<?=$category['category_id']?>" <?php if($category['category_id'] == $category_id){?>selected="selected"<?php } ?> >
                  <?=$category['name']?>
                  </option>
                  <?php foreach($category['children'] as $cate){?>
                  <option value="<?=$category['category_id']?>_<?=$cate['category_id']?>"<?php if($cate['category_id'] == $category_id){?>selected="selected"<?php } ?>  >
                  <?=$cate['name']?>
                  </option>
                  <?php }?>
                  <?php }?>
                </select>
              </div>
              <div class="detail_banner_group normal-font font-weight-normal">
                <?=$description?>
              </div>
              <div class="number_banner_group normal-font font-weight-normal">
                <?=$total_merchants?>
                Merchants </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="main_container">
  <div class="container">
    <div class="row">
      <h1> 
        <!-- <?=$heading_title?>--> 
      </h1>
    </div>
    <section id="search">
      <div class="row">
        <div class="col-md-12">
          <ul class="search">
            <li class="search"> <i class="fa fa-globe" aria-hidden="true"></i>
              <div class="container">
                <div class="active-cuisine2"></div>
                <select name="location" id="location"  class="form-control ">
                  <option value="">select location...</option>
                  <?php if(count($locations) > 0){?>
                  <?php foreach ($locations as $location) { ?>
                  <option value="<?php echo $location['location_id']; ?>" <?php if($filter_location_id==$location['location_id'] ){ ?> selected="selected" <?php } ?> ><?php echo $location['name']; ?></option>
                  <?php }?>
                  <?php }?>
                </select>
              </div>
            </li>
            <li class="search"> <i class="fa fa-usd" aria-hidden="true"></i>
              <div class="container ">
                <select name="pricelevel" id="pricelevel"  class="form-control ">
                  <option value="">price level...</option>
                  <option value="maxprice_level" <?php if($sort=='maxprice_level'){?>selected='selected' <?php } ?>>price, high to low</option>
                  <option value="minprice_level" <?php if($sort=='minprice_level'){?>selected='selected' <?php } ?>>price, low to high</option>
                </select>
              </div>
            </li>
            <li class="search"> <i class="fa fa-gift" aria-hidden="true"></i>
              <div class="container">
                <select name="facilities" id="facilities"  class="form-control ">
                  <option value="">select facilites...</option>
                  <?php foreach($facilities as $facilitie) { ?>
                  <option value="<?=$facilitie['facilities_id']?>" <?php if($filter_facilities==$facilitie['facilities_id'] ){ ?> selected="selected" <?php } ?> >
                  <?=$facilitie['name']?>
                  </option>
                  <?php }?>
                </select>
              </div>
            </li>
            <li class="search"> <i class="fa fa-star" aria-hidden="true"></i>
              <div class="container">
                <select name="sortBy" id="sortBy" class="form-control ">
                  <option value="m.rating">star rating</option>
                  <option value="md.name">stars(5...1)</option>
                  <option value="md.name">stars(1...5)</option>
                </select>
              </div>
            </li>
          </ul>
          <div class="full_head">
            <p><?php echo count($merchants);?> results found</p>
          </div>
        </div>
      </div>
    </section>
    <section id="spa">
      <div class="row column" >
        <?php if($merchants){ $k=1;?>
        <?php foreach ($merchants as $merchant) {  ?>
        <?php if(count($merchant['discounts'])>0){ ?>
        <div class="col-md-4">
          <div class="bot_col">
            <div class="box-detail-name"> <a href="<?=$merchant['href'];?>" title="Benihana @ Avani Atrium Bangkok">
              <h2 class="font-weight-bold"><?php echo $merchant['name'];?></h2>
              </a>
              <div class="left_colm">
                <p>
                  <?=$merchant['city']?>
                </p>
                <p>
                  <?=$merchant['location']?>
                </p>
              </div>
            </div>
            <div class="right_colm">
              <div class="box-detail-rating-gray">
                <div class="box-detail-rating-yellow_b" style="width:<?=$merchant['rating']?>%;"></div>
              </div>
              <div class="box-price-gray">
                <div class="box-detail-price-yellow_b" style="width:<?=$merchant['price_level']?>%;"></div>
              </div>
            </div>
            <div class="restro-title-box-left"> <a href="<?=$merchant['href'];?>" title="new 97 reservations recently"> <img src="<?php echo $merchant['thumb'];?>" alt="" title=""> <span class="bottom">
              <p class="category1">new
                <?=$merchant['reserved']?>
                reservations recently</p>
              </span> </a> </div>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <?php if($merchant['recomonded']){ $i=1;?>
                <thead>
                  <tr>
                    <th>services</th>
                    <th>duration</th>
                    <th>price</th>
                    <th></th>
                  </tr>
                </thead>
                <?php foreach ($merchant['recomonded'] as $recomonded) { ?>
                <tr>
                  <td><?php echo $recomonded['name'];?></td>
                  <td><?php echo $recomonded['duration'];?> min</td>
                  <td><?php echo ($recomonded['price']);?></td>
                  <td><a href="<?=$merchant['href'].'&product_id='.$recomonded['product_id'];?>">
                    <button type="button" class="btn btn-default">Select</button>
                    </a></td>
                </tr>
                <?php $i++; }?>
                <?php }?>
                  </tbody>
                
              </table>
              <a href="javascript:void(0)" data-toggle="modal" data-target="#myspaModal" title="<?php echo $merchant['merchant_id']; ?>" class="spamenu"> <strong>See all services</strong><i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i></a> </div>
            <div class="swiper-container" id="timeslot-2-0">
              <div class="swiper-wrapper">
                <?php if($merchant['discounts']){ $activeDisc = false; $i=1;?>
                 <div id="owl-demo<?php echo $k;?>" class="owl-carousel">
                  <?php foreach ($merchant['discounts'] as $discount){  ?>
                  <div class="item"><a href="<?=$merchant['href'];?>" title="offer" class="swiper-slide red-slide">
                    <p>
                      <?=$discount['start_time']?>
                    </p>
                    <b>
                    <?=$discount['discount']?>
                    %</b>
                    <p>off</p>
                    </a></div>
                  <?php }?>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
          <script>
        $("#owl-demo<?=$k?>").owlCarousel({
        items : 3,
        lazyLoad : true,
        navigation : true,
		pagination : false,
		responsive 	: true,
		rewindNav : false,
		navigationText :	["<",">"],
		scrollPerPage : true
      });   
    </script>
        <?php $k++; }?>
        <?php }?>
        <?php }else{ ?>
        <h1>No Merchant Founds</h1>
        <?php }?>
      </div>
    </section>
  </div>
</section>
<?php echo $footer; ?>
<style type="text/javascript">
.spamenuModal .modal-dialog{ top:60px; position:absolute; z-index:9999999999999!important;}
#myModal{ top:60px; position:relative; z-index:999999999999999!important;}
</style>
<script>

      $('.spamenu').click(function(){

            var title = $(this).attr('title');
            //alert(title);
            
                   $.ajax({
                                 url: 'index.php?route=product/merchantservice',
                                 type: 'get',
                               
                                 data:'merchant='+title,
                                 success: function(data) {
                                   //console.log(data);
                                    $("#spaservicebody").html(data);
                                 },
                                    error: function() {
                                          console.log('No Service');
                                 }
                              });
      });

  </script> 
<script type="text/javascript"><!--
$('#drowdown-group-resto').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}

	 var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}


	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	// var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();
	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});

$('#location').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	// var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();
	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});

$('#atmoshhpier').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	// var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();
	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});

$('#spokenlanguage').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	// var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();
	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});

$('#facilities').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	// var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();

	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});


$('#pricelevel').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	var filter_location_id = $('select[name=\'location\']').val();

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	//var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();
	var filter_spokenlanguage =1;

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});


$('#sortBy').on('change', function() {
	var url = 'index.php?route=product/category&';

	var filter_category = $('select[name=\'drowdown-group-resto\']').val();

	if (filter_category != '*') {
		url += '&path=' + encodeURIComponent(filter_category);
	}
	
	var filter_sort = $('select[name=\'pricelevel\']').val();

	if (filter_sort != '*') {
		url += '&sort=' + encodeURIComponent(filter_sort);
	}

	// var filter_location_id = $('select[name=\'location\']').val();

	var filter_spokenlanguage =1;

	if (filter_location_id != '*') {
		url += '&filter_location_id=' + encodeURIComponent(filter_location_id);
	}
	
	var filter_atmoshhpier = $('select[name=\'atmoshhpier\']').val();

	if (filter_atmoshhpier != '*') {
		url += '&filter_atmoshhpier=' + encodeURIComponent(filter_atmoshhpier);
	}
	
	var filter_spokenlanguage = $('select[name=\'spokenlanguage\']').val();

	if (filter_spokenlanguage != '*') {
		url += '&filter_spokenlanguage=' + encodeURIComponent(filter_spokenlanguage);
	}
	
	var filter_facilities = $('select[name=\'facilities\']').val();

	if (filter_facilities != '*') {
		url += '&filter_facilities=' + encodeURIComponent(filter_facilities);
	}
	 

	location = url;
});


//--></script>