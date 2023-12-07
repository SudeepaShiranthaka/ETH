<?php
   ob_start();
   error_reporting(E_ALL ^ E_NOTICE);

   require "backend/settings.conf";
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
      <tr><td height="52" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
   </table>

   <font color=#F5F5F5 face="Arial"">
      <p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">On this content page you can manage your account:</p>

         <p style="border-left: 52px solid #323232;"><a href="mypage.php"><img src="images/mypagebar.png" width="500" height="75" border="0"></a></p>

      <p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Or you can view my lockpick content like videos, tutorials and other cool tips (only for members - free signup):</p>

         <p style="border-left: 52px solid #323232;"><a href="content.php"><img src="images/contentbar.png" width="500" height="75" border="0"></a></p>

      <p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Please also sign my guestbook:</p>

         <p style="border-left: 52px solid #323232;"><a href="guestbook.php"><img src="images/guestbookbar.png" width="500" height="75" border="0"></a></p>

      <p style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">If you like this site or want to help me promote my webshop, please tell a friend:</p>

         <p style="border-left: 52px solid #323232;"><a href="tellfriend.php"><img src="images/tellfriendbar.png" width="500" height="75" border="0"></a></p>

   </font>
   <p style="color: #F5F5F5; font-family: Arial;font-size: 20px;">&nbsp;</p>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body>
</html>

<?php
ob_end_flush()
?>