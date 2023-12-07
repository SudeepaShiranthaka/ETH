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

$result=_sqlqueryfunc_eh("SELECT * FROM customer WHERE uid=".$_GET["id"]);
$row=mysqli_fetch_array($result);
while($row){
	echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Here are your user details.\n";
	echo "<br><br>\n";
	echo "<form action=\"mypage_update.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"userid\" value=\"".$row["uid"]."\">\n";
?>
	<table>
      <tr>
         <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Login</td>
         <td><input name="login" type="text" readonly disabled value="<?php echo $row["login"] ?>"></td>
      </tr>
      <tr>
         <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Name</font></td>
         <td><input name="name" size="65" maxlength="100" value="<?php echo $row["name"] ?>"></td>
      </tr>
      <tr>
         <td valign="top" style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Address</td>
         <td><textarea name="address" cols="60" rows="4" wrap="PHYSICAL"><?php echo $row["address"] ?></textarea></td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td></td>
      </tr>
      <tr>
         <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Card Type</td>
         <td valign="middle">
            <input name="cardtype" type="radio" value="bcard" checked>
            <img src="images/bcard.png" width="60" height="40"> 
         </td>
      </tr>
      <tr>
         <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Card Number</td>
         <td><input name="cardnumber" maxlength="8" value="<?php echo $row["cardnumber"] ?>"></td>
      </tr>
      <tr>
         <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Expiry Date</td>
         <td>
            <select name="expyear">
               <option value="2023" <?php if($row["expiryyear"]==2023) echo "selected" ?> >2023</option>
               <option value="2024" <?php if($row["expiryyear"]==2024) echo "selected" ?> >2024</option>
               <option value="2025" <?php if($row["expiryyear"]==2025) echo "selected" ?> >2025</option>
               <option value="2026" <?php if($row["expiryyear"]==2026) echo "selected" ?> >2026</option>
               <option value="2027" <?php if($row["expiryyear"]==2027) echo "selected" ?> >2027</option>
               <option value="2028" <?php if($row["expiryyear"]==2028) echo "selected" ?> >2028</option>
            </select>
            </td>
      </tr>
      <tr>
         <td></td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td><input type="submit" value="Update"></td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td color=#ff0000>
         <?php
            if (isset($_GET["changed"]) && $_GET["changed"]==1){
               echo "<div color=#ff0000 style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Data saved...</div>";
            }
            else if (isset($_GET["error"])){
               if (isset($_GET["name"])){
                  echo "<div color=#ff0000 style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Name must be set</div><br>";
               }
               if (isset($_GET["address"])){
                  echo "<div color=#ff0000 style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Address must be set</div><br>";
               }
               if (isset($_GET["cardnumber"])){
                  echo "<div color=#ff0000 style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error:  Card number for B-CARD must be 8 digits</div><br>";
               }
               if (isset($_GET["expyear"])){
                  echo "<div color=#ff0000 style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Expiry data must be between 2023 and 2028</div><br>";
               }
            }
         ?>
         </td>
      </tr>
   </table>
   </form>

<?php

   echo "<br><br>";
   echo "<p style=\"border-left: 26px solid #323232; \"><button onclick=\"window.location.href='./mypage_chpwd.php?id=".$_GET["id"]."'\">Change password</button>";
   echo "&nbsp;&nbsp;<button onclick=\"window.location.href='./mypage_logout.php?id=".$_GET["id"]."'\">Logout</button></p>";


	$row=mysqli_fetch_array($result);
}

?>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>