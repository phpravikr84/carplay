<div class="tile">
  <div class="tile-heading"><?php echo $heading_title; ?> <span class="pull-right">
    <?php if ($percentage > 0) { ?>
    <i class="fa fa-caret-up"></i>
    <?php } elseif ($percentage < 0) { ?>
    <i class="fa fa-caret-down"></i>
    <?php } ?>
    <!--<?php echo $percentage; ?>%</span>--></div>
  <div class="tile-body"><a href="<?php echo $customer; ?>"><i class="fa fa-user color3"></i></a>
    <h2 class="pull-right"><a href="<?php echo $customer; ?>"><?php echo $total; ?></a></h2>
  </div>
  <!--<div class="tile-footer"><a href="<?php echo $customer; ?>"><?php echo $text_view; ?></a></div>-->
</div>
