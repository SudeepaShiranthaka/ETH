<?php
	ob_start();
   error_reporting(E_ALL ^ E_NOTICE);

	require "backend/settings.conf";

	$mysqlobj;
	$mysqlobj = mysqli_connect($GLOBALS["dbserver"], $GLOBALS["dbusername"], $GLOBALS["dbpassword"], $GLOBALS["dbname"]);
	if ($mysqlobj == FALSE){
		echo "<p>TIL STUDENT: Databasen kjører ikke, det betyr at du enten ikke har installert MySQL riktig,\n";
		echo " men mest sannsynlig er at du ikke har satt opp settings.conf filen med samme brukernavn og\n";
		echo " passord som du satt når du installerte og konfigurerte MySQL...</p>\n";

		die; // Signaler til webserver at den skal slutte å laste denne siden...
		exit();
	}

   require "sqlqueryfunc.php";
?>

<html><head>
   <title>Boris' Lockpick SUPERSALE</title>
   
</head>

<body bgcolor=#323232 leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width=100% height="178" border="0" cellpadding="0" cellspacing="0">
   <tr><td height="26" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
   <tr>
      <td height="100" colspan="6" style="background-color: #000000"><a href="index.html"><img src="images/title.png" width="758" height="100" border="0"></a></td>
   </tr>
   <tr>
      <td height="52" colspan="5" style="background-color: #000000"><a href="lockpicking.php"><img src="images/backtocontent.png" width="500" height="52" border="0"></a></td>
      <td height="52" colspan="1" style="background-color: #000000"></td>
   </tr>
</table>


<?php

if (isset( $_COOKIE["logon_session"])) {
	header("Location: ./content_show.php");
	exit();
}

else {
   echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">You must login to view this page<br><br></p>\n";
}
?>

<table>
<form action="usrmgr_checklogin.php" method="post">
	<input type="hidden" name="backurl" value="./content.php">
	<tr><td><div style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Login</div></td><td><input name="login"></td></tr>
	<tr><td><div style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Password
		<?php if (isset($_GET["error"])){ echo "<div style=\"color: #FF0000;\">Invalid</div>";} ?>
		</div></td><td><input type="password" name="password"></td></tr>
	<tr><td align="right" colspan="2"><input type="submit" value="Login"></td></tr>
</table>
</form>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>