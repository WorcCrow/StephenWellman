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

$result = mysql_query("SELECT company FROM clients");
?>

<form action="namesearch2.php" method="post">
   Name of Book
   <SELECT NAME=name>
      <OPTION VALUE=0>Choose
      <?php  
      while($row = mysql_fetch_array($result))
     {
      $bookselect=$row["company"];
      echo "<OPTION VALUE=\"$bookselect\">".$bookselect.'</option>';
      }
     ?>


   </SELECT>
   <input type="submit">
</form>