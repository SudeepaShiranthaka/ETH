<?php
   ob_start();
   error_reporting(E_ALL ^ E_NOTICE);
	global $mysqlobj;

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

<?php
$result=_sqlqueryfunc_eh("SELECT * FROM customer WHERE login='".$_POST["login"]."' and pwhash='".md5($_POST["password"])."'");
if (mysqli_num_rows($result)==0){
	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Invalid login\n";
	header("Location: ".$_POST["backurl"]."?error=login");
}
else{
	$row=mysqli_fetch_array($result);
	$userid=$row["uid"];

	$result=_sqlqueryfunc_eh("INSERT INTO logon_sessions VALUES (NULL, $userid)");
	$sessionid=mysqli_insert_id($mysqlobj);
	setcookie("logon_session", "$sessionid", time()+604800);
	if ($_POST["backurl"] === "./store_checksession.php"){
		header("Location: ./store_payment.php");
	}
	else if ($_POST["backurl"] === "./content.php"){
		header("Location: ./content_show.php");
	}
	else {
		header("Location: ./index.html");
	}
	exit();
}
?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>