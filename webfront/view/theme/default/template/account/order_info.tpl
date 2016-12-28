<?php echo $header; ?>
<div class="container invoice">
   <div id="pritable">
    <div class="row">
        <div class="col-xs-12">
        <div class="row">
       <div class="col-sm-12" style="text-align: center; "><img src="<?php echo HTTP_IMAGE; ?>logo.png"/><br/>Sukhumvit Soi 19 (Asoke) road, klongtoey nua,<br>               wattana, Bangkok 10110, Thailand
          </div>
          </div>
        <div class="invoice-title">
          <h2>Invoice</h2><h3 class="pull-right">Booking # <?=$order_id?></h3>
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-9">
            <address>
            <strong>Billed To:</strong><br>
              <?=$customer_name?><br>
              <?=$mobile_no?>
            </address>
          </div>
          <div class="col-xs-3 text-right">
            <address>
              <strong>Booking Date:</strong> 
              <?=$date_added?><br><br>
            </address>
          </div>
                 
        </div>
         
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Booking summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                                <tr>
                      <td><strong>Item</strong></td>
                                    <td class="text-right"><strong>Duration</strong></td>
                      <td class="text-right"><strong>Price</strong></td>
                                    <td class="text-right"><strong>Persons</strong></td>
                      
                      <td class="text-right"><strong>Total</strong></td>
                                </tr>
                </thead>
                <tbody>
                  <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php foreach ($products as $product) { ?>
                  <tr>
                    <td class="text-left"><?php echo $product['name']; ?> </td>
                                      <td class="text-right"><?php echo $product['duration']; ?> min</td>
                                      <td class="text-right"><?php echo $product['price']; ?></td>
                                      <td class="text-right"><?php echo $product['persons']; ?></td>
                                     
                                      <td class="text-right"><?php echo $product['total']; ?></td>
                  </tr>
                                <?php }?>
                    
                                <?php foreach ($totals as $total) { ?>
                                <tr>
                                  <td colspan="3"></td>
                                  <td class="text-right"><b><?php echo $total['title']; ?></b></td>
                                  <td class="text-right"><?php echo $currency_symbal.round($total['text']); ?></td>
                                  
                                </tr>
                                <?php } ?>
                               
                </tbody>
              </table>
                        <?php if ($histories) { ?>
      <h3><!-- <?php echo $text_history; ?> -->Payment history for pay at hotel</h3>
      <table class="table table-bordered  ">
        <thead>
          <tr>
            <td class="text-left"><?php echo $column_date_added; ?></td>
            <td class="text-left"><?php echo $column_status; ?></td>
            <td class="text-left"><?php echo $column_comment; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($histories) { ?>
          <?php foreach ($histories as $history) { ?>
          <tr>
            <td class="text-left"><?php echo $history['date_added']; ?></td>
            <td class="text-left"><?php echo $history['status']; ?></td>
            <td class="text-left"><?php echo $history['comment']; ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td colspan="3" class="text-center"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <style>
    #pritable{padding:10px; border:1px solid #ccc; margin: 5px;}
    .printbtn a{float: right;
background: #80bd01;
color: #fff;
padding: 7px 0;
margin: 2% 0;
border-radius: 5px;
-moz-border-radius: 5px;
-ms-border-radius: 5px;
-o-border-radius: 5px;
max-width: 150px;
width: 100%;
text-align: center;}
    </style>
    <script>
    function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
   </script>
    <div class="row">
    <div class="printbtn"> <a href="" onClick="printDiv('pritable');">Print</a> </div>
    </div>
</div>
<?php echo $footer; ?>