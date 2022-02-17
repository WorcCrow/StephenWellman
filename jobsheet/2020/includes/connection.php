<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "jobsheet");
define("DB_PORT", "8889");

//Connect to Database.
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT);

//Test if connection.
if (mysqli_connect_errno()) {
	die("Database connection failed: " . 
mysqli_connect_error() . 
" (" . mysqli_connect_error() . ")" );
}
?>