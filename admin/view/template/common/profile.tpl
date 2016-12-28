<!-- menu profile quick info -->
<div class="profile" id="profile">
  <div class="profile_pic">
    <?php if ($image) { ?>
    <img src="<?php echo $image; ?>" alt="<?php echo $firstname; ?> <?php echo $lastname; ?>" title="<?php echo $username; ?>" class="img-circle profile_img"  />
    <?php } else { ?>
    <i class="fa fa-user"></i>
    <?php } ?>
  </div>
  <div class="profile_info"> <span>Welcome,</span>
    <h2><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
  </div>
</div>
<!-- /menu profile quick info --> 
