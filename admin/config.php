<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTP_CATALOG', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HTTP_CATALOG_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/image/');

// HTTPS
define('HTTPS_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTPS_CATALOG', 'http://'.$_SERVER['HTTP_HOST'].'/');

// DIR
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'');
define('DIR_APPLICATION', DOCUMENT_ROOT.'/admin/');
define('DIR_IMAGEDIR', DOCUMENT_ROOT.'/image/catalog/');
define('DIR_SYSTEM', DOCUMENT_ROOT.'/system/');
define('DIR_LANGUAGE', DOCUMENT_ROOT.'/admin/language/');
define('DIR_TEMPLATE', DOCUMENT_ROOT.'/admin/view/template/');
define('DIR_CONFIG', DOCUMENT_ROOT.'/system/config/');
define('DIR_IMAGE', DOCUMENT_ROOT.'/image/');

define('DIR_CACHE', DOCUMENT_ROOT.'/system/storage/cache/');
define('DIR_DOWNLOAD', DOCUMENT_ROOT.'/system/download/');
define('DIR_UPLOAD', DOCUMENT_ROOT.'/system/upload/');
define('DIR_LOGS', DOCUMENT_ROOT.'/system/storage/logs/');
define('DIR_MODIFICATION', DOCUMENT_ROOT.'/system/modification/');
define('DIR_CATALOG', DOCUMENT_ROOT.'/catalog/');


// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', $_SERVER['RDS_HOSTNAME']);
define('DB_USERNAME', $_SERVER['RDS_USERNAME']);
define('DB_PASSWORD', $_SERVER['RDS_PASSWORD']);
define('DB_DATABASE', $_SERVER['RDS_DB_NAME']);
define('DB_PORT', $_SERVER['RDS_PORT']);
define('DB_PREFIX', 'et_');
