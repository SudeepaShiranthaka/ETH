<?php
ob_start();

require "backend/settings.conf";
require "backend/security.php";
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


if(isset($_POST['submit'])) {
  $name = $_POST['name'];
  $comment = $_POST['comment'];

  $file = fopen('backend/comments.data', 'a');
  fwrite($file, '<b>' . _sanitizeinput($name) . ':</b> ' . _sanitizeinput($comment) . '<br>');
  fclose($file);
}

?>
</td></tr></table>
<form action="" method="post">
<div style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Name: <br><input type="text" name="name"></div><br>
<div style="border-left: 26px solid #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">Comment: <br><textarea name="comment" rows="5" cols="40"></textarea></div><br>
<div style="border-left: 26px solid #323232;"><input type="submit" name="submit" value="Submit"></div>
</form>

<hr>

<div style="border-left: 26px solid #323232; overflow: auto; width: 600px; height: 150px; scrollbar-base-color: #323232; color: #F5F5F5; font-family: Arial;font-size: 20px;">
<table width="550">
<?php
if(file_exists('backend/comments.data')) {
  echo file_get_contents('backend/comments.data');
  // $result=file_get_contents('backend/comments.data');
  // $row=mysqli_fetch_array($result);
  // while($row){
  // 	  echo "<tr><td valign=\"top\" width=\"15\">Message:</td><td>".str_replace(chr(10), "<br>", $row)."</td></tr>\n";
  //   	echo "<tr><td colspan=\"2\"><hr></td></tr>\n";
  //   	$row=mysqli_fetch_array($result);
  // }

}
?>
</table>
</div>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body></html>

<?php
ob_end_flush()
?>