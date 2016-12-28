<ul class="drop drop1">
  <li> <a href="#"><span id="selectCity"><?=$city_name?></span><i class="fa fa-caret-down" aria-hidden="true"></i></a>
    <?php if (count($citys) > 1) { ?>
    <ul class="level_before">
      <?php foreach ($citys as $mycity) { ?>
      <li onclick="changeCity('<?php echo $mycity['name'];?>','<?php echo $mycity['city_id'];?>','<?php echo $path;?>')"><a href="#" title="<?php echo $mycity['name'];?>"><img src="<?php echo $mycity['image'];?>"><?php echo $mycity['name'];?></a></li>
      <?php }?>
    </ul>
    <?php } ?>
  </li>
</ul>
<input type="hidden" name="city_id" value="" />
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
<script>
 
 function changeCity(name, city_id, path){
	$('#selectCity').html(name);
	$('input[name=\'city_id\']').val(city_id);
	//alert(city_id);
	 $.ajax({
            url: 'index.php?route=common/city/city&city_id=' + city_id +'&path='+path,
            dataType: 'json',
            beforeSend: function() {
                //$('select[name=\'merchant_description['+index+'][country_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            complete: function() {
               // $('.fa-spin').remove();
            },
            success: function(json) {
                  
				 if(json['success']==1){
					 
					 var url = '<?php echo $redirect; ?>';
					 var url = url.replace(/&amp;/g, "&");
                        $(location).attr('href',url);
					
				}
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
}

</script>