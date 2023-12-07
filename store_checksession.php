<?php
	ob_start();
   error_reporting(E_ALL ^ E_NOTICE);

	require "backend/settings.conf";
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
   <tr><td height="52" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
</table>

<?php

if (isset( $_COOKIE["logon_session"])) {
	header("Location: ./store_payment.php");
	exit();
}

else{

?>
	<br>
	<p style="border-left: 26px solid #323232;color: #F5F5F5; font-family: Arial;font-size: 20px;">Please login or register below</p>

	<table>
	<form action="usrmgr_register.php" method="post">
	<input type="hidden" name="backurl" value="./store_checksession.php">
	<tr><td><div style="border-left: 26px solid #323232;color: #F5F5F5; font-family: Arial;font-size: 20px;">I am a new user:</div></td><td align="right"><input type="submit" value="Register"></td></tr>
	<tr><td>&nbsp;</td><td>
	</form>
	<tr><td colspan="2"><div style="border-left: 26px solid #323232;color: #F5F5F5; font-family: Arial;font-size: 20px;">I am a returning user:</div></td></tr>
	<form action="usrmgr_checklogin.php" method="post">
	<input type="hidden" name="backurl" value="./store_checksession.php">
	<tr><td><div style="border-left: 26px solid #323232;color: #F5F5F5; font-family: Arial;font-size: 20px;">Login</div></td><td><input name="login"></td></tr>
	<tr><td><div style="border-left: 26px solid #323232;color: #F5F5F5; font-family: Arial;font-size: 20px;">Password
		<?php if (isset($_GET["error"])){ echo "<div style=\"color: #FF0000;\">Invalid</div>";} ?>
		</div></td><td><input type="password" name="password"></td></tr>
	<tr><td align="right" colspan="2"><input type="submit" value="Login"></td></tr>
	</form>
	</table>
<?php
}
?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>