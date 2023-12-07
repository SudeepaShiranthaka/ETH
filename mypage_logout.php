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

	if (isset( $_GET["userid"])) {
		$result=_sqlqueryfunc_eh("DELETE FROM logon_sessions WHERE userid = ".$_GET["userid"]);
	}

	if (isset( $_COOKIE["logon_session"])) {
		setcookie("logon_session", $_COOKIE["logon_session"], time() - 3600);
	}

	header("Location: ./index.html");

	ob_end_flush()
?>