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
   <tr>
      <td height="52" colspan="5" style="background-color: #000000"><a href="lockpicking.php"><img src="images/backtocontent.png" width="500" height="52" border="0"></a></td>
      <td height="52" colspan="1" style="background-color: #000000"></td>
   </tr>
</table>

<?php
	$email = $_POST["email"];
	$to = $_POST["to"];
	$from = $_POST["from"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];

	if (getenv('HTTP_REFERER') != $GLOBALS["siteroot"]."tellfriend.php"){
		echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">You cannot call this page directly,\n";
		echo "please go to the <a href=\"tellfriend.php\">Email a friend</a> page and enter your message.</p>";
	}
	else if (($to=="")||($from=="")||($message=="")){
		echo "<p style=\"color: #F5F5F5; font-family: Arial;font-size: 20px;\">Invalid parameters, you must supply input for all fields</p>";
	}
	else {
		// format is "fakemail sentfrom sentto subject message"
		$email = $_POST["email"];
		$to = $_POST["to"];
		$from = $_POST["from"];
		$subject = $_POST["subject"];
		$message = $_POST["message"].$_POST["endtxt"];
		$cmd_linx = "./backend/sendemail_linux \"$email\" \"$to\" \"$subject\" \"$message\"";
		$cmd_osx_arm = "./backend/sendemail_osx_arm \"$email\" \"$to\" \"$subject\" \"$message\"";
		$cmd_win = "backend\\sendemail_win.exe \"$email\" \"$to\" \"$subject\" \"$message\"";
		$uname = php_uname('m');
		echo "<pre style=\"border-left: 26px solid #323232; color: #F5F5F5;\">";
		// echo $cmd_win;
		echo "<br>";

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			// Windows operating system, 32 bit application will run on both x86 and x64:
			exec($cmd_win, $output, $return_value);
		} else if (strtoupper(substr(PHP_OS, 0, 6)) === 'DARWIN' && strpos($uname, 'arm') !== false) {
			// Darwin is the codename for MacOS, and we have an ARM compile for X1 and X2:
			exec($cmd_osx_arm, $output, $return_value);
		} else {
			// Otherwise will attempt the linux executable, will fail if x86 MacOS:
			exec($cmd_linx, $output, $return_value);
		}
		// echo "Return value: $return_value\n";
		echo implode("<br>", $output);

		$output = ob_get_clean();
		echo $output;
		echo "</pre>";
		echo "<p style=\"border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;\">Thank you for sending an email to your friend :-)</p>";
	}

?>


<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>