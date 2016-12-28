<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
          <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          <li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li> 
          <li><a href="#tab-discount" data-toggle="tab"><?php echo $tab_discount; ?></a></li>
          <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
          <li><a href="#tab-reward" data-toggle="tab"><?php echo $tab_reward; ?></a></li>
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
                    <input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_name[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                  <div class="col-sm-10">
                    <textarea name="product_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="product_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                  <div class="col-sm-10">
                    <textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                  <div class="col-sm-10">
                    <textarea name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-tag<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_tag; ?>"><?php echo $entry_tag; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : ''; ?>" placeholder="<?php echo $entry_tag; ?>" id="input-tag<?php echo $language['language_id']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="tab-pane" id="tab-data">
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-minute"><?php echo $entry_minute; ?></label>
              <div class="col-sm-10">
                <input type="text" name="minute" value="<?php echo $minute; ?>" placeholder="<?php echo $entry_minute; ?>" id="input-minute" class="form-control" />
                <?php if ($error_minute) { ?>
                <div class="text-danger"><?php echo $error_minute; ?></div>
                <?php } ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_merchant; ?></label>
              <div class="col-sm-10">
                <select name="merchant_id" id="input-status" class="form-control">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($merchants as $merchant) { ?>
                  <?php if ($merchant['merchant_id'] == $merchant_id) { ?>
                  <option value="<?php echo $merchant['merchant_id']; ?>" selected="selected"><?php echo $merchant['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $merchant['merchant_id']; ?>"><?php echo $merchant['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
              <div class="col-sm-10">
                <input type="text" name="price" value="<?php echo $price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
              <div class="col-sm-10">
                <select name="tax_class_id" id="input-tax-class" class="form-control">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
              <div class="col-sm-10">
                <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                <?php if ($error_keyword) { ?>
                <div class="text-danger"><?php echo $error_keyword; ?></div>
                <?php } ?>
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
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
              <div class="col-sm-10">
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
              <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
              <div class="col-sm-10">
                <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-links">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
              <div class="col-sm-10">
                <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                  <?php foreach ($product_categories as $product_category) { ?>
                  <div id="product-category<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
                    <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="<?php echo $help_related; ?>"><?php echo $entry_related; ?></span></label>
              <div class="col-sm-10">
                <input type="text" name="related" value="" placeholder="<?php echo $entry_related; ?>" id="input-related" class="form-control" />
                <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                  <?php foreach ($product_relateds as $product_related) { ?>
                  <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                    <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div> 
          <div class="tab-pane" id="tab-discount">
            	<div class="table-responsive">
              		<table id="discount" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-center" >Time</td>
                    <td class="text-center" colspan="2">Monday</td>
                    <td class="text-center" colspan="2">Tuesday</td>
                    <td class="text-center" colspan="2">Wednesday</td> 
                    <td class="text-center" colspan="2">Thursday</td> 
                    <td class="text-center" colspan="2">Friday</td> 
                    <td class="text-center" colspan="2">Saturday</td>   
                    <td class="text-center" colspan="2">Sunday</td>   
                  </tr>
                  <tr>
                   <td class="text-left">Time</td>
                   
                    <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td> 
                    
                    <td class="text-right"><?php echo $entry_disc_per; ?></td> 
                    <td class="text-left">Seat</td>
                    
                    <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td>
                    
                    <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td>
                    
                     <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td>
                   
                    <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td>
                    
                    <td class="text-right"><?php echo $entry_disc_per; ?></td>
                    <td class="text-left">Seat</td> 
                     
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php $discount_row = 0; ?>
                  <?php foreach ($product_discounts as $product_discount) { ?>
                  <tr id="discount-row<?php echo $discount_row; ?>">
                    
                    <td class="text-left" style="width: 12%;"><div class="input-group time">
                        <input type="text" name="product_discount[<?php echo $discount_row; ?>][product_time]" value="<?php echo  $product_discount['product_time']; ?>" placeholder="Time" data-date-format="" class="form-control" />
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span></div></td>
                        
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][mon_percentage]" value="<?php echo $product_discount['mon_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][mon_packs]" value="<?php echo $product_discount['mon_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td>
                  
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][tue_percentage]" value="<?php echo $product_discount['tue_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][tue_packs]" value="<?php echo $product_discount['tue_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td>
                   
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][wed_percentage]" value="<?php echo $product_discount['wed_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][wed_packs]" value="<?php echo $product_discount['wed_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td>  
                    
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][thu_percentage]" value="<?php echo $product_discount['thu_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][thu_packs]" value="<?php echo $product_discount['thu_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td> 
                    
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][fri_percentage]" value="<?php echo $product_discount['fri_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][fri_packs]" value="<?php echo $product_discount['fri_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td> 
                    
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][sat_percentage]" value="<?php echo $product_discount['sat_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][sat_packs]" value="<?php echo $product_discount['sat_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td> 
                    
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][sun_percentage]" value="<?php echo $product_discount['sun_percentage']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
                    <td class="text-right"><input type="text" name="product_discount[<?php echo $discount_row; ?>][sun_packs]" value="<?php echo $product_discount['sun_packs']; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control"  onchange="calcDiscount(<?php echo $discount_row; ?>)"/></td> 
                    
                    <td class="text-left"><button type="button" onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    
                  </tr>
                  <?php $discount_row++; ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="15"></td>
                    <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="<?php echo $button_discount_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                  </tr>
                </tfoot>
              </table>
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
                  <?php foreach ($product_images as $product_image) { ?>
                  <tr id="image-row<?php echo $image_row; ?>">
                    <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $product_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                      <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                    <td class="text-right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
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
          <div class="tab-pane" id="tab-reward">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-points"><span data-toggle="tooltip" title="<?php echo $help_points; ?>"><?php echo $entry_points; ?></span></label>
              <div class="col-sm-10">
                <input type="text" name="points" value="<?php echo $points; ?>" placeholder="<?php echo $entry_points; ?>" id="input-points" class="form-control" />
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-left"><?php echo $entry_customer_group; ?></td>
                    <td class="text-right"><?php echo $entry_reward; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($customer_groups as $customer_group) { ?>
                  <tr>
                    <td class="text-left"><?php echo $customer_group['name']; ?></td>
                    <td class="text-right"><input type="text" name="product_reward[<?php echo $customer_group['customer_group_id']; ?>][points]" value="<?php echo isset($product_reward[$customer_group['customer_group_id']]) ? $product_reward[$customer_group['customer_group_id']]['points'] : ''; ?>" class="form-control" /></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function calcDiscount(index) { 

	var price =   $('input[name=\'price\']').val();
	
	var discPer =  $('input[name=\'product_discount[' + index + '][percentage]\']').val();
	
	var discountedPrice = price - (price * discPer) / 100; 
	
	$('input[name=\'product_discount[' + index + '][price]\']').val(discountedPrice) 
}

  
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tr id="discount-row' + discount_row + '">'; 
	
	 html += '  <td class="text-left" style="width: 13%;"><div class="input-group time"><input type="text" name="product_discount[' + discount_row + '][merchant_time]" value="" placeholder="" data-date-format="" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	
    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][mon_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][mon_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][tue_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][tue_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
   html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][wed_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][wed_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][thu_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][thu_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][fri_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][fri_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][sat_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][sat_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][sun_percentage]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" onchange="calcDiscount(' + discount_row + ')" /></td>'; 
	
	html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][sun_packs]" value="" placeholder="<?php echo $entry_disc_per; ?>" class="form-control"/></td>';
 
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
 

// Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');

		$('#product-category' + item['value']).remove();

		$('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
}); 

// Related
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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

		$('#product-related' + item['value']).remove();

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
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
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
	pickDate: false,
	pickTime: true 
 
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
</div>
<?php echo $footer; ?> 