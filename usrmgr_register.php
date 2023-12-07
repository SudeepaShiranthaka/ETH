<?php
ob_start();
?>

<html><head>
   <title>Boris' Lockpick SUPERSALE</title>
   
</head>

<body bgcolor=#323232 leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
   <table width=100% height="100" border="0" cellpadding="0" cellspacing="0">
      <tr><td height="26" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
      <tr>
         <td height="100" colspan="6" style="background-color: #000000"><a href="index.html"><img src="images/title.png" width="758" height="100" border="0"></a></td>
      </tr>
      <tr><td height="52" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
   </table>

   <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">
   <?php
	   if ($_POST["backurl"] === "./store_checksession.php"){
	      echo "Fill in the following form with your details so we can complete the checkout process. Your information will be stored on our secure server.";
	   }
	   else if ($_POST["backurl"] === "./mypage.php"){
	      echo "Fill in the following form with your details so we can complete registering your account. This account can also be used for purchases in our webstore.";
	   }
	   else {
		   header("Location: ./index.html");
	   exit();
	   }
	   echo "<br><br>NOTE TO STUDENTS: In reality this server in no way complies with GDPR or other regulations, do NOT use real information, and do not use your real password. To make sure no real creditcard information is provided a new fake creditcard (BCARD) is used on this site that has a 8 digit creditcardnumber... :-)";
   ?>
   </p>

	<form action="usrmgr_saveuser.php" method="post">
      <?php
	      if ($_POST["backurl"] === "./store_checksession.php"){
            echo "<input type=\"hidden\" name=\"backurl\" value=\"./store_checksession.php\">";
	      }
	      else if ($_POST["backurl"] === "./mypage.php"){
            echo "<input type=\"hidden\" name=\"backurl\" value=\"./mypage.php\">";
	      }
      ?>
      <table>
         <tr>
            <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Name</td>
            <td><input name="name" size="65" maxlength="100" value=""></td>
         </tr>
         <tr>
            <td valign="top" style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Address</td>
            <td><textarea name="address" cols="60" rows="4" wrap="PHYSICAL"></textarea></td>
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
            <td><input name="cardnumber" maxlength="8"></td>
         </tr>
         <tr>
            <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Expiry Date</td>
            <td>
               <span style="color: #F5F5F5; font-family: Arial;font-size: 20px;">
               <select name="expyear">
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
               </select>
               </td>
         </tr>
         <tr>
            <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Login</td>
            <td><input name="userid" type="text" value=""></td>
         </tr>
         <tr>
            <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Password</td>
            <td><input name="password" type="password"></td>
         </tr>
		<tr>
            <td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Confirm Password</td>
            <td><input name="confirmpassword" type="password"></td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Create Account"></td>
         </tr>
      </table>
   </form>
   <?php
      if (isset($_POST["error"])){
         if(strpos($_POST["error"], "name") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Name must be set</div><br>";
         }
         if(strpos($_POST["error"], "address") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Address must be set</div><br>";
         }
         if(strpos($_POST["error"], "cardnumber") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error:  Card number for B-CARD must be 8 digits</div><br>";
         }
         if(strpos($_POST["error"], "expyear") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Expiry data must be between 2023 and 2028</div><br>";
         }
         if(strpos($_POST["error"], "userid") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Login must be set</div><br>";
         }
         if(strpos($_POST["error"], "password") !== false) {
            echo "<div color=#ff0000 style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Error: Password must be set</div><br>";
         }
      }
   ?>

   <p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>