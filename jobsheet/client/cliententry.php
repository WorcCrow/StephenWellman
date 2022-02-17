<style type="text/css">
body,td,th {
	font-family: "Century Gothic";
	font-size: 4mm;
}
</style>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
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

$company2 = $_POST['company'];
$representative2 = $_POST['representative'];
$email2 = $_POST['email'];
$telephone2 = $_POST['telephone'];
$location2 = $_POST['location'];
$rate2 = $_POST['rate'];

$sql = "INSERT INTO clients (company, representative, email, telephone, location, rate)VALUES('$company2', '$representative2', '$email2', '$telephone2', '$location2', '$rate2')";

if (!mysql_query($sql)) {
	die('Error: ' . mysql.error());	
}

echo $company2 . " added successfully at a rate of €" . $rate2;

mysql_close();
?> 
<br><button type="button" onclick="window.print()">Print</button>
<button type="button" onclick="window.location.href='/sign/examples/client.php'">New Entry</button>