<?php

define('DB_NAME', 'sw_database');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) {
	die('Can\'t user ' . DB_NAME . ':' . mysql_error());
}

$result = mysql_query("SELECT company FROM clients order by company");
?>