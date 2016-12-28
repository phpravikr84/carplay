<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      	 
        <button type="submit" form="form-merchant" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-merchant" class="form-horizontal">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          <li><a href="#tab-discount" data-toggle="tab"><?php echo $tab_discount; ?></a></li>
          <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
          <li><a href="#tab-services" data-toggle="tab"><?php echo $tab_services; ?></a></li>
          <li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li>
          <li><a href="#tab-bm" data-toggle="tab">Business Model</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-general">
            <ul class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_name[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-contact_person<?php echo $language['language_id']; ?>"><?php echo $entry_contact_person; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][contact_person]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['contact_person'] : ''; ?>" placeholder="<?php echo $entry_contact_person; ?>" id="input-contact_person<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_contact_person[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_contact_person[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                  <label class="col-sm-2 control-label" for="input-email<?php echo $language['language_id']; ?>"><?php echo $entry_email; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][email]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['email'] : ''; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_email[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_email[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-city<?php echo $language['language_id']; ?>"><?php echo $entry_phone; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][phone]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['phone'] : ''; ?>" placeholder="<?php echo $entry_phone; ?>" id="input-phone<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_phone[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_phone[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                  <label class="col-sm-2 control-label" for="input-mobile<?php echo $language['language_id']; ?>"><?php echo $entry_mobile; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][mobile]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['mobile'] : ''; ?>" placeholder="<?php echo $entry_mobile; ?>" id="input-mobile    <?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_mobile[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_mobile[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-address<?php echo $language['language_id']; ?>"><?php echo $entry_address; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][address]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['address'] : ''; ?>" placeholder="<?php echo $entry_address; ?>" id="input-address<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_address[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_address[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                  <label class="col-sm-2 control-label" for="input-website<?php echo $language['language_id']; ?>"><?php echo $entry_website; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][website]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['website'] : ''; ?>" placeholder="<?php echo $entry_website; ?>" id="input-city<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_website[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_website[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <?php if(isset($merchant_description[$language["language_id"]]["zone_id"])){ $zoneid = $merchant_description[$language["language_id"]]["zone_id"];}else{ $zoneid = 0;}?>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-country<?php echo $language['language_id']; ?>"><?php echo $entry_country; ?></label>
                  <div class="col-sm-4">
                    <select name="merchant_description[<?php echo $language['language_id']; ?>][country_id]" id="input-country<?php echo $language['language_id']; ?>" onchange="country(this, '<?php echo $language["language_id"]; ?>', '<?php echo $zoneid;?>');" class="form-control">
                      <option value=""><?php echo $text_select; ?></option>
                      <?php foreach ($countries as $country) { ?>
                      <?php if ($country['country_id'] ==  $merchant_description[$language['language_id']]['country_id']) { ?>
                      <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    <?php if (isset($error_country[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_country[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                  <label class="col-sm-2 control-label" for="input-zone<?php echo $language['language_id']; ?>"><?php echo $entry_zone; ?></label>
                  <?php if(isset($merchant_description[$language["language_id"]]["city_id"])){ $cityid = $merchant_description[$language["language_id"]]["city_id"];}else{ $cityid = 0;}?>
                  <div class="col-sm-4">
                    <select  onChange="selectCity(this, '<?php echo $language["language_id"]; ?>', '<?php echo $zoneid;?>', '<?php echo $cityid;?>')"  name="merchant_description[<?php echo $language['language_id']; ?>][zone_id]" id="input-zone<?php echo $language['language_id']; ?>" class="form-control">
                    </select>
                    <?php if (isset($error_zone[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_zone[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-city<?php echo $language['language_id']; ?>"><?php echo $entry_city; ?></label>
                  <div class="col-sm-4">
                    <?php if(isset($merchant_description[$language["language_id"]]["location_id"])){ $location_id = $merchant_description[$language["language_id"]]["location_id"];}else{ $location_id = 0;}?>
                    <select   onChange="selectLocation(this, '<?php echo $language["language_id"]; ?>', '<?php echo $cityid;?>', '<?php echo $location_id;?>')"   name="merchant_description[<?php echo $language['language_id']; ?>][city_id]" id="input-city<?php echo $language['language_id']; ?>" class="form-control">
                    </select>
                    <?php if (isset($error_city[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_city[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                  <label class="col-sm-2 control-label" for="input-city<?php echo $language['language_id']; ?>"><?php echo $entry_location; ?></label>
                  <div class="col-sm-4">
                    <select  name="merchant_description[<?php echo $language['language_id']; ?>][location_id]" id="input-city<?php echo $language['language_id']; ?>" class="form-control">
                    </select>
                    <?php if (isset($error_city[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_city[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-zip<?php echo $language['language_id']; ?>"><?php echo $entry_zip; ?></label>
                  <div class="col-sm-4">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][zip]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['zip'] : ''; ?>" placeholder="<?php echo $entry_zip; ?>" id="input-zip<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_zip[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_zip[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                  <div class="col-sm-10">
                    <textarea name="merchant_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['description'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_terms; ?></label>
                  <div class="col-sm-10">
                    <textarea name="merchant_description[<?php echo $language['language_id']; ?>][terms]" placeholder="<?php echo $entry_terms; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['terms'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                  <div class="col-sm-4">
                    <textarea name="merchant_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                  </div>
                  <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                  <div class="col-sm-4">
                    <textarea name="merchant_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-tag<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_tag; ?>"><?php echo $entry_tag; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="merchant_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($merchant_description[$language['language_id']]) ? $merchant_description[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag<?php echo $language['language_id']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="tab-pane" id="tab-data">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-location-map"><?php echo $entry_capacity; ?></label>
              <div class="col-sm-3">
                <input type="text" name="capacity"    value="<?php echo $capacity; ?>" placeholder="<?php echo $entry_capacity; ?>" id="input-capacity" class="form-control" />
              </div>
              <label class="col-sm-2 control-label" for="input-location-map"><?php echo $entry_no_of_staff; ?></label>
              <div class="col-sm-3">
                <input type="text" name="no_of_staff"  value="<?php echo $no_of_staff; ?>" placeholder="<?php echo $entry_no_of_staff; ?>" id="input-no-of-staff" class="form-control" />
              </div>
            </div>
             <div class="form-group">
             <label class="col-sm-2 control-label" for="input-location-map">Price Level</label>
              <div class="col-sm-3">
              		<input type="text" name="price_level"  value="<?php echo $price_level; ?>" placeholder="<?php echo 'Price Level'; ?>" id="input-price-level" class="form-control" />
              </div>  
              <label class="col-sm-2 control-label" for="input-location-map">Rating</label>
              <div class="col-sm-3">
              		<input type="text" name="rating"  value="<?php echo $rating; ?>" placeholder="<?php echo 'Rating'; ?>" id="input-rating" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-location-map">Merchant Type</label>
              <div class="col-sm-3">
              <select name="merchant_type" class="form-control">
              	<option value="0" >Please Select A Merchant Profile</option>
                 <?php foreach ($entry_merchant_type as $key => $entry_merchant) { ?>
                 	<?php if($merchant_type == $key ){ ?>
                 	<option value="<?=$key?>" selected="selected"  ><?=$entry_merchant?></option>
                    <?php }else{?>
                    <option value="<?=$key?>" ><?=$entry_merchant?></option>
                    <?php }?>
                 <?php }?>
                 </select>
              </div>
               <label class="col-sm-2 control-label" for="input-spokenlanguage"><span data-toggle="tooltip" title="">Merchant Category</span></label>
              <div class="col-sm-2">
                <input type="text" name="mcategory" value="" placeholder="Merchant Category" id="input-mcategory" class="form-control" />
                <div id="merchant-mcategory" class="well well-sm" style="height: 100px; overflow: auto;">
                  <?php foreach ($merchant_mcategories as $merchant_mcategory) { ?>
                  <div id="merchant-mcategory<?php echo $merchant_mcategory['mcategory_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $merchant_mcategory['name']; ?>
                    <input type="hidden" name="merchant_mcategory[]" value="<?php echo $merchant_mcategory['mcategory_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>    
            </div> 
            
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-spokenlanguage"><span data-toggle="tooltip" title=""><?php echo $entry_spokenlanguage; ?></span></label>
              <div class="col-sm-2">
                <input type="text" name="spokenlanguage" value="" placeholder="<?php echo $entry_spokenlanguage; ?>" id="input-spokenlanguage" class="form-control" />
                <div id="merchant-spokenlanguage" class="well well-sm" style="height: 100px; overflow: auto;">
                  <?php foreach ($merchant_spokenlanguages as $merchant_spokenlanguage) { ?>
                  <div id="merchant-spokenlanguage<?php echo $merchant_spokenlanguage['spokenlanguage_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $merchant_spokenlanguage['name']; ?>
                    <input type="hidden" name="merchant_spokenlanguage[]" value="<?php echo $merchant_spokenlanguage['spokenlanguage_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <label class="col-sm-2 control-label" for="input-facilities"><span data-toggle="tooltip" title=""><?php echo $entry_facilities; ?></span></label>
              <div class="col-sm-2">
                <input type="text" name="facilities" value="" placeholder="<?php echo $entry_facilities; ?>" id="input-facilities" class="form-control" />
                <div id="merchant-facilities" class="well well-sm" style="height: 100px; overflow: auto;">
                  <?php foreach ($merchant_facilitiess as $merchant_facilities) { ?>
                  <div id="merchant-facilities<?php echo $merchant_facilities['facilities_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $merchant_facilities['name']; ?>
                    <input type="hidden" name="merchant_facilities[]" value="<?php echo $merchant_facilities['facilities_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <label class="col-sm-2 control-label" for="input-atmosphere"><span data-toggle="tooltip" title=""><?php echo $entry_atmosphere; ?></span></label>
              <div class="col-sm-2">
                <input type="text" name="atmosphere" value="" placeholder="<?php echo $entry_atmosphere; ?>" id="input-atmosphere" class="form-control" />
                <div id="merchant-atmosphere" class="well well-sm" style="height: 100px; overflow: auto;">
                  <?php foreach ($merchant_atmospheres as $merchant_atmosphere) { ?>
                  <div id="merchant-atmosphere<?php echo $merchant_atmosphere['atmosphere_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $merchant_atmosphere['name']; ?>
                    <input type="hidden" name="merchant_atmosphere[]" value="<?php echo $merchant_atmosphere['atmosphere_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-date-available"><?php echo $entry_opening_hours; ?></label>
              <div class="col-sm-3">
                <div class="input-group time">
                  <input type="text" name="from_opeining_hours" value="<?php echo $from_opeining_hours; ?>" placeholder="<?php echo $entry_opening_hours; ?>" data-date-format="" id="input-date-available" class="form-control" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <label class="col-sm-2 control-label" for="input-date-available"><?php echo $entry_opening_hours; ?></label>
              <div class="col-sm-3">
                <div class="input-group time">
                  <input type="text" name="to_opening_hours" value="<?php echo $to_opening_hours; ?>" placeholder="<?php echo $entry_opening_hours; ?>" data-date-format="" id="input-date-available" class="form-control" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
              <div class="col-sm-3">
                <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                <?php if ($error_keyword) { ?>
                <div class="text-danger"><?php echo $error_keyword; ?></div>
                <?php } ?>
              </div>
              <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
              <div class="col-sm-3">
                <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-date-available"><?php echo $entry_date_available; ?></label>
              <div class="col-sm-3">
                <div class="input-group date">
                  <input type="text" name="date_available" value="<?php echo $date_available; ?>" placeholder="<?php echo $entry_date_available; ?>" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
              <div class="col-sm-3">
                <select name="status" id="input-status" class="form-control">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-location-map"><?php echo $entry_location_map; ?></label>
              <div class="col-sm-3">
                <input type="text" name="location_map" id="us3-address" value="<?php echo $location_map; ?>" placeholder="<?php echo $entry_location_map; ?>" class="form-control" />
                <!-- <input type="text" class="form-control" id="us3-radius" /> -->
              </div>
              <!-- <div id="us3" style="width: 550px; height: 400px;"></div> -->
            </div>
            <div class="form-group">
            <div id="us3map" style="height:400px;"></div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-location-map"><?php echo $entry_latitude; ?></label>
              <div class="col-sm-3">
                <input type="text" name="latitude" id="us3-lat"  value="<?php echo $latitude; ?>" placeholder="<?php echo $entry_latitude; ?>"  class="form-control" />
              </div>
              <label class="col-sm-2 control-label" for="input-location-map"><?php echo $entry_longitude; ?></label>
              <div class="col-sm-3">
                <input type="text" name="longitude" id="us3-lon"  value="<?php echo $longitude; ?>" placeholder="<?php echo $entry_longitude; ?>" class="form-control" />
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-discount">
            <div class="form-group">
              <label for="input-date-available" class="col-sm-2 control-label">Booking Start Date</label>
              <div class="col-sm-2">
                <div class="input-group date">
                  <input type="text" class="form-control" id="input-date-available" data-date-format="YYYY-MM-DD" placeholder="Start Date" value="<?php echo $booking_start_date;?>" name="booking_start_date">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                   
                </div>
              </div>
              <label for="input-status" class="col-sm-2 control-label">Booking End Date</label>
              <div class="col-sm-2">
                <div class="input-group date">
                  <input type="text" class="form-control" id="input-date-available" data-date-format="YYYY-MM-DD" placeholder="End Date" value="<?php echo $booking_end_date;?>" name="booking_end_date">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
              </div>
              
                
              </div>
              
              
              <div class="form-group">
              <label for="input-date-available" class="col-sm-2 control-label">Average Discount Percentage</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" class="form-control" id="input-disc"   placeholder="Discount Percentage" value="<?php echo $avg_discount;?>" name="avg_discount">
                   
                   
                </div>
              </div>
              <label for="input-status" class="col-sm-2 control-label">Average No  of Seats</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" class="form-control" id="input-seats"    placeholder="Seats" value="<?php echo $avg_seats;?>" name="avg_seats">
                  
                </div>
              </div>
              
                
              </div>
              
              <!--<?php if(($merchant_id =='')){?>
              <button class="btn btn-primary"  id="discount-generate" title="" data-toggle="tooltip" form="form-merchnt" type="button" data-original-title="Discount Generate"><i class="fa fa-save"></i></button>
              <?php }?>-->
            
             
            <div class="table-responsive" style="height:1000px"> 
             
            
            <iframe src="<?=HTTP_CATALOG?>system/calender" width="100%" height="100%" scrolling="yes" style="overflow:hidden; margin-top:-4px; margin-left:-4px; border:none;"></iframe>

            </div>
          </div> 
          <div class="tab-pane" id="tab-image">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-left"><?php echo $entry_image; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-left"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" /></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-responsive">
              <table id="images" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-left"><?php echo $entry_additional_image; ?></td>
                    <td class="text-right"><?php echo $entry_sort_order; ?></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <?php $image_row = 0; ?>
                  <?php foreach ($merchant_images as $merchant_image) { ?>
                  <tr id="image-row<?php echo $image_row; ?>">
                    <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $merchant_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="merchant_image[<?php echo $image_row; ?>][image]" value="<?php echo $merchant_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                    <td class="text-right"><input type="text" name="merchant_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $merchant_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                    <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                  </tr>
                  <?php $image_row++; ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <?php $service_row = 0; ?>
          <div class="tab-pane" id="tab-services">
            <table id="services" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left"><?php echo $entry_services; ?></td>
                  <td class="text-left"><?php echo $entry_merchnt_desc; ?></td>
                  <td class="text-left"><?php echo $entry_duration; ?></td>
                  <td class="text-left"><?php echo $entry_price; ?></td>
                  <!--<td class="text-left"><?php echo $entry_disc; ?></td>-->
                  <td></td>
                </tr>
              </thead>
                <tbody>
              
              <?php if(isset($merchant_services)){ ?>
              <?php foreach ($merchant_services as $merchant_service) { ?>
              <tr id="service-row<?php echo $service_row; ?>">
                <td class="text-left"><select name="merchant_service[<?php echo $service_row;?>][service_id]" class="form-control">
                    <option value="0"><?php echo $text_select; ?></option>
                    <?php foreach($merchant_all_services as $merchant_all_service){ ?>
                    <?php if($merchant_service['product_id'] == $merchant_all_service["product_id"]){?>
                    <option selected value="<?php echo $merchant_all_service["product_id"]; ?>"><?php echo $merchant_all_service["name"]; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $merchant_all_service["product_id"]; ?>"><?php echo $merchant_all_service["name"]; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="text-right"><input type="text" name="merchant_service[<?php echo $service_row; ?>][product_desc]" value="<?php echo $merchant_service['product_desc']; ?>" placeholder="<?php echo $entry_merchnt_desc; ?>" class="form-control" /></td>
                <td class="text-right"><input type="text" name="merchant_service[<?php echo $service_row; ?>][duration]" value="<?php echo $merchant_service['duration']; ?>" placeholder="<?php echo $entry_duration; ?>" class="form-control" /></td>
                <td class="text-right"><input type="text" name="merchant_service[<?php echo $service_row; ?>][price]" value="<?php echo $merchant_service['price']; ?>" placeholder="<?php echo $entry_duration; ?>" class="form-control" /></td>
                
                <!--<td class="text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $service_row; ?>"> <i class="fa fa-search"></i> <?php echo $button_discount; ?> </button>
                  
                   
                  
                  <div class="modal fade" id="myModal<?php echo $service_row; ?>" tabindex="<?php echo $service_row; ?>" role="dialog" aria-labelledby="myModalLabel" >
                    <div class="modal-dialog" role="document" >
                      <div class="modal-content" style="height:800px;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Yield Management</h4>
                        </div>
                         <iframe src="http://localhost/riwigo/riwigo/system/calenderproduct/index.php?merchant_id=<?php echo $merchant_id; ?>&product_id=<?php echo $merchant_service['product_id']; ?>" width="100%" height="100%" scrolling="yes" style="overflow:hidden; margin-top:-4px; margin-left:-4px; border:none;"></iframe>
                      </div>
                    </div>
                  </div>
                  </td>-->
                  
                  
                <td class="text-left"><button type="button" onclick="$('#service-row<?php echo $service_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $service_row++; ?>
              <?php } ?>
              <?php } ?>
                </tbody>
              
              <tfoot>
                <tr>
                  <td colspan="2"></td>
                  <td class="text-left"><button type="button" onclick="addService();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="tab-pane" id="tab-links">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="<?php echo $help_related; ?>"><?php echo $entry_related; ?></span></label>
              <div class="col-sm-10">
                <input type="text" name="related" value="" placeholder="<?php echo $entry_related; ?>" id="input-related" class="form-control" />
                <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">

                  <?php foreach ($product_relateds as $product_related) {  ?>

                  <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                    <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-bm">
              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-location-map">Margin</label>
              <div class="col-sm-3">
                 <select name="margine_type" class="form-control">
              	<option value="0" >Please Select A Margine Type</option>
                 <?php foreach ($entry_margin as $key => $margin) { ?>
                 	<?php if($margine_type == $key ){ ?>
                 	<option value="<?=$key?>" selected="selected"  ><?=$margin?></option>
                    <?php }else{?>
                    <option value="<?=$key?>" ><?=$margin?></option>
                    <?php }?>
                 <?php }?>
                 </select>
              </div>
              
              <div class="col-sm-3">
                <input type="text" name="margin_value"  value="<?php echo $margin_value; ?>" placeholder="Margin Value" id="input-no-of-staff" class="form-control" />
              </div>
            </div>
            
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                	<td>Order Id</td>
                    <td>Booking Date</td>
                    <td>Customer</td>
                    <td>Service Name</td> 
                    <td>Disocunt Time</td>
                    <td>Persons</td>
                    <td>Duration</td>
                    <td>Total</td>
                    <td>Status</td>
                    <td>Margin Type</td>
                    <td>Margin Value</td>
                    <td>Margin Amount</td>
                </tr>
                </thead>
                <?php if ($merchant_orders) { ?>
                    <?php foreach ($merchant_orders as $merchant_order) { ?>
                    <tr>
                      <td class="text-center"><?=$merchant_order['order_id']?></td>
                      <td class="text-center"><?=$merchant_order['booking_date']?></td>
                      <td class="text-center"><?=$merchant_order['customer']?></td>
                      <td class="text-center"><?=$merchant_order['product_name']?></td>
                      <td class="text-center"><?=$merchant_order['disocuntTime']?></td>
                      <td class="text-center"><?=$merchant_order['persons']?></td>
                      <td class="text-center"><?=$merchant_order['duration']?></td>
                      <td class="text-center"><?=$merchant_order['total']?></td>
                      <td class="text-center"><?=$merchant_order['order_status']?></td>
                      <td class="text-center"><?=$merchant_order['margin_type']?></td>
                      <td class="text-center"><?=$merchant_order['margin_value']?></td>
                      <td class="text-center"><?=$merchant_order['margin_amt']?></td>
                      
                    </tr>
                    <?php }?>
                <?php }else{?>
                	<tr>
                  <td class="text-center" colspan="12">No Orders Found</td>
                </tr>
                <?php }?>
                
            </table> 
          </div>
          
        </div>
        </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#table-responsive').load('index.php?route=catalog/discountGenerate&token=<?php echo $token; ?>&booking_start_date=<?php echo $booking_start_date; ?>&booking_end_date=<?php echo $booking_end_date; ?>&merchant_id=<?php echo $merchant_id?>');

				$('#discount-generate').on('click', function() { //alert('hi');
				
					$.ajax({
						url: 'index.php?route=catalog/merchant/discountGenerate&token=<?php echo $token;?>&merchant_id=<?php echo $merchant_id?>' ,
						type: 'post',
						data: $('#tab-discount textarea, #tab-discount select, #tab-discount input[type=\'text\'],input[type=\'hidden\']'),
						dataType: 'json',
						crossDomain: true,
						beforeSend: function() {
							$('#discount').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
						  	//$('#button-history').button('load');          
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
										$('#calenderData').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
									}
				
									 if (json['success']) {
										$('#table-responsive').load('index.php?route=catalog/discountGenerate&token=<?php echo $token; ?>&booking_start_date='+json["booking_start_date"]+'&booking_end_date='+json["booking_end_date"]);
										
										//$('#calenderData').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						
										 
									}			
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				 	 
				});
				
				  //--></script>

          <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdKmDM320eweLxtgoVuSvj7Lmb8CIPYKE">
    </script>

          <script type="text/javascript">

          

              $( "#us3-address" ).mouseout(function() {
               
                //alert(address);
                //$( "#us3map" ).html(address);
                var geocoder = new google.maps.Geocoder();

                 var address = $(this).val();

                  geocoder.geocode( { 'address': address}, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                          var latitude = results[0].geometry.location.lat();
                          var longitude = results[0].geometry.location.lng();
                          //alert(latitude);
                          $.ajax({

                              url:'index.php?route=catalog/merchant/getGoogleMap&token=<?php echo $token;?>',
                              type:'get',
                              data:'lat='+latitude+'&long='+longitude,
                              success: function(data){
                                //console.log(data);
                                $("#us3map").html(data);
                                var us3lat = document.getElementById('us3-lat');
                                us3lat.value = latitude;
                                var us3lon = document.getElementById('us3-lon');
                                us3lon.value = longitude;
                               
                              },
                              error: function(){
                                console.log(error);
                              }

                          });
                        } 
                    }); 
            

              });

        


          </script>
          
<script type="text/javascript"><!--


				$('#next-calender').on('click', function() { //alert('hi');
				
					$.ajax({
						url: 'index.php?route=catalog/merchant/nextCalender&token=<?php echo $token;?>&merchant_id=<?php echo $merchant_id?>' ,
						type: 'post',
						data: $('#tab-discount textarea, #tab-discount select, #tab-discount input[type=\'text\'],input[type=\'hidden\']'),
						dataType: 'json',
						crossDomain: true,
						beforeSend: function() {
							$('#discount').prepend('<div id="preloader"><div id="status">&nbsp;</div></div>');
						  	//$('#button-history').button('load');          
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
										$('#calenderData').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
									}
				
									 if (json['success']) {
										$('#discount').load('index.php?route=catalog/nextcalender&token=<?php echo $token; ?>&merchant_id=<?php echo $merchant_id?>&end_date='+json["end_date"]);
										
										//$('#calenderData').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						
										$('input[name=\'next_date\']').val(json['next_date']);
										$('input[name=\'prev_date\']').val(json['prev_date']);
									}			
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				 	 
				});
				
				$('#prev-calender').on('click', function() { //alert('hi');
				
					$.ajax({
						url: 'index.php?route=catalog/merchant/prevCalender&token=<?php echo $token;?>&merchant_id=<?php echo $merchant_id?>' ,
						type: 'post',
						data: $('#tab-discount textarea, #tab-discount select, #tab-discount input[type=\'text\'],input[type=\'hidden\']'),
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
										$('#calenderData').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
									}
				
									 if (json['success']) {
										$('#discount').load('index.php?route=catalog/prevcalender&token=<?php echo $token; ?>&merchant_id=<?php echo $merchant_id?>&end_date='+json["end_date"]);
										
										//$('#calenderData').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						
										$('input[name=\'next_date\']').val(json['next_date']);
										$('input[name=\'prev_date\']').val(json['prev_date']);
									}			
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				 	 
				}); //--></script> 
<script type="text/javascript"><!--


				 
             
  function country(element, index, zone_id) {
    $.ajax({
            url: 'index.php?route=localisation/country/country&token=<?php echo $token; ?>&country_id=' + element.value,
            dataType: 'json',
            beforeSend: function() {
                    $('select[name=\'merchant_description['+index+'][country_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
                    $('.fa-spin').remove();
            },
            success: function(json) {
                if (json['postcode_required'] == '1') {
                    $('input[name=\'address[' + index + '][postcode]\']').parent().parent().addClass('required');
                } else {
                    $('input[name=\'address[' + index + '][postcode]\']').parent().parent().removeClass('required');
                }

                html = '<option value=""><?php echo $text_select; ?></option>';

                if (json['zone'] && json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option  value="' + json['zone'][i]['zone_id'] + '"';

                        if (json['zone'][i]['zone_id'] == zone_id) {
                                html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } else {
                        html += '<option value="0"><?php echo $text_none; ?></option>';
                }

                //$('select[name=\'address[' + index + '][zone_id]\']').html(html);
				$('select[name=\'merchant_description['+index+'][zone_id]\']').html(html);
				 
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
}

$('select[name$=\'[country_id]\']').trigger('change');



 function selectCity(element, index, zone_id,city_id){ //alert(zone_id);
	
	if(element.value == 0) {
		zone = zone_id;}else{zone=element.value;}
	
	$.ajax({
            url: 'index.php?route=localisation/city/city&token=<?php echo $token; ?>&zone_id=' + zone,
            dataType: 'json',
            beforeSend: function() {
                   $('select[name=\'merchant_description['+index+'][city_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
                    $('.fa-spin').remove();
            },
            success: function(json) {
                html = '<option value=""><?php echo $text_select; ?></option>';
				//alert(json['citys']);
                if (json['citys'] && json['citys'] != '') {
                    for (i = 0; i < json['citys'].length; i++) {
                        html += '<option  value="' + json['citys'][i]['city_id'] + '"';

                        if(json['citys'][i]['city_id'] == city_id) {
                               html += ' selected="selected"';
                        }

                        html += '>' + json['citys'][i]['name'] + '</option>';
                    }
                } else {
                        html += '<option value="0"><?php echo $text_none; ?></option>';
                }

                //$('select[name=\'address[' + index + '][zone_id]\']').html(html);
				$('select[name=\'merchant_description['+index+'][city_id]\']').html(html);
				 
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
		  
	}

$('select[name$=\'[zone_id]\']').trigger('change');




 function selectLocation(element, index, city_id,location_id){ //alert(zone_id);
	
	if(element.value == 0) {
		city_id = city_id;}else{city_id=element.value;}
	
	$.ajax({
            url: 'index.php?route=localisation/locationcity/location&token=<?php echo $token; ?>&city_id=' + city_id,
            dataType: 'json',
            beforeSend: function() {
                   $('select[name=\'merchant_description['+index+'][location_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
                    $('.fa-spin').remove();
            },
            success: function(json) {
                html = '<option value=""><?php echo $text_select; ?></option>';
				//alert(json['citys']);
                if (json['locations'] && json['locations'] != '') {
                    for (i = 0; i < json['locations'].length; i++) {
                        html += '<option  value="' + json['locations'][i]['location_id'] + '"';

                        if(json['locations'][i]['location_id'] == location_id) {
                               html += ' selected="selected"';
                        }

                        html += '>' + json['locations'][i]['name'] + '</option>';
                    }
                } else {
                        html += '<option value="0"><?php echo $text_none; ?></option>';
                }

                //$('select[name=\'address[' + index + '][zone_id]\']').html(html);
				$('select[name=\'merchant_description['+index+'][location_id]\']').html(html);
				 
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
		  
	}

$('select[name$=\'[city_id]\']').trigger('change');
</script> 
<script type="text/javascript"><!--
var service_row = <?php echo $service_row; ?>;

function addService() {
	html  = '<tr id="service-row' + service_row + '">';
	html += '  <td class="text-left">';
        html += '   <select name="merchant_service[' + service_row + '][service_id]" class="form-control">';
        html += '       <option value="0">'+'<?php echo $text_select; ?>'+'</option>';
        <?php foreach($merchant_all_services as $merchant_all_service){ ?>
            html += '       <option value="<?php echo $merchant_all_service["product_id"]; ?>">'+'<?php echo $merchant_all_service["name"]; ?>'+'</option>';
        <?php } ?>    
        html += '   </select>';
        html += '   </td>';
       
        html += '  <td class="text-left"><input type="text" name="merchant_service[' + service_row + '][product_desc]" value="" placeholder="<?php echo $entry_merchnt_desc; ?>" class="form-control" /></td>';
        html += '  <td class="text-left"><input type="text" name="merchant_service[' + service_row + '][duration]" value="" placeholder="<?php echo $entry_duration; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="merchant_service[' + service_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + service_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#services tbody').append(html);

	service_row++;
}
//--></script> 
<script type="text/javascript"><!--
function calcDiscount(index) { 

	var price =   $('input[name=\'price\']').val();
	
	var discPer =  $('input[name=\'merchant_discount[' + index + '][percentage]\']').val();
	
	var discountedPrice = price - (price * discPer) / 100; 
	
	$('input[name=\'merchant_discount[' + index + '][price]\']').val(discountedPrice) 
}

  
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tr id="discount-row' + discount_row + '">'; 
	
	 html += '  <td class="text-left" style="width: 13%;"><div class="input-group time"><input type="text" name="merchant_discount[' + discount_row + '][merchant_time]" value="" placeholder="" data-date-format="" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div>';
	html += '   <input type="text" name="merchant_discount[' + discount_row + '][sort_order]" value="" placeholder="" class="form-control" value="' + discount_row + '"  /></td>'; 
        html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][mon_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" />'; 
        	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][mon_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][tue_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][tue_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
   html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][wed_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][wed_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][thu_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][thu_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][fri_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][fri_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][sat_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][sat_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][sun_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="merchant_discount[' + discount_row + '][sun_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
 
	html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	
	html += '</tr>';
	
	html += '<script type="text/javascript">$(".time").datetimepicker({ pickDate: false, pickTime: true  });</script>';

	$('#discount tbody').append(html);

	$('.date').datetimepicker({
		pickTime: false
	});

	discount_row++;
}
//--></script> 
<script type="text/javascript"><!-- 
	 // Merhcant Category
	$('input[name=\'mcategory\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/merchant/autocompleteMcategory&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['mcategory_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'mcategory\']').val('');

		$('#merchant-mcategory' + item['value']).remove();

		$('#merchant-mcategory').append('<div id="merchant-mcategory' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="merchant_mcategory[]" value="' + item['value'] + '" /></div>');
	}
});

$('#merchant-spokenlanguage').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

	 // spokenlanguage
	$('input[name=\'spokenlanguage\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/merchant/autocompleteSpokenlanguage&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['spokenlanguage_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'spokenlanguage\']').val('');

		$('#merchant-spokenlanguage' + item['value']).remove();

		$('#merchant-spokenlanguage').append('<div id="merchant-spokenlanguage' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="merchant_spokenlanguage[]" value="' + item['value'] + '" /></div>');
	}
});

$('#merchant-spokenlanguage').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
 
// facilities
$('input[name=\'facilities\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/merchant/autocompleteFacilities&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['facilities_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'facilities\']').val('');

		$('#merchant-facilities' + item['value']).remove();

		$('#merchant-facilities').append('<div id="merchant-facilities' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="merchant_facilities[]" value="' + item['value'] + '" /></div>');
	}
});

$('#merchant-facilities').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
 
 // atmosphere
$('input[name=\'atmosphere\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/merchant/autocompleteAtmosphere&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['atmosphere_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'atmosphere\']').val('');

		$('#merchant-atmosphere' + item['value']).remove();

		$('#merchant-atmosphere').append('<div id="merchant-atmosphere' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="merchant_atmosphere[]" value="' + item['value'] + '" /></div>');
	}
});

$('#merchant-atmosphere').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Related
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/merchant/autocompleteServices&token=<?php echo $token; ?>&filter_merchant_id='+ <?=$merchant_id?>+'&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'related\']').val('');

		//$('#product-related' + item['value']).remove();

    //alert(item['value']);

		$('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="merchant_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="merchant_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script> 
<script type="text/javascript"><!-- 
   
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false,
	pickTime: true 
 
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>
</div>
<?php echo $footer; ?> 