<?php require_once("includes/connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>SW Jobsheet</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<!-- Form PHP input -->
<?php
$company1 = $_POST['company'] ;
$contact1 = $_POST['contactperson'] ;
$date1 = $_POST['dateofworks'] ;
$timefrom1 = $_POST['from'] ;
$timeto1 = $_POST['to'] ;
$method1 = $_POST['method'] ;
$works1 = $_POST['workdone'] ;
?>

<body>
	<h2>Jobsheet Submitted</h2>

	<img src="images/logo.jpg">
	
	<div class="buttoncenter">
		<a class="button" href="ticket.php">New</a>
		<a class="button" href="login.php">Admin Login</a>
	</div>
	
	<div class="container">
		<header>Company</header>
			<ul>
				<?php echo $company1; ?>
			</ul>
		<header>Contact person</header>
			<ul>
				<?php echo $contact1; ?>
			</ul>
		<header>Date</header>
			<ul>
				<?php echo $date1; ?>
			</ul>
		<header>Time from</header>
			<ul>
				<?php echo $timefrom1; ?>
			</ul>
		<header>Time to</header>
			<ul>
				<?php echo $timeto1; ?>
			</ul>
		<header>Method</header>
			<ul>
				<?php echo $method1; ?>
			</ul>
		<header>Work details</header>
			<ul>
				<?php echo $works1; ?>
			</ul>
		<header>Signed by</header>
			<ul>
				
			</ul>
	</div>
</body>
</html>