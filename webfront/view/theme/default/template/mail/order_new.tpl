<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<h1>Booking Information<h1>
<div style="width: 680px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>
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
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;" colspan="2"><?php echo $text_order_detail; ?></td>
      </tr>
    </thead>
    <?php foreach ($products as $product) { ?>
    <tr>
      <?php $service_name = $product['name']; ?>
      <?php $duration =  $product['duration']; ?>
      <?php $bookingDiscountTime =   $product['bookingDiscountTime']; ?>
      <?php $discount =   $product['discount']; ?>
      <?php $persons =   $product['persons']; ?>
      <?php $price =   $product['price']; ?>
      <?php $total =  $product['total']; ?>
       <?php $price =  $product['price']; ?>
        <?php $disc_amount =  $product['disc_amount']; ?>
    </tr>
    <?php } ?>
    <tbody>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">reservation code</td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">RIW-2016-<?php echo $order_id; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">date</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $merchant_name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">booking time</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $bookingDiscountTime; ?>%</td>
      </tr>

      
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">duration</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $duration; ?> Min.</td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">persons</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $persons; ?></td>
      </tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">discount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $discount; ?>%</td>
      </tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">price</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $price; ?></td>
      </tr>

       <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">amount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $total; ?></td>
      </tr>


      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">discount amount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $disc_amount; ?></td>
      </tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">Total amount</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $total - $disc_amount; ?></td>
      </tr>


      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">name</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">merchant</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $merchant_name; ?></td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">merchant address</td>
         <td style="font-size: 12px;  border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $location; ?> <?php echo $city; ?> <?php echo $zone; ?> <?php echo $country; ?></td>
      </tr>

      <tr>
      <td colspan="2" align="right"><a href="<?php echo $cancellink; ?>">Cancel Booking</a></td>
      </tr>
    </tbody>
  </table>
  <p><a href="<?php echo $termsandcondition; ?>">I agree Terms &amp; Conditions.</a></p> <p><a href="<?php echo $policies; ?>">Privacy Policy</a></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_footer; ?></p>
</div>
</body>
</html>
