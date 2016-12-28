<div class="tile">
  <div class="tile-heading"><?php echo $heading_title; ?> <span class="pull-right">
    <?php if ($percentage > 0) { ?>
    <a href="<?php echo $order; ?>"><i class="fa fa-caret-up color1"></i></a>
    <?php } elseif ($percentage < 0) { ?>
    <a href="<?php echo $order; ?>"><i class="fa fa-caret-down color1"></i></a>
    <?php } ?>
    <!--<?php echo $percentage; ?>%</span>--></div>
  <div class="tile-body"><a href="<?php echo $order; ?>"><i class="fa fa-shopping-cart color1"></i></a>
    <h2 class="pull-right"><a href="<?php echo $order; ?>"><?php echo $total; ?></a></h2>
  </div>
  <!--<div class="tile-footer"><a href="<?php echo $order; ?>"><?php echo $text_view; ?></a></div>-->
</div>s