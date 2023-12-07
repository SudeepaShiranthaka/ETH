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

      echo mysqli_connect_errno() . ":" . mysqli_connect_error();

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
      <td height="52" colspan="3" style="background-color: #000000"></td>
      <td height="52" colspan="2" align="right" style="background-color: #000000">
         <?php
         $total = _getbaskettotal();
         echo "<p align=\"right\" style=\"color: #F5F5F5; font-family: Arial;font-size: 12px;\">Basket value ".number_format($total, 2)." NOK</p>";
         ?>
      </td>
      <td height="52" width="80" colspan="1" align="center" style="background-color: #000000"><a href="store_checkout.php"><img src="images/basket.png" width="52" height="52" border="0"></a></td>
   </tr>
</table>

<p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Choose the items you want to add to your shopping basket</p>

<form action="store_addtobasket.php" method="post">
	<table width=750>
   <?php

   $result = _sqlqueryfunc_eh("SELECT * FROM products");
   $row = mysqli_fetch_array($result);
   while ($row){
	   echo "<tr>\n";
	   echo "<td align=left><p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$row["name"]."</p></td>\n";
	   echo "<td colspan=\"3\">&nbsp;</td>\n";
	   echo "<td align=right><img border=\"0\" src=\"store/products/".$row["uid"]."/image_small.png\">";
	      echo "&nbsp;&nbsp;<a href=\"store_viewdetails.php?id=".$row["uid"]."\"><img alt=\"View details\" src=\"images/viewdetails.png\"></a></td>\n";
	   echo "<td align=right><p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">[".$row["price"]." NOK]</p></td>\n";
	   echo "<td align=center><p><a href=\"store_addtobasket.php?id=".$row["uid"]."\"><img alt=\"Add to basket\" src=\"images/addtobasket.png\"></a></p>\n";
	   echo "</td><td colspan=\"2\">&nbsp;</td></tr>\n";

	   $row = mysqli_fetch_array($result);
   }


   ?>

   </table>
</form>


<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>
