<!-- Popular -->

<section id="spa2">
  <h1>Popular Spa &amp; Salon</h1>
  <div class="row column">
    <?php if(isset($merchants)){ $k=1;?>
    <?php foreach($merchants as $merchant) { ?>
    <div class="col-md-4">
      <div class="bot_col">
        <div class="box-detail-name"> <a href="<?=$merchant['href']?>" title="<?php echo $merchant['name'];?> @ <?php echo $merchant['location'];?> <?php echo $merchant['city'];?>">
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
            <div class="box-detail-rating-yellow_b" style="width:80%;"></div>
          </div>
          <div class="box-price-gray">
            <div class="box-detail-price-yellow_b" style="width:80%;"></div>
          </div>
        </div>
        <div class="restro-title-box-left"> <a href="<?=$merchant['href']?>" title="new 97 reservations recently"> <img src="<?=$merchant['thumb']?>" alt="" title=""> <span class="bottom">
          <p class="category1">new
            <?=$merchant['reserved']?>
            reservations recently</p>
          </span> </a> </div>
        <div class="table-responsive">
          <table class="table">
            <tbody>
            </tbody>
            <thead>
              <tr>
                <th>services</th>
                <th>duration</th>
                <th>price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($merchant['recomonded'] as $rec) { ?>
              <tr>
                <td><?=$rec['name']?></td>
                <td><?=$rec['duration']?>
                  min</td>
                <td><?=($rec['price'])?></td>
                <td><a href="<?=$merchant['href']?>&product_id=<?php echo $rec['product_id'];?>">
                  <button type="button" class="btn btn-default"> Select </button>
                  </a></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
          <a href="javascript:void(0)" data-toggle="modal" data-target="#myspaModal" title="<?php echo $merchant['merchant_id']; ?>" class="spamenu"><strong>See all services</strong><i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i></a> </div>
        <div class="swiper-container" id="timeslot-2-0">
          <div class="swiper-wrapper">
            <div id="owl-demo<?php echo $k;?>" class="owl-carousel">
              <?php foreach($merchant['discounts'] as $disc) { ?>
              <div class="item"><a href="<?=$merchant['href']?>" title="offer" class="swiper-slide red-slide">
                <p>
                  <?=$disc['start_time']?>
                </p>
                <b>
                <?=$disc['discount']?>
                %</b>
                <p>off</p>
                </a></div>
              <?php } ?>
            </div>
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
    <?php $k++; } ?>
    <?php } ?>
  </div>
</section>
<style>
   
    </style>
