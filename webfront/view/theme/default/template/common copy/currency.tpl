<?php if (count($currencies) > 1) { ?>
<div class="pull-left">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-currency">
  <div class="btn-group">
     
    <ul class="">
      <?php foreach ($currencies as $currency) { $class='';?>
       
        <?php if ($currency['code'] == $code) { $class = 'bg_color'; } ?>
      
      
       <li><a href="javascript:(void);" class="<?=$class?>" title="TH"  onClick="curancyChange('<?php echo $currency['code']; ?>'), document.getElementById('form-currency').submit();"><?php echo $currency['title']; ?></a></li>
      
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
<script>
function curancyChange(curancy){
 	
	$("input[name=code]").val(curancy); //alert(curancy);return false;
	//$( "form:form-language" ).submit();
}

</script>