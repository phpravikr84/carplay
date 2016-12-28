<div class="row">
	<?php if ($warning) { ?>
	<div class="alert alert-warning"><i class="fa fa-check-circle"></i> <?php echo $warning; ?></div>
	<?php } ?>
  
	<!--<div class="social_login pull-right">-->
	<div class="social_login col-sm-12 col-sm-offset-3">
	<?php if($fbstatus){?>
	<a class="socalicon"  href="<?php echo $fblink; ?>">
	 <button type="button" id="button-fb-login" class="btn_fb" ng-click="submitted=true">login with facebook</button>
	</a>
	<?php } ?>
	<?php if($twitstatus){?>
	<a class="socalicon"  href="<?php echo $twitlink; ?>">
	<img  style="width:50%" class="img-responsive" src="<?php echo $twitimage; ?>" data-toggle="tooltip"   alt="<?php echo $twittertitle; ?>" title="<?php echo $twittertitle; ?>">
	</a>
	<?php } ?>
	<?php if($goglestatus){?>
	<a class="socalicon"  href="<?php echo $goglelink; ?>">
	                 <button type="button" class="btn_google" ng-click="submitted=true">login with Google+</button>
   </a>
	<?php } ?>
	<?php if($linkstatus){?>
	<a class="socalicon"  href="<?php echo $linkdinlink; ?>">
	<img style="width:50%" class="img-responsive" src="<?php echo $linkdinimage; ?>" data-toggle="tooltip"   alt="<?php echo $linkedintitle; ?>"   title="<?php echo $linkedintitle; ?>">
	</a>
	<?php } ?>
	</div>
</div>

<style>
.social_login{}
.socalicon{margin-right:10px;margin-bottom:10px;float:left}
</style>