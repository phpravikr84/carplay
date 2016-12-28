<?php echo $header; ?>
<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
<script src="view/javascript/bootstrap/js/highlight.js"></script>
<script src="view/javascript/bootstrap/js/main.js"></script>
<script src="view/javascript/bootstrap/js/bootstrap-select.js"></script>
<link href="view/javascript/bootstrap/css/bootstrap-select.css" rel="stylesheet">		
<link href="view/javascript/bootstrap/css/bootstrap-switch.css" rel="stylesheet">
<link type="text/css" href="view/stylesheet/login.css" rel="stylesheet" media="screen" />		
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-quicklogin" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title1; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-quicklogin" class="form-horizontal">
		 <ul class="nav nav-tabs menu col-sm-3">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-register" data-toggle="tab"><?php echo $tab_register; ?></a></li>
            <li><a href="#tab-login" data-toggle="tab"><?php echo $tab_login; ?></a></li>
            <li><a href="#tab-forgot" data-toggle="tab"><?php echo $tab_forgot; ?></a></li>
            <li><a href="#tab-social" data-toggle="tab"><?php echo $tab_social; ?></a></li>
            <li><a href="#tab-success" data-toggle="tab"><?php echo $tab_sucess; ?></a></li>
            <li><a href="#tab-custom" data-toggle="tab"><?php echo $tab_custom; ?></a></li>
			<li><a href="#tab-adjustcolor" data-toggle="tab"> <?php echo $tab_adjustcolor; ?></a></li>
			
          </ul>
		  <div class="tab-content col-sm-9">
            <div class="tab-pane active" id="tab-general">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-image"><?php echo $entry_logo; ?></label>
					<div class="col-sm-10">
					  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $quicklogin_logo; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
					  <input type="hidden" name="quicklogin_image" value="<?php echo $quicklogin_image; ?>" id="input-image" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					
						<input type="radio" name="quicklogin_status" id="input-status" value="1" <?php if ($quicklogin_status) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2" />
					</div>
				</div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-openpopup"><?php echo $entry_openpopup; ?></label>
                    <div class="col-sm-3">
                        <select name="quicklogin_openpopup" id="input-openpopup" class="selectpicker form-control">
							<?php if($quicklogin_openpopup=='clickable'){?>
                            <option value="clickable" selected="selected">Show on Click</option>
							<option value="popup">Show in Popup</option>
							<?php } else{ ?>
							<option value="clickable">Show on Click</option>
							<option value="popup" selected="selected">Show in Popup</option>
							<?php } ?>
                           
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-session"><?php echo $entry_session; ?></label>
					<div class="col-sm-3">
						<input type="text" name="quicklogin_session" value="<?php echo $quicklogin_session?>" id="input-session" class="form-control" />
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-register">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-register-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<input type="radio" name="quicklogin_registerstatus" id="input-register-status" value="1" <?php if ($quicklogin_registerstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
					</div>
				</div>
				<div class="table-responsive">
                <table id="register" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_fieldname; ?></td>
                      <td class="text-left"><?php echo $entry_label; ?></td>
                      <td class="text-left"><?php echo $entry_error; ?></td>
                      <td class="text-left"><?php echo $entry_required; ?></td>
                      <td class="text-left"><?php echo $entry_sort; ?></td>
                      <td class="text-left"><?php echo $entry_status; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
						<td class="text-left" style="width:15%;"><label><?php echo $entry_customer_group; ?></label></td>
						<td class="text-left">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['customgrouplabel'][$language['language_id']])){
							$value = $quicklogin_register['customgrouplabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>				
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[customgrouplabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_customer_group; ?>" value="<?php echo $value; ?>" class="form-control" value="<?php echo $value; ?>"/>
						</div>
						<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['customgrouperror'][$language['language_id']])){
							$value = $quicklogin_register['customgrouperror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[customgrouperror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" value="<?php echo $value; ?>" class="form-control" value="<?php echo $value; ?>"/>
						</div>
						<?php } ?>
						</td>
						
						<td class="text-left">
							<input type="radio" name="quicklogin_cgrequired" id="input-status" value="1" <?php if ($quicklogin_cgrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_cgsortorder" value="<?php echo $quicklogin_cgsortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left">
							<input type="radio" name="quicklogin_cgstatus" id="input-status" value="1" <?php if ($quicklogin_cgstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>-->
					<tr>
						<td class="text-left"><label><?php echo $entry_firstname; ?></label></td>
						
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['firstnamelabel'][$language['language_id']])){
							$value = $quicklogin_register['firstnamelabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						
						<input name="quicklogin_register[firstnamelabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_firstname; ?>" value="<?php echo $value; ?>" class="form-control"/>
						</div>
						<?php } ?>
						</td>
						
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['firstnamerror'][$language['language_id']])){
							$value = $quicklogin_register['firstnamerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						<input name="quicklogin_register[firstnamerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_firstname_missing; ?>" class="form-control" value="<?php echo $value; ?>"/>
						</div>
						<?php } ?>
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_fnamerequired" id="input-status" value="1" <?php if ($quicklogin_fnamerequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_fnamesortorder" value="<?php echo $quicklogin_fnamesortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_fnamestatus" id="input-status" value="1" <?php if ($quicklogin_fnamestatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_lastname; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
							
						<?php 
						if(!empty($quicklogin_register['lastnamelabel'][$language['language_id']])){
							$value = $quicklogin_register['lastnamelabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>		
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[lastnamelabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_lastname; ?>" value="<?php echo $value; ?>" class="form-control"/>
						</div>
						<?php } ?>
						</td>
						
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['lastnamerror'][$language['language_id']])){
							$value = $quicklogin_register['lastnamerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[lastnamerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_lastname_missing; ?>"  value="<?php echo $value; ?>" class="form-control"/>
						</div>
						<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_lastnamerequired" id="input-status" value="1" <?php if ($quicklogin_lastnamerequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_lastnamesortorder" value="<?php echo $quicklogin_lastnamesortorder;?>" placeholder="" class="form-control" />	
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_lastnamestatus" id="input-status" value="1" <?php if ($quicklogin_lastnamestatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_email; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['emaillabel'][$language['language_id']])){
							$value = $quicklogin_register['emaillabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[emaillabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_email; ?>" value="<?php echo $value; ?>" class="form-control"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
							<?php 
						if(!empty($quicklogin_register['emailerror'][$language['language_id']])){
							$value = $quicklogin_register['emailerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>						
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[emailerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_email_missing; ?>" value="<?php echo $value; ?>"class="form-control"/>
						</div>
						<?php } ?>
						</td>
						<td class="text-left" style="opacity:0.5">
						<input type="radio" name="quicklogin_emailrequired" id="input-status" value="1" <?php if ($quicklogin_emailrequired) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2"/>
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_emailsortorder" value="<?php echo $quicklogin_emailsortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left" style="opacity:0.5">
						<input type="radio" name="quicklogin_emailstatus" id="input-status" value="1" <?php if ($quicklogin_emailstatus) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2" />
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_telephone; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['phonelabel'][$language['language_id']])){
							$value = $quicklogin_register['phonelabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[phonelabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_telephone; ?>" value="<?php echo $value; ?>" class="form-control"/>
						</div>
						<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['phonerror'][$language['language_id']])){
							$value = $quicklogin_register['phonerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[phonerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>" />
						</div>
						<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_phonerequired" id="input-status" value="1" <?php if ($quicklogin_phonerequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_phonesortorder" value="<?php echo $quicklogin_phonesortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_phonestatus" id="input-status" value="1" <?php if ($quicklogin_phonestatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_fax; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['faxlabel'][$language['language_id']])){
							$value = $quicklogin_register['faxlabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
						
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[faxlabel][<?php echo $language['language_id']; ?>][" placeholder="<?php echo $entry_fax; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['faxerror'][$language['language_id']])){
							$value = $quicklogin_register['faxerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
						<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						  <input name="quicklogin_register[faxerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
						</div>
						<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_faxrequired" id="input-status" value="1" <?php if ($quicklogin_faxrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>	
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_faxsortorder" value="<?php echo $quicklogin_faxsortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_faxstatus" id="input-status" value="1" <?php if ($quicklogin_faxstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					
					<tr>
						<td class="text-left"><label><?php echo $entry_company; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['companylabel'][$language['language_id']])){
							$value = $quicklogin_register['companylabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[companylabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_company; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['companyerror'][$language['language_id']])){
							$value = $quicklogin_register['companyerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[companyerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_compquired" id="input-status" value="1" <?php if ($quicklogin_compquired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_compsortorder" value="<?php echo $quicklogin_compsortorder;?>" placeholder="" class="form-control" />	
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_compstatus" id="input-status" value="1" <?php if ($quicklogin_compstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_address1; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['add1label'][$language['language_id']])){
							$value = $quicklogin_register['add1label'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[add1label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_address1; ?>" class="form-control" value="<?php echo $value; ?>" />
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['add1error'][$language['language_id']])){
							$value = $quicklogin_register['add1error'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[add1error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_add1required" id="input-status" value="1" <?php if ($quicklogin_add1required) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left">
						<input type="text" name="quicklogin_add1sortorder" value="<?php echo $quicklogin_add1sortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_add1status" id="input-status" value="1" <?php if ($quicklogin_add1status) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_address2; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['add2label'][$language['language_id']])){
							$value = $quicklogin_register['add2label'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[add2label][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_address2; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['add2error'][$language['language_id']])){
							$value = $quicklogin_register['add2error'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[add2error][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_add2required" id="input-status" value="1" <?php if ($quicklogin_add2required) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						<td class="text-left">
							<input type="text" name="quicklogin_add2sortorder" value="<?php echo $quicklogin_add2sortorder;?>" placeholder="" class="form-control" />
						</td>
						<td class="text-left">
							<input type="radio" name="quicklogin_add2status" id="input-status" value="1" <?php if ($quicklogin_add2status) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					
					<tr>
						<td class="text-left"><label><?php echo $entry_city; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['citylabel'][$language['language_id']])){
							$value = $quicklogin_register['citylabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[citylabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_city; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['cityerror'][$language['language_id']])){
						$value = $quicklogin_register['cityerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[cityerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_cityrequired" id="input-status" value="1" <?php if ($quicklogin_cityrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_citysortorder" value="<?php echo $quicklogin_citysortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_citystatus" id="input-status" value="1" <?php if ($quicklogin_citystatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_postcode; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['postcodelabel'][$language['language_id']])){
							$value = $quicklogin_register['postcodelabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[postcodelabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_postcode; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['postcoderror'][$language['language_id']])){
							$value = $quicklogin_register['postcoderror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[postcoderror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_postcodrequired" id="input-status" value="1" <?php if ($quicklogin_postcodrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_postcodsortorder" value="<?php echo $quicklogin_postcodsortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_postcodstatus" id="input-status" value="1" <?php if ($quicklogin_postcodstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_country; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['countrylabel'][$language['language_id']])){
							$value = $quicklogin_register['countrylabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[countrylabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_country; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['countryerror'][$language['language_id']])){
							$value = $quicklogin_register['countryerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[countryerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_countryrequired" id="input-status" value="1" <?php if ($quicklogin_countryrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_countrysortorder" value="<?php echo $quicklogin_countrysortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_countrystatus" id="input-status" value="1" <?php if ($quicklogin_countrystatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_zone; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['zonelabel'][$language['language_id']])){
							$value = $quicklogin_register['zonelabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						<input name="quicklogin_register[zonelabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_zone; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['zonerror'][$language['language_id']])){
							$value = $quicklogin_register['zonerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[zonerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_zonerequired" id="input-status" value="1" <?php if ($quicklogin_zonerequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_zonesortorder" value="<?php echo $quicklogin_zonesortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_zonestatus" id="input-status" value="1" <?php if ($quicklogin_zonestatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_password; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['pwdlabel'][$language['language_id']])){
							$value = $quicklogin_register['pwdlabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[pwdlabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_password; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['pwderror'][$language['language_id']])){
							$value = $quicklogin_register['pwderror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[pwderror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_password_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_pwdrequired" id="input-status" value="1" <?php if ($quicklogin_pwdrequired) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_pwdsortorder" value="<?php echo $quicklogin_pwdsortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_pwdstatus" id="input-status" value="1" <?php if ($quicklogin_pwdstatus) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_confirm_password; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['cpwdlabel'][$language['language_id']])){
							$value = $quicklogin_register['cpwdlabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[cpwdlabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_confirm_password; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['cpwderror'][$language['language_id']])){
							$value = $quicklogin_register['cpwderror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[cpwderror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
					<td class="text-left">
						<input type="radio" name="quicklogin_cpwdrequired" id="input-status" value="1" <?php if ($quicklogin_cpwdrequired) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_cpwdsortorder" value="<?php echo $quicklogin_cpwdsortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_cpwdstatus" id="input-status" value="1" <?php if ($quicklogin_cpwdstatus) { ?> checked <?php } ?>data-radio-all-off="false" class="switch-radio2"/>
						</td>
                    </tr>
					<tr>
						<td class="text-left"><label><?php echo $entry_privacy; ?></label></td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['privacylabel'][$language['language_id']])){
							$value = $quicklogin_register['privacylabel'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[privacylabel][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_privacy; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left"><?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['privacyerror'][$language['language_id']])){
							$value = $quicklogin_register['privacyerror'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[privacyerror][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_error; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
						</td>
						<td class="text-left">
						<input type="radio" name="quicklogin_privacyrequired" id="input-status" value="1" <?php if ($quicklogin_privacyrequired) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
						
						<td class="text-left" style="width:8%;">
							<input type="text" name="quicklogin_privacysortorder" value="<?php echo $quicklogin_privacysortorder;?>" placeholder="" class="form-control" />
						</td>
						
						<td class="text-left">
						<input type="radio" name="quicklogin_privacystatus" id="input-status" value="1" <?php if ($quicklogin_privacystatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
						</td>
                    </tr>
                  </tbody>
                </table>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-account-title"><?php echo $entry_privacyautochk; ?></label>
					<div class="col-sm-10">
					 <input type="radio" name="quicklogin_privacyautochk" id="input-status" value="1" <?php if ($quicklogin_privacyautochk) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"/>
					
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-account-title"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
					 <?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['accounttitle'][$language['language_id']])){
							$value = $quicklogin_register['accounttitle'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[accounttitle][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
							<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-submit-button"><?php echo $entry_submit_button; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['submitbutton'][$language['language_id']])){
							$value = $quicklogin_register['submitbutton'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[submitbutton][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-email-exist"><?php echo $entry_email_warning; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['emailexist'][$language['language_id']])){
							$value = $quicklogin_register['emailexist'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[emailexist][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-login">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-login-title"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['logintitle'][$language['language_id']])){
							$value = $quicklogin_register['logintitle'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[logintitle][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-login-submit-button"><?php echo $entry_submit_button; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['loginsubmitbtn'][$language['language_id']])){
							$value = $quicklogin_register['loginsubmitbtn'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[loginsubmitbtn][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-login-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<input type="radio" name="quicklogin_loginstatus" id="input-login-status" value="1" <?php if ($quicklogin_loginstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2" />
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-forgot">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-forgot-title"><?php echo $entry_title; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['forgottitle'][$language['language_id']])){
							$value = $quicklogin_register['forgottitle'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[forgottitle][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-forgot-submit-button"><?php echo $entry_submit_button; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['forgotsubmitbtn'][$language['language_id']])){
							$value = $quicklogin_register['forgotsubmitbtn'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[forgotsubmitbtn][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-forgot-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<input type="radio" name="quicklogin_forgotstatus" id="input-forgot-status" value="1" <?php if ($quicklogin_forgotstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2" />
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-social">
				<div class="row">					
					<div class="col-sm-12">
						<div class="tab-content">
							
								<div class="form-group">
									<label class="col-sm-3 control-label" for="input-sgeneral-title"><?php echo $entry_title; ?></label>
									<div class="col-sm-9">
									<?php foreach ($languages as $language) { ?>
									<?php 
									if(!empty($quicklogin_register['sgeneraltitle'][$language['language_id']])){
										$value = $quicklogin_register['sgeneraltitle'][$language['language_id']];
									}else{
										$value = '';
									}
									?>	
										<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
										  <input name="quicklogin_register[sgeneraltitle][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
										</div>
									<?php } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label" for="input-sgeneral-status"><?php echo $entry_status; ?></label>
									<div class="col-sm-9">
										<input type="radio" name="quicklogin_sgeneralstatus" id="input-sgeneral-status" value="1" <?php if ($quicklogin_sgeneralstatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-sm-3 control-label" for="input-fontcolor"><?php echo $entry_fontcolor; ?></label>
									<div class="col-sm-9">
									  <input type="text" name="quicklogin_sgfontcolor" value="<?php echo $quicklogin_sgfontcolor; ?>"  id="input-fontcolor" class="form-control color" />
									</div>
								</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="input-openpopup"><?php echo $entry_socialarea; ?></label>
							<div class="col-sm-9">
								<select name="quicklogin_socialarea" id="input-openpopup" class="selectpicker form-control">
									<?php if($quicklogin_socialarea=='top'){?>
									<option value="top" selected="selected">Top</option>
									<option value="bottom">Bottom</option>
									<?php } else{ ?>
									<option value="top">Top</option>
									<option value="bottom" selected="selected">Bottom</option>
									<?php } ?>
								   
								</select>
							</div>
						</div>
						<!--<div class="form-group">
							<label class="col-sm-3 control-label" for="input-openpopup">Edit Social Login</label>
							<div class="col-sm-9">
								<a href="<?php echo $socialloginlink;?>">Click Here</a>
							</div>
						</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-success">
				<ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
			  <div class="tab-content">
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-forgot-title"><?php echo $entry_headtitle; ?></label>
					<div class="col-sm-10">
						<?php foreach ($languages as $language) { ?>
						<?php 
						if(!empty($quicklogin_register['regsuccesstitle'][$language['language_id']])){
							$value = $quicklogin_register['regsuccesstitle'][$language['language_id']];
						}else{
							$value = '';
						}
						?>	
							<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
							  <input name="quicklogin_register[regsuccesstitle][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_title; ?>" class="form-control" value="<?php echo $value; ?>"/>
							</div>
						<?php } ?>
					</div>
				</div>
				
				<?php foreach ($languages as $language) { ?>
				<?php 
						if(!empty($quicklogin_register['succesdesc'][$language['language_id']])){
							$value = $quicklogin_register['succesdesc'][$language['language_id']];
						}else{
							$value = '';
						}
						?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_message; ?></label>
					<div class="col-sm-10">
                      <textarea name="quicklogin_register[succesdesc][<?php echo $language['language_id']; ?>]" placeholder="<?php echo $entry_message; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo $value; ?></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-regsucess"><?php echo $entry_buttontext; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="quicklogin_rsbuttontext" value="<?php echo $quicklogin_rsbuttontext?>" placeholder="" id="input-regsucess" class="form-control" />
                    </div>
                  </div>
                </div>
                <?php } ?>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-rsucess"><?php echo $entry_rsucess; ?></label>
                    <div class="col-sm-3">
                        <select name="quicklogin_rsucess" id="input-rsucess" class="selectpicker form-control">
							<?php if($quicklogin_rsucess==1){?>
                            <option value="1" selected="selected">My Account</option>
							<option value="0">Success</option>
							<?php } else{ ?>
							<option value="1">My Account</option>
							<option value="0" selected="selected">Success</option>
							<?php } ?>
                           
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-login-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<input type="radio" name="quicklogin_successtatus" id="input-login-status" value="1" <?php if ($quicklogin_successtatus) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2" />
					</div>
				</div>
				
			  </div>
			</div>
			
			<div class="tab-pane" id="tab-custom">
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-customcss"><?php echo $entry_customcss; ?></label>
					<div class="col-sm-10">
                      <textarea name="quicklogin_customcss" value="<?php echo $quicklogin_customcss?>" id="input-customcss" class="form-control" rows="10"><?php echo $quicklogin_customcss?></textarea>
                    </div>
                </div>
			</div>
			
			
			<div class="tab-pane" id="tab-adjustcolor">
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-contanercolor"><?php echo $entry_contanercolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_contanercolor" value="<?php echo $quicklogin_contanercolor; ?>"  id="input-contanercolor" class="form-control color" placeholder="<?php echo $entry_contanercolor;?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-headingcolor"><?php echo $entry_headingcolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_headingcolor" value="<?php echo $quicklogin_headingcolor; ?>"  id="input-headingcolor" class="form-control color" placeholder="<?php echo $entry_headingcolor;?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-inputbordercolor"><?php echo $entry_inputbordercolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_inputbordercolor" value="<?php echo $quicklogin_inputbordercolor; ?>"  id="input-inputbordercolor" class="form-control color" placeholder="<?php echo $entry_inputbordercolor;?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-textcolor"><?php echo $entry_textcolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_textcolor" value="<?php echo $quicklogin_textcolor; ?>"  id="input-textcolor" class="form-control color" placeholder="<?php echo $entry_textcolor;?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-butonbgcolor"><?php echo $entry_butonbgcolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_butonbgcolor" value="<?php echo $quicklogin_butonbgcolor; ?>"  id="input-bottoncolor" class="form-control color" placeholder="<?php echo $entry_butonbgcolor;?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-bottoncolor"><?php echo $entry_bottoncolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="quicklogin_bottoncolor" value="<?php echo $quicklogin_bottoncolor; ?>"  id="input-bottoncolor" class="form-control color" placeholder="<?php echo $entry_bottoncolor;?>"/>
                    </div>
                </div>
				
			</div>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/stylesheet/jquery.minicolors.css">
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
//--></script> 
<script>
$('#language a:first').tab('show');
$(document).ready( function() {
	$('.color').each( function() {
        $(this).minicolors({
			control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						if( !hex ) return;
						if( opacity ) hex += ', ' + opacity;
						try {
							console.log(hex);
						} catch(e) {}
			},
			theme: 'bootstrap'
		});
	});
});
</script>
<style>
.form-group{border-bottom:1px solid #ddd;padding-bottom:20px;}
.form-group:last-child{border:none;}
#tab-social legend{padding-bottom:10px;}
.minicolors-theme-bootstrap .minicolors-input{height:35px;}
</style>
<?php echo $footer; ?>
