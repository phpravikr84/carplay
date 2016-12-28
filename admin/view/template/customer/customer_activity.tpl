<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <td class="text-left"><?php echo $column_date_added; ?></td>
        <td class="text-left"><?php echo $column_key; ?></td>
        <td class="text-left"><?php echo $column_data; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php if ($activities) { ?>
      <?php foreach ($activities as $activity) { ?>
      <tr>
        <td class="text-left"><?php echo $activity['date_added']; ?></td>
        <td class="text-left"><?php echo $activity['key']; ?></td>
        <td class="text-left"><?php echo $activity['data']; ?></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td class="text-center" colspan="3"><?php echo $text_no_results; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
