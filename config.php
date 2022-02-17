<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	
	//Specify root directory. This configuration are good for making multi project on the same server.
	$webroot = "/";
	$docroot = $_SERVER['DOCUMENT_ROOT'] . $webroot;
	
	/* +Database+ */
	//Authentication
	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'sw_database');
	/* -Database- */
	
	/* +Automail+ */
	//Authentication
	define('AM_HOST', 'smtp.gmail.com');
	define('AM_PORT', '587');
	define('AM_USERNAME', '********@gmail.com');
	define('AM_PASSWORD', '********');
	
	//Config
	define('AM_isMail', false);//true: Mail() - false: SMTP()
	define('AM_isHTML', true);//option(true/false)
	define('AM_DEBUG', false);//option(true/false)
	/* -Automail- */
	
	require($docroot . "include/dbcon.inc.php");
	require($docroot . "include/automail.inc.php");
	require($docroot . "include/phplib.inc.php");
	require($docroot . "include/globallib.inc.php");
	require($docroot . "include/datafilter.inc.php");
?>