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

$result=_sqlqueryfunc_eh("SELECT * FROM customer WHERE login='".$_POST["login"]."' and pwhash='".md5($_POST["password"])."'");
if (mysqli_num_rows($result)==0){
	echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Invalid login\n";
}
else{
	$row=mysqli_fetch_array($result);
	$userid=$row["uid"];
	$result=_sqlqueryfunc_eh("INSERT INTO logon_sessions VALUES (NULL, $userid)");
	$sessionid=mysqli_insert_id($mysqlobj);
	setcookie("logon_session", "$sessionid", time()+604800);
	header("Location: ./mypage_show.php?id=$userid");
	exit();
}

?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>