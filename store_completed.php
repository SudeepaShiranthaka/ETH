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
   <tr><td height="52" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
</table>

<?php

if (!isset( $_COOKIE["logon_session"])) {
	echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">You must be logged in to view this page";
}
else{
	if (!isset( $_COOKIE["borislp_basket"])) {
		echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">You do not have a shopping basket</p>\n";
	}
	else{
		$basketid = $_COOKIE["borislp_basket"];
		$result = _sqlqueryfunc_eh("SELECT f.uid, f.name, f.price, lpc.quantity FROM products f, lpbasket_entry_global lpc, borislpbasket c WHERE c.uid=$basketid and lpc.basketid=c.uid and lpc.prodid=f.uid");
		$nrows = mysqli_num_rows($result);

		if (($nrows==0)){
			echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">This shopping basket is currently empty</p>\n";
		}
		else{
			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Payment received.  Many thanks.\n";
			echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">The following lockpicks will be delivered to you:\n";

			$row = mysqli_fetch_array($result);
			echo "<br>\n";
			echo "<table><tr><td valign=\"top\">";
			if ($nrows>0){
				echo "<table>";
				while ($row){
					echo "<tr><td align=left style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">\n";
					echo $row["quantity"]." x ".$row["name"]."</td><td><img border=\"0\" src=\"store/products/".$row["uid"]."/image_small.png\">\n";
					echo "</td></tr>\n";
					$row = mysqli_fetch_array($result);
				}
				echo "</table>\n";
			}
			echo "</td><td valign=\"top\">";
			echo "</table>";

			$result=_sqlqueryfunc_eh("DELETE FROM borislpbasket WHERE uid=$basketid");
			$result=_sqlqueryfunc_eh("DELETE FROM lpbasket_entry_global WHERE basketid=$basketid");
			setcookie("borislp_basket", "$basketid", time() - 3600);
		}

	}
}

?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>