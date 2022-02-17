<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="480">
  <meta name="viewport" content="width=320, user-scalable=no">
  <title>SW Jobsheet</title>
</head>
  <style>
    body,td,th {
	font-family: "Century Gothic";
	font-size: 4mm;
}
  </style>
<link href="../assets/jquery.signaturepad.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<a href="/index.html"><img src="swnew.jpg" alt="Logo" width="164" height="82" align="middle"/></a>

<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>

<?php include_once './condb.php'; ?>

<form method="post" action="index3.php" class="sigPad">
<p> Client: <br> 
  <select name="client2" id="client">
    <option VALUE=0>Select Company
	 <?php  
      while($row = mysql_fetch_array($result))
     {
      $bookselect=$row["company"];
      echo "<OPTION VALUE='$bookselect'>".$bookselect.'</option>';
      }
     ?></option>
  </select>
  <br>
  Contact: <br> <input type="text" name="cont" /> <br>
  Date: <br><input type="date" min="2014-01" name="date" /> <br>
  Time in: <br><input type="time" name="timein" /> <br>
  Time Out: <br><input type="time" name="timeout" /> <br>
  Job: <br>
  <textarea type="text" cols="40" rows="10" name="job"> </textarea> 
</p>    
	<ul class="sigNav">
      <li class="clearButton"><a href="#clear">Clear</a></li>
</ul>
    <div class="sig sigWrapper">
      <div class="typed"></div>
      <canvas class="pad" width="298" height="100"></canvas>
      <input type="hidden" name="output" class="output">
    </div>
    <button type="submit">Submit</button>
	<button type="reset">Reset</button>
</form>

  <script src="../jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad({drawOnly:true});
    });
  </script>
  <script src="../assets/json2.min.js"></script>
</body>