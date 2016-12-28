<div class="tile">
  <div class="tile-heading"><?php echo $heading_title; ?>
    <?php if ($percentage > 0) { ?>
    <i class="fa fa-caret-up color1"></i>
    <?php } elseif ($percentage < 0) { ?>
    <i class="fa fa-caret-down color1"></i>
    <?php } ?>
    <!--<?php echo $percentage; ?>% </span>--></div>
  <div class="tile-body"><a href="<?php echo $sale; ?>"><i class="fa fa-line-chart color2"></i></a>
    <h2 class="pull-right"><a href="<?php echo $sale; ?>"><?php  echo $total; ?></a></h2>
  </div>
  <!--<div class="tile-footer"><a href="<?php echo $sale; ?>"><?php echo $text_view; ?></a></div>-->
</div>
