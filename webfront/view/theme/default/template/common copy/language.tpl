<?php if (count($languages) > 1) { ?>

<div class="pull-left">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
    <div class="btn-group">
       
       
      <?php foreach ($languages as $language) {  $class = '';?>
       
       <?php if ($language['code'] == $code) { $class = 'bg_color'; } ?>
      
      <li><a href="javascript:(void);" class="<?=$class?>" title="<?php echo $language['name']; ?>"  onClick="langaugeChange('<?php echo $language['code']; ?>'), document.getElementById('form-language').submit();"><?php echo $language['name']; ?></a></li>
      
      <p class="slash">|</p>
      
      
      <?php   } ?>
    </div>
    <input type="hidden" name="code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  </form>
</div>
<?php } ?>

<script>
function langaugeChange(lang){
 	//alert(lang);
	$("input[name=code]").val(lang);
	//$( "form:form-language" ).submit();
}

</script>

<!--
<li><a href="javascript:(void);" title="TH" >TH</a></li>
          <p class="slash">|</p>
          <li><a href="javascript:(void);" title="EN" class="bg_color">EN</a></li>
          <p class="slash">|</p>
          <li><a href="javascript:(void);" title="JPN">JPN</a></li>
          <p class="slash">|</p>
          <li><a href="javascript:(void);" title="CN">CN</a></li>--> 
