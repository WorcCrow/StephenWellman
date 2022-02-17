<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == "stephen"
&& $pass == "qwerty")
{
        include("sign/examples/qjobsheet.php");
}
else
{
    if(isset($_POST))
    {?>
		<style type="text/css">
			body,td,th {
			font-family: "Century Gothic";
			font-size: 4mm;
			}
		</style>
		<html><body>
		<a href="/index.html"><img src="sign/examples/swnew.jpg" alt="Logo" width="164" height="82" align="middle"/></a><P>	
		<h4>Enter Username and Password before accessing SW Job Records</h4>
            <form method="POST" action="secure.php">
			User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
			</p>
		</body></html>
    <?}
}
?>