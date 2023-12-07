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
   require "getbaskettotal.php";
?>

<html><head>
	<title>Boris' Lockpick SUPERSALE</title>
</head>

<body bgcolor=#323232 leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
	<?php
		$basketid=0;
		if (!isset( $_COOKIE["borislp_basket"] )) {
			$result=_sqlqueryfunc_eh("INSERT INTO borislpbasket (uid) VALUES (NULL)");
			$basketid = mysqli_insert_id($mysqlobj);
			setcookie("borislp_basket", "$basketid");
		}
		else{
			$basketid = $_COOKIE["borislp_basket"];
		}
		$result = _sqlqueryfunc_eh("SELECT COUNT(*) FROM borislpbasket");
		if ($result == 0){
			$result=_sqlqueryfunc_eh("INSERT INTO borislpbasket (uid) VALUES ($basketid)");
		}

		$qty = 1;
		if (isset($_GET["quantity"])){
			$qty = $_GET["quantity"];
		}

		$prodid = $_GET["id"];
		$added=_sqlqueryfunc_eh("SELECT * FROM products WHERE uid = $prodid");

		$row = mysqli_fetch_array($added);
		echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Added ".$row["name"]." (".$row["description"].") to your shopping basket</p>";

		$insert=_sqlqueryfunc_eh("INSERT INTO lpbasket_entry_global VALUES ($basketid, $prodid, $qty)");

		header("Location: store.php");
	?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
	ob_end_flush()
?>
