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
$quantity = $_POST['datef'];
$item = $_POST['datet'];
date_default_timezone_set('Europe/Rome');

echo "<p>Result of Jobs Query effected on <strong>" . date("d-m-y G:i:s", time()) . "</strong></p>";
echo "<p><strong>You have selected from:  </strong>". $quantity . "<strong> to:   </strong>"  .  $item . ".</p>";

?>

<?php

$sql = "SELECT * from JobsheetRecord where date between '$quantity' and '$item'";

if (!mysql_query($sql)) {
	die('Error: ' . mysql.error());
}

$query = mysql_query($sql);

echo "<table border=1 width=600 style='border-collapse: collapse'>";
echo "<th>Job No</th><th>Client</th><th>Date</th><th>Time</th><th>Cost</th>";
while ($row = mysql_fetch_array($query))   
{  
$to_time = strtotime($row['Timein']);
	$from_time = strtotime($row['Timeout']);
	$time = round(abs($to_time - $from_time) /60,2);
	$time2 = round(abs($time) /60,2). " hrs";
	$client = $row['Client'];
	$rate = mysql_query("SELECT Rate FROM clients where Company = '$client'");
	$rate2 = mysql_result($rate,0);
	$euro = $time2*$rate2;


echo"<tr><td>".$row['ID']."</td>
<td>".$row['Client']."</td>
<td>".$row['Date']."</td>
<td>$time2</td>
<td>&euro; $euro</td></tr>";
}

echo "</table>";
?>  
<br>
<button type="button" onclick="window.print()">Print</button>
<button type="button" onclick="window.location.href='query.php'">New Query</button>

</body></html>