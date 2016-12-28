<?php
	
	// Database Connection
	include('connection.php');
	
	// Calendar Class
	include('calendar.php');
	
	// Embed Class
	include('embed.php');
	
	// Formater Class
	include('formater.php');
	
	//print $_REQUEST['merchant_id'].'santanu';exit;
	
	// Starts the Calendar Class @params 'DB Server', 'DB Username', 'DB Password', 'DB Name', 'Table Name'
	$calendar = new calendar(DB_HOST, DB_USERNAME, DB_PASSWORD, DATABASE, TABLE, WHERE_CONDITION);
	
?>