<?php
   ob_start();
   error_reporting(E_ALL ^ E_NOTICE);
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

<script language="javascript">
   function disablesubmitbtn() {
      // Denne submit operasjonen kan ta litt tid, disable knappen så brukeren ikke trykker igjen...
      document.sendemail.submitbtn.value = "working...";
      document.sendemail.submitbtn.disabled = true;
      return true;
   }
</script>

<p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Use this form to send an email message telling a friend about this site</p>

<form name="sendemail" action="sendemail.php" method="post" onsubmit="return disablesubmitbtn();">
<table>
<input type="hidden" name="subject" value="Tip about new store Boris Lockpicks!">
<input type="hidden" name="email" value="noreply@borislockpick.local">
<input type="hidden" name="endtxt" value="\n\nThis message is sent from an unmonitored email and cannot be replied.">

<tr><td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">From (name)</td><td><input name="from" size="50" maxlength="100"></td></tr>
<tr><td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">To (email)</td><td><input name="to" size="50" maxlength="100"></td></tr>
<tr><td style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;" valign="top">Message</td><td><textarea name="message" cols="40" rows="8" wrap="physical"></textarea></td></tr>
<tr><td align="right" colspan="2"><input type="submit" name="submitbtn" value="Send message"></td></tr>
</table>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>