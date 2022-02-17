<?php
//send email for invoicing

	$emailclient = "SELECT email FROM clients WHERE company='$client'";
	$emailqry = mysql_query($emailclient);
	$emailto = mysql_result($emailqry, 0);
	
	$to = $emailto;
	//$to = "stephen.wellman@uniplast.com.mt";
	
	$subject = "Jobsheet $jbrecord $client";
			
	$message = "<img src='http://jobsheet.stephenwellman.com/sign/examples/swnew.jpg'><br />
	<p><strong>Jobsheet No: </strong>
	$jbrecord </p>
<p><strong>Client:</strong>
	$client</p>
<p><strong>Date:</strong>
	$date</p>
<p><strong>From (time):</strong> 
	$timein</p>
<p><strong>To (time):</strong> 
	$timeout</p>
<p><strong>_________________________________________</strong> 
	</p>
<p><strong>Total Time:</strong> 
	$time2</p>
<p><strong>Work done:</strong>	
	$job</p>
<p><strong>_________________________________________</strong> 
	</p>
<p><strong>Authorised by:</strong>
	$contact<br>";
	$message .= '<img src="data:image/jpeg;base64,' . base64_encode( $fimage ) . ' " />';
	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: SW Jobsheet <jobsheet@wellman.technology>' . "\r\n";
			$headers .= 'Cc: info@stephenwellman.com' . "\r\n";
	
	Mail ($to, $subject, $message, $headers);
?>