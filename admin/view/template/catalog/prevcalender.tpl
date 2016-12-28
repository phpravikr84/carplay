<thead>
  <tr>
    <td class="text-center" >Days</td>
    <?php
     // Start date
     $date = $start_date;
     // End date
     $end_date = $end_date;
     ?>
    <?php while (strtotime($date) <= strtotime($end_date)) { ?>
    <td class="text-center" colspan="2"><?php echo $date;?> <?php echo date('l', strtotime($date));?></td>
    <?php  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
    <td></td>
  </tr>
  <tr>
    <td class="text-left">Time</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td class="text-right">Disc %</td>
    <td class="text-left">Seat</td>
    <td>Action</td>
  </tr>
</thead>
<tbody >
  <?php $discount_row = 0;?>
  <?php foreach ($disocunt_data as $merchant_discount) {  $i=0; $hideTd=1;?>
  <tr id="discount-row<?php echo $discount_row; ?>">
    <td class="text-left" style="width: 12%;"><div class="input-group time">
        <input type="text" name="merchant_discount[<?php echo $discount_row; ?>][discount_time]" value="<?php echo  $merchant_discount['discount_time']; ?>" placeholder="Time" data-date-format="" class="form-control" />
        <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
        </span></div>
      <input type="hidden" name="merchant_discount[<?php echo $discount_row; ?>][sort_order]" value="<?php echo $merchant_discount['sort_order']; ?>" placeholder="" class="form-control" /></td>
    <?php foreach ($merchant_discount['discount_data']as $merchant_disc) {  ?>
    <td class="text-right"><input type="text" name="merchant_discount[<?php echo $discount_row; ?>][disc_data][<?php echo $i;?>][discount]" value="<?php echo $merchant_disc['discount']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
    <td class="text-right"><input type="text" name="merchant_discount[<?php echo $discount_row; ?>][disc_data][<?php echo $i;?>][seats]" value="<?php echo $merchant_disc['seats']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/>
      <input type="text" name="merchant_discount[<?php echo $discount_row; ?>][disc_data][<?php echo $i;?>][discount_date]" value="<?php echo  $merchant_disc['discount_date']; ?>" placeholder="" class="form-control" />
      <input type="text" name="merchant_discount[<?php echo $discount_row; ?>][disc_data][<?php echo $i;?>][merchant_discount_id]" value="<?php echo  $merchant_disc['merchant_discount_id']; ?>" placeholder="" class="form-control" />
      </td>
    <?php $i++;  $hideTd++; } ?>
    <td class="text-left"><button type="button" onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
  </tr>
  <?php $discount_row++; ?>
  <?php } ?>
</tbody> 