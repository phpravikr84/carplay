<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<h1>BOOKING</h1>
<div style="width: 680px;">
<table style="width:100%; border:none; background-color:#1f2730;">
<tr><td>
<a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; padding:10px; border: none; width:200px;" /></a></td>
 <td style=" width:450px; border-left: 1px solid #fff; color:#fff; text-align: left; padding: 10px;"><h2><?php echo $merchant_name; ?></h2><p style="font-size: 12px; "><?php echo $location; ?> <?php echo $city; ?> <?php echo $zone; ?> <?php echo $country; ?></p>
   
 </td>
</tr>

</table>

<p style="margin-top: 0px; margin-top: 20px; margin-bottom: 20px; font-weight:bold;"> Hi, <?php echo $name; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_greeting; ?></p>
  <?php if ($customer_id) { ?>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_link; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></p>
  <?php } ?>
  <?php if ($download) { ?>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_download; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $download; ?>"><?php echo $download; ?></a></p>
  <?php } ?>

  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #00aebd; font-weight: bold; text-align: left; padding: 7px; color: #fff; width:70%;"><?php echo $text_order_detail; ?></td>

        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #00aebd; font-weight: bold; text-align: right; padding: 7px; color: #fff; width:30%; text-decoration:underline;">reservation code: #RIW-2016-<?php echo $order_id; ?></td>
       

      </tr>
    </thead>
    <?php foreach ($products as $product) { ?>
    <tr>
      <?php $service_name = $product['name']; ?>
      <?php $duration =  $product['duration']; ?>
      <?php $bookingDiscountTime =   $product['bookingDiscountTime']; ?>
      <!-- <?php $discount =   $product['currency_symbol']." ".$product['discount']; ?> -->
      <?php $persons =   $product['persons']; ?>
      <?php $price =   $product['price']; ?>
      <?php $total =  $product['total']; ?>
      <?php $disc_amount =  $product['disc_amount']; ?>

      <?php $booking_date =  $product['purchaseDate']; ?>
     

       <?php $split = explode(' ', $product['total']);
$func = $split[0];
if(count($split) > 1){
  $discountAmt =   $func." ".$product['disc_amount'];
  $totalAmount = str_replace(',','', $split[1]);
  $tot = $totalAmount-$product['disc_amount'];
  $sub_total = $func." ".$tot;
}
else{
  $sub_total = NULL;
  } ?>
     
     

    </tr>
    <?php } ?>
    <tbody>
      <!-- <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">reservation code</td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; width:25%;">#RIW-2016-<?php echo $order_id; ?></td>
      </tr> -->
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">booking date</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $booking_date; ?></td>
      </tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">service name</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $service_name; ?></td>
      </tr>

       <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">duration</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $duration; ?> Min.</td>
      </tr>

       <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">unit price</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $price; ?></td>
      </tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">booking time</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $bookingDiscountTime; ?></td>
      </tr>

     
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold; width:75%;">covers person</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $persons; ?></td>
      </tr>


      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; font-weight:bold; width:75%;">discount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $discount; ?>%</td>
      </tr>

      </tbody>
      </table>

     
      
 <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px; margin-top:20px;">
 <tbody>
       

     

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; font-weight:bold; width:75%;">total amount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%;"><?php echo $total; ?></td>
      </tr>

      <tr style="background-color:#00aebd;">
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; font-weight:bold; width:75%; color:#fff;">discount amount</td>
         <td style="font-size: 13px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; width:25%; font-weight:bold; color:#fff;"><?php echo $discountAmt; ?> <em style="color:#fff;"> SAVINGS</em></td>
      </tr>

       <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px; font-weight:bold; width:75%;">grand total</td>
         <td style="font-size: 14px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight:bold; text-align: right; padding: 7px; width:25%;"><?php echo $sub_total; ?> <em style="color:#00aebd;"> PAID</em></td>
      </tr>

     <!--  <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold;">name</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold;">merchant</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $merchant_name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; font-weight:bold;">merchant address</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $location; ?> <?php echo $city; ?> <?php echo $zone; ?> <?php echo $country; ?></td>
      </tr> -->
      <tr>
        <td colspan="2" align="right" style="background-color:#39b3d7; padding:5px;"><a href="http://dev.riwigo.com/index.php?route=account/order/cancel&order_id=<?php echo $order_id; ?>" style="color:#fff;">cancel booking</a></td>
      </tr>
    </tbody>
  </table>
  <table style="width:100%; padding:10px; background-color:#80bd01; color:#fff;">
  <tr><td>
  <p style="width:50%; float:left;"><a href="http://dev.riwigo.com/index.php?route=information/information&information_id=5" style="color:#fff;">I agree Terms &amp; Conditions.</a></p><p style="width:50%; float:left;"><a href="http://dev.riwigo.com/index.php?route=information/information&information_id=3" style="color:#fff;">Privacy Policy</a></p>
  </td>
  </tr>
  <tr style="border-top:1px solid #fff; padding:5px; color:#fff;"><td>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_footer; ?></p>
  </tr></td>
  </table>
</div>
</body>
</html>
