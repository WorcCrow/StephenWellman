<?php

define('DB_NAME', 'jobsheet');
define('DB_USER', 'jobsheet');
define('DB_PASSWORD', 'We!!man8');
define('DB_HOST', 'ahsmaltacom.ipagemysql.com');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD); 

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) {
	die('Can\'t user ' . DB_NAME . ':' . mysql_error());
}

$sql = "SELECT signature FROM JobsheetRecord WHERE id= (select max(id) from JobsheetRecord)";

if (!mysql_query($sql)) {
	die('Error: ' . mysql.error());
}

$result = mysql_query("$sql");
$photo = mysql_result($result, 0);
require_once 'signature-to-image.php';
$img = sigJsonToImage($photo);

header('Content-Type: image/png');
imagepng($img);
//$result = mysql_query("$sql");

//echo mysql_result($result, 0);
mysql_close();
?> 