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
	<?php

		$basketid=0;
		if (!isset( $_COOKIE["borislp_basket"] )) {
			echo "<p>Your shopping basket is empty, you cannot remove any items";
		}
		else{
			$basketid = $_COOKIE["borislp_basket"];
		}
		$result=_sqlqueryfunc_eh("DELETE FROM lpbasket_entry_global WHERE basketid=$basketid and prodid=".$_GET["id"]);

		$result=_sqlqueryfunc_eh("SELECT * FROM lpbasket_entry_global WHERE basketid=$basketid");

		header("Location: store_checkout.php");
	?>
</body>
</html>

<?php
	ob_end_flush()
?>
