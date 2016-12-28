<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-language').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
      <div class="well">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-name">Merchant</label>
                <select name="filter_merchant" id="input-merchant_id" class="form-control">
              	<option value="0">Select A Merchant</option>
                <?php foreach ($merchants as $merchant) { ?>
                
                	<?php if($merchant['merchant_id'] == $filter_merchant){?>
                	<option value="<?php echo $merchant['merchant_id']; ?>" selected="selected"><?php echo $merchant['name']; ?></option>
                	<?php }else{?>
                 	<option value="<?php echo $merchant['merchant_id']; ?>"><?php echo $merchant['name']; ?></option>
                 	<?php }?>
                <?php } ?>
              </select>
              </div> 
            </div>
              <div class="col-sm-2">
             <div class="form-group">
                <label class="control-label" for="input-model">From Date</label>
                <div class="input-group date">
                  <input name="filter_date" value="<?=$filter_date?>" placeholder="Transacation Date" data-date-format="YYYY-MM-DD" id="input-filter_date" class="form-control" type="text">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>
            
            <div class="col-sm-2">
             <div class="form-group">
                <label class="control-label" for="input-model">To Date</label>
                <div class="input-group date">
                  <input name="filter_todate" value="<?=$filter_todate?>" placeholder="Transacation Date" data-date-format="YYYY-MM-DD" id="input-filter_todate" class="form-control" type="text">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>
            
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-price">Remarks</label>
                <input type="text" name="filter_price" value="<?php echo $filter_remarks; ?>" placeholder="" id="input-price" class="form-control" />
              </div>
              
            </div> 
             <div class="col-sm-1">
              <div class="form-group">
              <label class="control-label" for="input-status">&nbsp;</label>
              <button type="button" id="button-filter" class="form-control btn btn-primary pull-right"><i class="fa fa-search"></i>Filter</button> </div></div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-language">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">Date</td>
                  <td class="text-left">Mercahnt</td>
                  <td class="text-left">Dr Amount</td>
                  <td class="text-right">Credit Amount</td>
                  <td class="text-right">Day Total</td>
                  <td class="text-right">Remarks</td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($transacations) { ?>
                <?php foreach ($transacations as $language) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($language['transacation_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $language['transacation_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $language['transacation_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $language['date_added']; ?></td>
                  <td class="text-left"><?php echo $language['merchant_name']; ?></td>
                  <td class="text-right"><?php echo $language['dr_amount']; ?></td>
                  <td class="text-right"><?php echo $language['cr_amount']; ?></td>
                  <td class="text-right"><?php echo $language['total_amt']; ?></td>
                  <td class="text-left"><?php echo $language['remarks']?></td>
                  <td class="text-right"><a href="<?php echo $language['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/transacation&token=<?php echo $token; ?>';

	 var filter_merchant = $('select[name=\'filter_merchant\']').val();

	if (filter_merchant != '*') {
		url += '&filter_merchant=' + encodeURIComponent(filter_merchant);
	}

	var filter_todate = $('input[name=\'filter_todate\']').val();

	if (filter_todate) {
		url += '&filter_todate=' + encodeURIComponent(filter_todate);
	}
	
	var filter_date = $('input[name=\'filter_date\']').val();

	if (filter_date) {
		url += '&filter_date=' + encodeURIComponent(filter_date);
	}

	var filter_remarks = $('input[name=\'filter_remarks\']').val();

	if (filter_remarks) {
		url += '&filter_remarks=' + encodeURIComponent(filter_remarks);
	} 
	 
	

	location = url;
});
//--></script>