<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-language" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">Transacation Date</label>
             <div class="col-sm-4 input-group date">
                  <input type="text" name="transacation_date" value="<?=$transacation_date?>" placeholder="Transacation Date" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                   <?php if ($error_transacation_date) { ?>
              <div class="text-danger"><?php echo $error_transacation_date; ?></div>
              <?php } ?>
                  </div>
          </div>
        	<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-code">Merchant Name</label>
            <div class="col-sm-10">
              <select name="merchant_id" id="input-merchant_id" class="form-control">
              	<option value="0">Select A Merchant</option>
                <?php foreach ($merchants as $merchant) { ?>
                
                	<?php if($merchant['merchant_id'] == $merchant_id){?>
                	<option value="<?php echo $merchant['merchant_id']; ?>" selected="selected"><?php echo $merchant['name']; ?></option>
                	<?php }else{?>
                 	<option value="<?php echo $merchant['merchant_id']; ?>"><?php echo $merchant['name']; ?></option>
                 	<?php }?>
                <?php } ?>
              </select>
              <?php if ($error_merchant_id) { ?>
              <div class="text-danger"><?php echo $error_merchant_id; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><span data-toggle="tooltip" title="<?php echo $help_transacation; ?>">Transacation Type</span></label>
            <div class="col-sm-10">
              <select name="transacation_type" id="input-status" class="form-control"> 
                <option value="dr" <?php if($transacation_type == 'dr'){?>selected="selected" <?php } ?> >Debit</option>
                <option value="cr" <?php if($transacation_type == 'cr'){?>selected="selected" <?php } ?>>Credit</option> 
              </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="transacation_amt" value="<?php echo $transacation_amt; ?>" placeholder="<?php echo $transacation_amt; ?>" id="input-name" class="form-control" />
              <?php if ($error_transacation_amt) { ?>
              <div class="text-danger"><?php echo $error_transacation_amt; ?></div>
              <?php } ?>
            </div>
          </div>
           
           
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order">Remarks</label>
            <div class="col-sm-10">
                
              <textarea name="remarks" placeholder="Remarks" class="form-control" id="input-remarks"><?php echo $remarks; ?></textarea>
              
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?> 