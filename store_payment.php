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
	require "getbaskettotal.php";
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
      <td height="52" colspan="5" style="background-color: #000000"><a href="store.php"><img src="images/backtostore.png" width="500" height="52" border="0"></a></td>
      <td height="52" colspan="1" style="background-color: #000000"></td>
   </tr>
</table>

<?php

if (!isset( $_COOKIE["logon_session"])) {
	echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">You must be logged in to view this page";
}
else{
	if (!isset( $_COOKIE["borislp_basket"])) {

		echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Your shopping basket is currently empty</p>\n";
	}
	else{
		$basketid = $_COOKIE["borislp_basket"];
		$result = _sqlqueryfunc_eh("SELECT f.uid, f.name, f.price, lpc.quantity FROM products f, lpbasket_entry_global lpc, borislpbasket c WHERE c.uid=$basketid and lpc.basketid=c.uid and lpc.prodid=f.uid");
		$nrows = mysqli_num_rows($result);
		if (($nrows==0)){
			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Your shopping basket is currently empty</p>\n";
		}
		else{
			$total = _getbaskettotal();
			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Your total value of this shopping basket is <b>$".number_format($total, 2)."</b></p>\n";
			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Payment will be made with the credit card currently on file with us.  Its details are...\n";
			$session=_sqlqueryfunc_eh("SELECT * FROM logon_sessions WHERE uid =".$_COOKIE["logon_session"]);
			$srow=mysqli_fetch_array($session);
			$userid=$srow["userid"];

			$quser=_sqlqueryfunc_eh("SELECT * FROM customer WHERE uid=$userid");
			$user=mysqli_fetch_array($quser);
			echo "<table style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">\n";
			echo "<tr><td style=\"border-left: 26px solid #323232;\">Card holder name</td><td> - ".$user["name"]."</td></tr>\n";
			echo "<tr><td style=\"border-left: 26px solid #323232;\">Card number</td><td> - ".$user["cardnumber"]."</td></tr>\n";
			echo "<tr><td style=\"border-left: 26px solid #323232;\">Expiry date</td><td> - ".$user["expiryyear"]."</td></tr>\n";
			echo "</table>\n";

			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Delivery will be sent to the following address...</p>\n";
			echo "<table style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">\n";
			echo "<tr><td style=\"border-left: 26px solid #323232;\">".$user["address"]."</td></tr>\n";
			echo "</table>\n";
			echo "<br><br>";
			echo "<p style=\"border-left: 26px solid #323232;\"><a href=\"store_completed.php\"><img alt=\"Complete payment\" src=\"images/paynow.png\"></a>\n";
		}
	}
}

?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>