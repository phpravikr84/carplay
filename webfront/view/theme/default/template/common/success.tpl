<?php echo $header; ?>

<div class="container">
  <div class="row mar_top65">
    <div id="content" class="col-sm-12">
      <h1><?php echo $heading_title; ?></h1>
      <!-- <div class="login_section wid600">
        <div class="booking_col"> <img src="image/congrats.png" alt="confirm" title="confirm"> </div>
      </div> -->
      <?php echo $text_message; ?>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>