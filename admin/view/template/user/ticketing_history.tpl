<legend>&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"></i>History Comments</legend>
<table class="table table-bordered">
  <thead>
    <tr>
      <td class="text-left">User</td>
      <td class="text-left"><?php echo $column_date_added; ?></td>
      <td class="text-left">Subject</td>
      <td class="text-left">Comment</td>
      <td class="text-left"><?php echo $column_status; ?></td>
     
    </tr>
  </thead>
  <tbody>
    <?php if ($histories) { ?>
    <?php foreach ($histories as $history) { ?>
    <tr>
      <td class="text-left"><?php echo $history['user_id']; ?></td>
      <td class="text-left"><?php echo $history['date_added']; ?></td>
      <td class="text-left"><?php echo $history['subject']; ?></td>
      <td class="text-left"><?php echo $history['message']; ?></td>
      <td class="text-left"><?php echo $history['status']; ?></td>
      
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
