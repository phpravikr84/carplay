<section id="spa2">
  <h1>Popular Merchant</h1>
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
                <th>Services</th>
                <th>duration</th>
                <th>price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($merchant['recomonded'] as $rec) { ?>
            
            <tr>
              <td><?=$rec['name']?></td>
              <td><?=$rec['duration']?> min</td>
              <td><?=($rec['price'])?></td>
              <td><a href="<?=$merchant['href']?>&product_id=<?php echo $rec['product_id'];?>"><button type="button" class="btn btn-default"> Select </button></a></td>
            </tr>
            
            <?php }?>
            </tbody>
            
          </table>
          <a href="#" class="spamenu">Click here for <strong>Spa Menu</strong><i class="fa" aria-hidden="true"> <img src="image/hand.png"> </i></a> </div>
        <div class="swiper-container" id="timeslot-2-0">
          <div class="swiper-wrapper">
            <ul id="flexiselPopularMerchant<?php echo $k;?>">
              <?php foreach($merchant['discounts'] as $disc) { ?>
              <li><a href="<?=$merchant['href']?>" title="offer" class="swiper-slide red-slide">
                <p>
                  <?=$disc['start_time']?>
                </p>
                <b>
                <?=$disc['discount']?>
                %</b>
                <p>off</p>
                </a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <script>
$(window).load(function() {
    $("#flexiselPopularMerchant<?php echo $k;?>").flexisel({
        visibleItems: 3,
        itemsToScroll: 1,         
        autoPlay: {
            enable: false,
            interval: 5000,
            pauseOnHover: true
        }        
    });
});
</script>
    
    <?php $k++; } ?>
    <?php } ?>
  </div>
</section>
 
