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

	$userid=$_POST["userid"];

	$message = "";
	$error=FALSE;
	if ($_POST["name"]==""){
		$message=$message. "&name=TRUE";
		$error=TRUE;
	}
	if ($_POST["address"]==""){
		$message=$message. "&address=TRUE";
		$error=TRUE;
	}
	if (strlen($_POST["cardnumber"])!=8){
		$message=$message. "&card=TRUE";
		$error=TRUE;
	}
	if (($_POST["expyear"]<2023) || ($_POST["expyear"]>2028)){
		$message=$message. "&expiry=TRUE";
		$error=TRUE;
	}

	if ($error){
		header("Location: ./mypage_show.php?id=$userid&error=1$message");
	}
	else {
		$result=_sqlqueryfunc_eh("UPDATE customer SET name='".$_POST["name"]."',address='".$_POST["address"]."',cardnumber='".$_POST["cardnumber"]."',expiryyear=".$_POST["expyear"]." where uid=$userid");
		header("Location: ./mypage_show.php?id=$userid&changed=1");
	}

	ob_end_flush()
?>
