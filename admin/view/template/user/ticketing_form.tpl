<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-review" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
           
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="subject" value="<?php echo $subject; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
               
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
              <?php if ($error_product) { ?>
              <div class="text-danger"><?php echo $error_product; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?></label>
            <div class="col-sm-10">
              <textarea name="message" cols="60" rows="8" placeholder="<?php echo $entry_text; ?>" id="input-text" class="form-control"><?php echo $subject; ?></textarea>
              <?php if ($error_text) { ?>
              <div class="text-danger"><?php echo $error_text; ?></div>
              <?php } ?>
            </div>
          </div>
          
          <?php if($user_group_id == 10) {?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10"><label class="  control-label" for="input-status"><?php echo $status;?></label></div>
          </div>
		 <?php }else{?>          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
              	<option value="Open" <?php if ($status == 'Open') { ?> selected="selected" <?php }?> >Open</option>
                <option value="Close" <?php if ($status == 'Close') { ?> selected="selected" <?php }?> >Close</option>
                <option value="Process" <?php if ($status == 'Process') { ?> selected="selected" <?php }?> >Process</option>
              </select>
            </div>
          </div>
          <?php }?>
        </form>
      </div>
      
    </div>
    
    <div class="panel panel-default">
    <div class="tab-pane active">
            <div id="history"></div>
            <br />
            <fieldset>
              <legend>&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i> <?php echo $text_history_add; ?></legend>
              <form class="form-horizontal" id="addHistory">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                  <div class="col-sm-10">
                    <select name="status" id="input-status" class="form-control">
                    <option value="Open" <?php if ($status == 'Open') { ?> selected="selected" <?php }?> >Open</option>
                    <option value="Close" <?php if ($status == 'Close') { ?> selected="selected" <?php }?> >Close</option>
                    <option value="Process" <?php if ($status == 'Process') { ?> selected="selected" <?php }?> >Process</option>
                  </select>
                   <input type="text" name="ticketing_id" value="<?php echo $ticketing_id; ?>" placeholder=" >"  class="form-control" />
                   <input type="text" name="user_id" value="<?php echo $user_id; ?>" placeholder=" >"  class="form-control" />
                  </div>
                </div>
                 
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
                  <div class="col-sm-10">
                    <textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
                  </div>
                </div>
              </form>
            </fieldset>
            <div class="text-right">
              <button id="button-history" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_history_add; ?></button>
            </div>
          </div>
       </div>
  </div>
  <script type="text/javascript"><!--
  
  
  $('#history').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

	$('#history').load(this.href);
});

$('#history').load('index.php?route=user/ticketing/historylist&token=<?php echo $token; ?>&ticketing_id=<?php echo $ticketing_id; ?>');

  $('#button-history').on('click', function() {
	  
	   

	$.ajax({
		url: 'index.php?route=user/ticketing/history&token=<?php echo $token;?>' ,
		type: 'post',
		data: $('#addHistory textarea, #addHistory select, input[type=\'text\'],input[type=\'hidden\']'),
		dataType: 'json',
		crossDomain: true,
		beforeSend: function() {
                   // $('#detail').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
          $('#button-history').button('load');          
		},
		complete: function() {
                    $('#button-login').button('reset');
                    // will first fade out the loading animation
                    //.jQuery("#status").fadeOut();
                    // will fade out the whole DIV that covers the website.
                   // jQuery("#preloader").delay(1000).fadeOut("slow");
		},
		success: function(json) {
                    $('.alert, .text-danger').remove();
					if (json['error']) {
						$('#history').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}

                     if (json['success']) {
						$('#history').load('index.php?route=user/ticketing/historylist&token=<?php echo $token; ?>&ticketing_id=<?php echo $ticketing_id; ?>');
		
						$('#history').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
		
						$('textarea[name=\'comment\']').val('');
					}			
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

	 

	 
});
  
//--></script></div>
<?php echo $footer; ?>