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

$image1 = mysql_query("select Signature FROM JobsheetRecord where id =(select max(id) from JobsheetRecord)");
$jbrecord = mysql_result($image1, 0);

echo '<img src= "data:image/jpeg;base64,' . base64_encode( $jbrecord ) . '" />';

//header('Content-Type: image/jpeg');
//echo $jbrecord;

?>