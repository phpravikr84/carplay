<?php 

// Include the calendar class
include('includes/loader.php'); 

// Retrieve Current Page Data
$info = $calendar->retrieve($_GET['page']);

if(!isset($info['id']))
{
	header('Location: index.php');
	exit();	
}

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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

     

    <div class="container">
		
    <div class="span2"></div>
    <div class="span8">
        <div class="table-bordered" style="border: 1px solid #ddd; padding: 10px;">
        	
             <a href="index.php?merchant_id=<?php echo $info['merchant_id']?>" class="pull-right" style="margin-bottom: 20px;">Back to Events</a>
            
            <h3><?php echo ucfirst($info['title']); ?></h3>
            <p>
            	<span class="label">Event Start:</span> <?php echo date('d/m/Y H:i', strtotime($info['start'])); ?> <br />
            	<span class="label">Event End:</span> <?php echo date('d/m/Y H:i', strtotime($info['end'])); ?>
            </p>
            <p><?php echo $embed->oembed($formater->html_format($info['description'])); ?></p>
        	
            <input type="hidden" id="rep_id" value="<?php echo $info['repeat_id']; ?>" />

            <a href="#" class="pull-right" onclick="calendar.remove(<?php echo $info['id']; ?>)">Delete This Event</a>
    		<a href="edit_event.php?page=<?php echo $_GET['page']; ?>" class="pull-right mr-10">Edit This Event</a>
            
            <div class="clearfix"></div>
            	
        </div>
    </div>
    <div class="span2"></div>

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
	
    <script type="text/javascript">
		$().FullCalendarExt({ version: 'php' });
	</script>
    
  </body>
</html>
