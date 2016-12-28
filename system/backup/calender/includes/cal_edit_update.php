<?php

	// Loader - class and connection
	include('loader.php');
	
	//print_r($_POST);exit;

	// Catch post data from edit modal form
	$event = array(
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'color' => $_POST['color'],
		'start_date' => $_POST['start_date'],
		'start_time' => $_POST['start_time'],
		'end_date' => $_POST['end_date'],
		'end_time' => $_POST['end_time'],
		'discount' => $_POST['discount'],
		'seats' => $_POST['seats']
	);
	
	if(isset($_POST['url'])) 
	{
		$event['url'] = $_POST['url'];
	} else {
		$event['url'] = '?page=';	
	}
	
	if(isset($_POST['rep_id']) && isset($_POST['method']) && $_POST['method'] == 'repetitive_event')
	{
		$event['rep_id'] = $_POST['rep_id'];	
	}
	
	if($calendar->updates($event) === true) {
		return true;	
	} else {
		return false;	
	}

?>