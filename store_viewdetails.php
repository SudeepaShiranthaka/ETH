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
   require "getbaskettotal.php";


   if(isset($_POST['submit_x'])) {
      $id = $_POST['id'];
      $quantity = $_POST['quantity'];

      header("Location: store_addtobasket.php?id=$id&quantity=$quantity");
   	exit();
   }
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
      <td height="52" colspan="3" style="background-color: #000000"><a href="store.php"><img src="images/backtostore.png" width="500" height="52" border="0"></a></td>
      <td height="52" colspan="2" align="right" style="background-color: #000000">
         <?php
         $total = _getbaskettotal();
         echo "<p align=\"right\" style=\"color: #F5F5F5; font-family: Arial;font-size: 12px;\">Basket value ".number_format($total, 2)." NOK</p>";
         ?>
      </td>
      <td height="52" width="80" colspan="1" align="center" style="background-color: #000000"><a href="store_checkout.php"><img src="images/basket.png" width="52" height="52" border="0"></a></td>
   </tr>
</table>

   <script language="javascript">
      function checkqty() {
         if (isNaN(document.buyproduct.quantity.value)) {
               alert ("Only numbers are allowed as quantity for items...");
               document.buyproduct.quantity.focus();
               document.buyproduct.quantity.select();
               return false;
         }
         else if (document.buyproduct.quantity.value < 1 || document.buyproduct.quantity.value > 99) {
            alert ("Quantity of items must be between 1 and 99...");
            document.buyproduct.quantity.focus();
            document.buyproduct.quantity.select();
            return false;
         }
         return true;
      }
      function lessqty() {
         if (parseInt(document.buyproduct.quantity.value) > 1){
            document.buyproduct.quantity.value = parseInt(document.buyproduct.quantity.value) - 1;
         }
      }
      function moreqty() {
         if (parseInt(document.buyproduct.quantity.value) < 9){
            document.buyproduct.quantity.value = parseInt(document.buyproduct.quantity.value) + 1;
         }
      }
   </script>

   <br>

   <?php
      $result = _sqlqueryfunc_eh("SELECT * FROM products WHERE uid=".$_GET["id"]);
      $item = mysqli_fetch_array($result);

      // echo "<p align=\"center\"><img border=\"0\" src=\"store/products/".$item["uid"]."/image_large1.png\">\n";
      // echo "&nbsp; &nbsp; <img border=\"0\" src=\"store/products/".$item["uid"]."/image_large2.png\"></p>\n";
      echo "<p align=\"center\"><img border=\"0\" src=\"store/products/".$item["uid"]."/image_large.png\"></p>\n";

  	   echo "<form name=\"buyproduct\" action=\"\" method=\"post\" onsubmit=\"return checkqty();\">";
   	echo "<input type=\"hidden\" name=\"id\" value=\"".$_GET["id"]."\">\n";
		echo "<table align=center width=500>";
	   echo "<tr><td colspan=\"6\" align=left>\n";
	   echo "<div style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$item["description"]."</div>\n";
	   echo "</td></tr><tr><td align=left colspan=\"3\">\n";
	   echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$item["name"]."</p>\n";
	   echo "</td><td width=100%>&nbsp;</td><td>\n";
	   echo "<p><img border=\"0\" src=\"store/products/".$item["uid"]."/image_small.png\">\n";

	   echo "</td><td><p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">".$item["price"]."</p>\n";
	   echo "</td></tr>\n";
      ?>
      <tr><td>&nbsp;</td></tr>

      <tr>
         <td style="color: #F5F5F5; font-family: Arial;font-size: 20px;"><img onclick="lessqty()" alt="-" src="images/lesstobasket.png"></td>
         <td style="color: #F5F5F5; font-family: Arial;font-size: 20px;"><input align="center" name="quantity" size="1" maxlength="1" value="1"></td>
         <td style="color: #F5F5F5; font-family: Arial;font-size: 20px;"><img onclick="moreqty()" alt="+" src="images/moretobasket.png"></td>
         <td width=100%>&nbsp;</td>
         <td align="right"><input type="image" name="submit" alt="Add to basket" src="images/addtobasket.png"></p></td>
         <td>&nbsp;</td>
      </tr>
      </table>
	</form>


<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>
