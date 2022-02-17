<img src="swnew.jpg"/>
<?php
//error_reporting(E_ALL ^ E_DEPRECATED);

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

$client = $_POST['client2'];
$contact = $_POST['cont'];
$date = $_POST['date'];
$timein = $_POST['timein'];
$timeout = $_POST['timeout'];
$job = $_POST['job'];
$json = $_POST['output'];

require_once 'signature-to-image.php';
$img = sigJsonToImage($json);
ob_start();
imagejpeg($img);
$image = ob_get_contents();
ob_end_clean();
$image = addslashes($image);

$sql = "INSERT INTO JobsheetRecord (Client, Contact, Date, Timein, Timeout, Job, Signature)VALUES('$client', '$contact', '$date', '$timein', '$timeout', '$job', '$image')";

if (!mysql_query($sql)) {
	die('Error: ' . mysql.error());	
}
imagedestroy($img);

$number = "SELECT id FROM JobsheetRecord where id= (select max(id) from JobsheetRecord)";
$image1 = mysql_query("select Signature FROM JobsheetRecord where id =(select max(id) from JobsheetRecord)");

if (!mysql_query($number)) {
	die('Error: ' . mysql.error());
}

$jbnum = mysql_query($number);
$jbrecord = mysql_result($jbnum, 0);

$fimage = mysql_result($image1, 0);

$to_time = strtotime("$timein");
$from_time = strtotime("$timeout");
$time = round(abs($to_time - $from_time) /60,2);
$time2 = round(abs($time) /60,2). " hrs";

echo "<br>";
echo "<strong>Jobsheet: </strong> " . $jbrecord;
echo "<br>";
echo "<strong>Client: </strong> " . $client;
echo "<br>";
echo "<strong>Date: </strong> " . $date;
echo "<br>";
echo "<strong>From (Time): </strong> " . $timein;
echo "<br>";
echo "<strong>To (Time): </strong> " . $timeout;
echo "<br>";
echo "";
echo "<br>";
echo "<strong>Total Time: </strong>" . $time2;
echo "<br>";
echo "<strong>Work done: </strong> " . $job;
echo "<br>"; 
echo "";
echo "<br>";
echo "<strong>Authorised by</strong> " . $contact;
echo "<br>";
echo '<img src="data:image/jpeg;base64,' . base64_encode( $fimage ) . '" />';

include 'emailsent2.php';
?>	
<p>

<a href="/sign/examples/job.php" class='pad'>New Entry</a>
</p>
