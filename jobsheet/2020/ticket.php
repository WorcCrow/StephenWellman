<!DOCTYPE html>
<html>
<head>

	<title>SW Jobsheet</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	
</head>
<body>
	<h2>New Jobsheet</h2>

	<img src="images/logo.jpg">
	
	<div class="buttoncenter">
		<a class="button" href="index.php">Home</a>
		<a class="button" href="login.php">Admin Login</a>
	</div>

	<div class="container">
		<form class="ticketform" action="ticketsubmitted.php" method="post">
		<div class="formheadings">
			<label>Company</label>
			<select name="company">
				<option value="No company selected">Select Company</option>
				<option value="Wellman">Wellman</option>
			</select>
		</div>
		<div class="formheadings">
			<label>Contact person</label>
			<input type="text" name="contactperson">
		</div>
		<div class="formheadings">
			<label>Date</label>
			<input type="Date" name="dateofworks" min="today">
		</div>
		<div class="formheadings">
			<label>Time from</label>
			<input type="Time" name="from">
		</div>
		<div class="formheadings">
			<label>Time to</label>
			<input type="Time" name="to">
		</div>
		<div class="formheadings">
			<label>Method</label>
			<select name="method">
				<option value="Remote">Remote</option>
				<option value="On-Site">On-Site</option>
			</select>
		</div>
		<div class="formheadings">
			<label>Works</label>
			<textarea name="workdone"></textarea>
		</div>
		<div id="signArea" class="formheadings">
			<label>Signature</label>
			<canvas width="300" height="100"></canvas>
		</div>
		<div class="buttoncenter">
			 <button class="button" type="submit">Submit</button>
			 <button class="button" type="reset">Clear</button>
		</div>
		</form>
	</div>
</body>
</html>