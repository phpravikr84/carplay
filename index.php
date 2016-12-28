<?php
// Version
//define('VERSION', '2.2.0.0');
define('VERSION', '2.2.0.0');

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);	


// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');
	
$application_config = 'webfront';

// Application
require_once(DIR_SYSTEM . 'framework.php');

