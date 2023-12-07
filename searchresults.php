<?php
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

	echo "<html><head>\n<title>Boris' Lockpick SUPERSALE</title>\n</head>\n";
	echo "<body bgcolor=#323232 leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>\n";
	echo "<table width=100% height=\"178\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
	echo "<tr><td height=\"26\" colspan=\"6\" style=\"background-color: #000000\">&nbsp;</td>\n</tr>\n<tr>\n";
	echo "<td height=\"100\" colspan=\"6\" style=\"background-color: #000000\"><a href=\"index.html\"><img src=\"images/title.png\" width=\"758\" height=\"100\" border=\"0\"></a></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td height=\"52\" colspan=\"6\" style=\"background-color: #000000\"></td>\n";
	echo "</tr>\n</table>\n";


	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Search results for '<b>".$_POST["searchterm"]."</b>'.</p>\n";
	echo "<br><br>\n";
	echo "<div style=\"overflow: auto; width: 600px; height: 300px; scrollbar-base-color: #323232\">";


	$item=_sqlqueryfunc_eh("SELECT * FROM products WHERE description like '%".$_POST["searchterm"]."%'");
	$frow=mysqli_fetch_array($item);

	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".mysqli_num_rows($item)." matches found in store:\n";
	echo "<table>\n";
	while ($frow){
		echo "<tr>\n";
		echo "<td><p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$frow["name"]."</td>\n";
		echo "<td><img border=\"0\" src=\"store/products/".$frow["uid"]."/image_small.png\"></td>\n";
		echo "<td><p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">[$".$frow["price"]." each]</td>\n";
		echo "</tr>\n";
		$frow=mysqli_fetch_array($item);
	}
	echo "</table></p>\n";

	echo "<hr>\n";

	$nummatches = 0;
	$linkmatches = "";
	$file_contents = file_get_contents("content.php");
	if(strpos($file_contents, $_POST["searchterm"]) !== false) {
		$nummatches = $nummatches + 1;
		$linkmatches = $linkmatches."<br><a href=\"content.php\">Lock content; page with tutorials and other cool tips</a>";
	}
	$file_contents = file_get_contents("backend/comments.data");
	if(strpos($file_contents, $_POST["searchterm"]) !== false) {
		$nummatches = $nummatches + 1;
		$linkmatches = $linkmatches."<br><a href=\"guestbook.php\">Guestbook; other users left their comments</a>";
	}

	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$nummatches." matches found in content:\n";
	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">\n";
	echo $linkmatches;
	echo "</p></p>\n";

	echo "<hr>\n";

	echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 12px;\">";
	$handle = fopen ($_POST["backurl"], "r");
	if ($handle != FALSE){
		while (!feof ($handle)) {
    			$buffer = fgets($handle, 4096);
    			echo $buffer;
		}
		fclose ($handle);
	}
	echo "</p>";

	echo "<p align=\"center\" style=\"color: #F5F5F5; font-family: Arial;font-size: 12px;\">Copyright Eastwill Security</p>";
	echo "</body></html>";

?>

