<?php 

// Include the calendar class
include('includes/loader.php'); 

// Retrieve Current Page Data
$info = $calendar->retrieve($_GET['page']);

//print_r($info);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ajax Full Featured Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link href="css/fullcalendar.css" rel="stylesheet">
    <link href="lib/colorpicker/css/colorpicker.css" rel="stylesheet">
    <link href="lib/validation/css/validation.css" rel="stylesheet">
	
    <link href="lib/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet">
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

     
	
    <div class="container">
	  
      <a href="index.php?merchant_id=<?php echo $info['merchant_id']; ?>&product_id=<?php echo $info['product_id']; ?>" class="btn pull-right" style="margin-bottom: 20px;">View Events</a>
		
      <div class="clearfix"></div>
        
      <div class="box">
        <div class="header"><h4>Edit Event</h4></div>
        <div class="content pad"> 
            
            <form id="edit_event" method="post">
            
                <label style="display:none">Title:</label>
                <input type="hidden" class="validate[required] input-block-level" name="title_update" id="title_update" placeholder="Event Title" value="<?php echo $info['title']; ?>">
                <label style="display:none">Description:</label>
                <textarea style="display:none" class="input-block-level" name="description_update" id="description_update" placeholder="Event Description"><?php echo $info['description']; ?></textarea>
                <label  >Discount:</label>
                <input type="text" class="validate[required] input-block-level" name="discount" id="discount" placeholder="Discount" value="<?php echo $info['discount']; ?>">
                 <label>seats:</label>
                <input type="text" class="validate[required] input-block-level" name="seats" id="seats" placeholder="Discount" value="<?php echo $info['seats']; ?>">
                <div class="pull-left mr-10">
                <label>Start Date:</label>
                <input type="text" name="start_date" class="validate[required]" id="datepicker" value="<?php echo date('Y-m-d', strtotime($info['start'])); ?>">
                </div>
                <div class="pull-left">
                <label>Start Time:</label>
                <input type="text" class="input-small" name="start_time" placeholder="HH:MM" id="tp1" value="<?php echo date('H:i', strtotime($info['start'])); ?>">
                </div>
                <div class="clearfix"></div>
                <div class="pull-left mr-10">
                <label>End Date:</label>
                <input type="text" name="end_date" id="datepicker2" value="<?php echo date('Y-m-d', strtotime($info['end'])); ?>">
                </div>
                <div class="pull-left">
                <label>End Time:</label>
                <input type="text" class="input-small" name="end_time" placeholder="HH:MM" id="tp2" value="<?php echo date('H:i', strtotime($info['end'])); ?>">
                </div>
                <div class="clearfix"></div>
                
                <input type="hidden" id="rep_id" value="<?php echo $info['repeat_id']; ?>" />
                
    			<br />
                <a href="#" onclick="calendar.update(<?php echo $info['id']; ?>)" class="btn btn-primary">Save Changes</a>
                
            </form>
            
        </div> 
    </div>

    </div> <!-- /container -->
	
    <!-- Modal Delete Prompt -->
    <div id="cal_prompt" class="modal hide fade">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
        	<a href="#" class="btn btn-danger" data-option="remove-this">Delete this</a>
            <a href="#" class="btn btn-danger" data-option="remove-repetitives">Delete all</a>
        	<a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>
    
    <!-- Modal Edit Prompt -->
    <div id="cal_edit_prompt_save" class="modal hide fade">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body-custom"></div>
        <div class="modal-footer">
        	<a href="#" class="btn btn-info" data-option="save-this">Save this</a>
            <a href="#" class="btn btn-info" data-option="save-repetitives">Save all</a>
        	<a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>
    
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.calendar.js"></script>
    <script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="lib/validation/jquery.validationEngine.js"></script>
    <script src="lib/validation/jquery.validationEngine-en.js"></script>
    <script src="lib/timepicker/jquery-ui-sliderAccess.js"></script>
    <script src="lib/timepicker/jquery-ui-timepicker-addon.min.js"></script>
    <script src="js/custom.js"></script>
    
    <script type="text/javascript">
		$().FullCalendarExt({ version: 'php' });
	</script>

  </body>
</html>
