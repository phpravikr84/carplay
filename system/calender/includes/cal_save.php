<?php

	// Loader - class and connection
	include('loader.php');
	
	// Catch start, end and id from javascript
	$title = $_POST['title'];
	$description = $_POST['description'];
	$start_date = $_POST['start_date'];
	$start_time = $_POST['start_time'];
	$end_date = $_POST['end_date'];
	$end_time = $_POST['end_time'];
	$color = $_POST['color'];
	$allDay = $_POST['allDay'];
	$url = $_POST['url'];
	$discount = $_POST['discount'];
	$seats = $_POST['seats'];
	
	$extra = array('repeat_method' => $_POST['repeat_method'], 'repeat_times' => $_POST['repeat_times']);
	
	// All Day Fix
	if($allDay == 'true')
	{
		$allDay = 'false';
	} else {
		$allDay = 'true';	
	}
	
	if(empty($url)) 
	{
		$url = "?page=";
	}
	
	echo $calendar->addEvent($title, $description, $start_date, $start_time, $end_date, $end_time, $color, $allDay, $url, $extra,$discount,$seats);
	

?>