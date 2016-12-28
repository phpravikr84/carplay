<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HTTP_SERVER_ADMIN', 'http://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTP_IMAGE', HTTP_SERVER.'/image/');


// HTTPS
define('HTTPS_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/');

// DIR
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'');
define('DIR_APPLICATION', DOCUMENT_ROOT.'/webfront/');
define('DIR_SYSTEM', DOCUMENT_ROOT.'/system/');
define('DIR_LANGUAGE', DOCUMENT_ROOT.'/webfront/language/');
define('DIR_TEMPLATE', DOCUMENT_ROOT.'/webfront/view/theme/');
define('DIR_CONFIG', DOCUMENT_ROOT.'/system/config/');
define('DIR_IMAGE', DOCUMENT_ROOT.'/image/');
define('DIR_CACHE', DOCUMENT_ROOT.'/system/storage/cache/');
define('DIR_DOWNLOAD', DOCUMENT_ROOT.'/system/download/');
define('DIR_UPLOAD', DOCUMENT_ROOT.'/system/upload/');
define('DIR_MODIFICATION', DOCUMENT_ROOT.'/system/modification/');
define('DIR_LOGS', DOCUMENT_ROOT.'/system/storage/logs/');


// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', $_SERVER['RDS_HOSTNAME']);
define('DB_USERNAME', $_SERVER['RDS_USERNAME']);
define('DB_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('DB_DATABASE', $_SERVER['RDS_DB_NAME']);
define('DB_PORT', $_SERVER['RDS_PORT']);
define('DB_PREFIX', 'et_');
date_default_timezone_set("Asia/Bangkok"); 
//santanu D sabata


//Ravi added for Payment Gateway
//start session in all pages
 if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  //if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above
// sandbox or live
define('PPL_MODE', 'sandbox');

if(PPL_MODE=='sandbox'){
		
define('PPL_API_USER', 'riwigosolutions_api3.gmail.com');
define('PPL_API_PASSWORD', 'VQPEZU4CJA9NBPCF');
define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A7CuC29rAeseBlMJvPpHV-.c4M30');
			}
else{
define('PPL_API_USER', 'somepaypal_api.yahoo.co.uk');
define('PPL_API_PASSWORD', '123456789');
define('PPL_API_SIGNATURE', 'opupouopupo987kkkhkixlksjewNyJ2pEq.Gufar');
					}
define('PPL_LANG', 'EN');
	
define('PPL_LOGO_IMG', 'http://dev.riwigo.com/image/logo.png');
define('PPL_RETURN_URL', HTTP_SERVER.'index.php?route=checkout/confirm/confirmOrderPaypalExpress');
define('PPL_CANCEL_URL', HTTP_SERVER.'index.php?route=checkout/failure');
define('PPL_CURRENCY_CODE', 'THB');
//END
