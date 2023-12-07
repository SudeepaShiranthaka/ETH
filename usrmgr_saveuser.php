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

	$userid=$_POST["userid"];

	$message = "";
	$error=FALSE;
	if ($_POST["name"]==""){
		$message=$message. ";name=TRUE";
		$error=TRUE;
	}
	if ($_POST["address"]==""){
		$message=$message. ";address=TRUE";
		$error=TRUE;
	}
	if (strlen($_POST["cardnumber"])!=8){
		$message=$message. ";card=TRUE";
		$error=TRUE;
	}
	if (($_POST["expyear"]<2023) || ($_POST["expyear"]>2028)){
		$message=$message. ";expiry=TRUE";
		$error=TRUE;
	}
	if ($_POST["userid"]==""){
		$message=$message. ";userid=TRUE";
		$error=TRUE;
	}
	if ($_POST["password"]==""){
		$message=$message. ";password=TRUE";
		$error=TRUE;
	}

	if ($error){
		// header("Location: ./register.php?error=1$message");
		echo "<form id=\"formRegister\" method=\"post\" action=\"usrmgr_register.php\">\n";
			echo "<input type=\"hidden\" name=\"backurl\" value=\"".$_POST["backurl"]."\">\n";
			echo "<input type=\"hidden\" name=\"error\" value=\"$message\">\n";
	   echo "</form>\n";
	   echo "<script>\n";
			echo "document.getElementById(\"formRegister\").submit();\n";
	   echo "</script>\n";
	}
	else {
   	$result=_sqlqueryfunc_eh("INSERT INTO customer VALUES (NULL,'".$_POST["userid"]."','".md5($_POST["password"])."','".$_POST["name"]."','".$_POST["address"]."','".$_POST["cardnumber"]."',".$_POST["expyear"].")");

		$userid=mysqli_insert_id($mysqlobj);

		$result=_sqlqueryfunc_eh("INSERT INTO logon_sessions VALUES (NULL, $userid)");
		$sessionid=mysqli_insert_id($mysqlobj);
		setcookie("logon_session", "$sessionid", time()+604800);

		if ($_POST["backurl"] === "./store_checksession.php"){
			header("Location: ./store_payment.php");
		}
		else if ($_POST["backurl"] === "./mypage.php"){
			header("Location: ./mypage_show.php");
		}

	}

ob_end_flush()
?>
