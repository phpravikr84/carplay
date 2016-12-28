<!-- Service Popup Start -->

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
           <td><a href="<?php echo HTTP_SERVER; ?>index.php?route=product/merchantdetail&merchant_id=<?php echo $merchant_service['merchant_id']; ?>&product_id=<?php echo $merchant_service['product_id'];?>"><button type="button" class="btn btn-default"> Select </button></a></td>
          <!-- <td><button  ng-click="submitted=true" class="btn_popup js-modal-close"  onClick="selectService('<?=$merchant_service['name']?>','<?=$merchant_service['duration']?>','<?=round($merchant_service['price'])?>', '<?=$merchant_service['product_id']?>','<?=$i?>')" type="button">select</button></td> -->
        </tr>
        <?php $i++; }?>
        <!--<tr >
          <td colspan="5"><a href="javascript:void(0)" class="js-modal-close">
            <button ng-click="submitted=true" class="btn_popup "  type="button">Done</button>
            </a></td>
        </tr>-->
      </tbody>
    </table>
  
<!-- Service Popup End --> 
      