<style type="text/css">
body,td,th {
	font-family: "Century Gothic";
	font-size: 4mm;
}
</style>
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
?>
<html><body>
<a href="/index.html"><img src="swnew.jpg" alt="Logo" width="164" height="82" align="middle"/></a>
<?php
$quantity = $_POST['idnum'];
date_default_timezone_set('Europe/Rome');

echo "<p>Result of Jobs Query effected on <strong>" . date("d-m-y G:i:s", time()) . "</strong></p>";
echo "<p><strong>You have selected Jobsheet number:  </strong>". $quantity . "</p>";

?>
</body></html>
<?php

$sql = "SELECT * from JobsheetRecord where ID = '$quantity'";

if (!mysql_query($sql)) {
	die('Error: ' . mysql.error());
}
$query = mysql_query($sql);
while($row = mysql_fetch_array($query)){
$to_time = strtotime($row['Timein']);
$from_time = strtotime($row['Timeout']);
$time = round(abs($to_time - $from_time) /60,2);
$time2 = round(abs($time) /60,2). " hrs";

echo "<br>";
echo "<strong>Jobsheet: </strong> " . $row['ID'];
echo "<br>";
echo "<strong>Client: </strong> " . $row['Client'];
echo "<br>";
echo "<strong>Date: </strong> " . $row['Date'];
echo "<br>";
echo "";
echo "<br>";
echo "<strong>From (Time): </strong> " . $row['Timein'];
echo "<br>";
echo "<strong>To (Time): </strong> " . $row['Timeout'];
echo "<br>";
echo "";
echo "<br>";
echo "<strong>Total Time: </strong>" . $time2;
echo "<br>";
echo "<strong>Work done: </strong> " . $row['Job'];
echo "<br>"; 
echo "";
echo "<br>";
echo "<strong>Authorised by</strong> " . $row['Contact'];
echo "<br>";
echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['Signature'] ) . '" />';
}

?>
<p><button type="button" onclick="window.print()">Print</button>
<button type="button" onclick="window.location.href='qjobsheet.php'">New Jobsheet</button></p>