<?php
   ob_start();
   error_reporting(E_ALL ^ E_NOTICE);

   require "backend/settings.conf";
?>

<html><head>
   <title>Boris' Lockpick SUPERSALE</title>
   
</head>

<body bgcolor=#323232 leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
   <form action="searchresults.php" method="post">
   <input type="hidden" name="backurl" value="backtocontent.link.html">
   <table width=100% height="178" border="0" cellpadding="0" cellspacing="0">
      <tr><td height="26" colspan="6" style="background-color: #000000">&nbsp;</td></tr>
      <tr>
         <td height="100" colspan="6" style="background-color: #000000"><a href="index.html"><img src="images/title.png" width="758" height="100" border="0"></a></td>
      </tr>
   <tr>
      <td height="52" colspan="3" style="background-color: #000000"><a href="lockpicking.php"><img src="images/backtocontent.png" width="500" height="52" border="0"></a></td>
      <td height="52" colspan="2" align="right" style="background-color: #000000"><input name="searchterm" placeholder="Search here..." maxlength="30" style="height: 48px; font-size: 20px; border-radius: 20px; background-color: #939393;" border="5"></td>
      <td height="52" width="80" colspan="1" align="center" style="background-color: #000000"><input type="image" alt="Search" src="images/search.png" width="52" height="52" border="0"></td>
   </tr>
   </table>
   </form>

   <p>&nbsp;</p>
   <font color=#F5F5F5 face="Arial">
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 32px;" size=20>My name is Boris, I am a computer programmer and a lockpicker - streaming lockpicking every Saturday on goldeneye.net.</p>

      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Lockpicking is the practice of opening a lock without using its key. While the image of a lockpicker might bring to mind a thief or a spy, lockpicking is a legitimate skill used by locksmiths, security professionals, law enforcement officers, and hobbyists. In this essay, I will explore the history and mechanics of lockpicking, its legal and ethical implications, and its practical applications.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Locks have been used for centuries as a means of securing doors, chests, and other objects. The oldest known lock, found in the ruins of the ancient Assyrian capital of Nineveh, dates back to around 2000 BC. Over the years, locks have become more sophisticated and harder to pick, but the basic principles have remained the same. Most locks consist of a cylinder or core that is turned by a key, and a series of pins or tumblers that must be aligned in order to turn the cylinder.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Lockpicking as a skill has been around for just as long as locks have been in use. In fact, some of the earliest known writings on lockpicking date back to the 16th century. However, it wasn't until the 20th century that lockpicking became widely recognized as a legitimate field of study. In the 1950s and 60s, the US government developed lockpicking tools and techniques as part of its espionage activities. This led to an increased interest in lockpicking among hobbyists and security professionals.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Lockpicking is not illegal in and of itself, although it is often associated with criminal activity. In many countries, possessing lockpicking tools with the intent to commit a crime is a criminal offense. In the United States, the possession of lockpicking tools is legal, but using them to commit a crime is a felony offense. As a result, lockpickers are often viewed with suspicion, and many prefer to keep their hobby or profession to themselves.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Despite its negative connotations, lockpicking has many practical applications. Locksmiths use lockpicking to gain entry to locked buildings or cars when the keys have been lost or stolen. Security professionals use lockpicking to test the strength of locks and to identify vulnerabilities that could be exploited by criminals. Law enforcement officers may use lockpicking to gain entry to a building or vehicle during an emergency situation.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">Lockpicking also has an important place in the world of physical security. By studying the mechanics of locks and experimenting with different techniques, lockpickers can identify weaknesses in lock design and develop new methods for defeating them. This information can then be used to improve lock design and make locks more secure.</p>
      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 20px;">In conclusion, lockpicking is a fascinating skill with a long history and many practical applications. While it is often associated with criminal activity, it is a legitimate field of study with many legitimate uses. As with any skill, the key is to use it responsibly and ethically. By doing so, lockpickers can help make the world a safer and more secure place.</p>

      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 26px;">Download my full PDF lockpick practice guide:</p>

         <p style="border-left: 52px solid #323232;"><a href="lockguide.pdf"><img src="images/downloadpdf.png" width="500" height="75" border="0"></a></p>

      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 26px;">You will find my full lockpicking 2-day course as part of Ethical Hacking (ETH2100) class on the Bachelor of Cybersecurity study program at Kristiania. Apply now :-)</p>

      <p style="border-left: 26px solid #323232; border-right: 26px solid #323232; font-size: 26px;">Click to view my intro video guide:</p>

         <p style="border-left: 52px solid #323232;">
         <video width="960" height="540" controls>
            <source src="media/lockpick_140.mp4" type="video/mp4">
            Your browser does not support the video tag.
         </video>
         </p>

   </font>
   <p style="color: #F5F5F5; font-family: Arial;font-size: 20px;">&nbsp;</p>

<p align="center" style="color: #F5F5F5; font-family: Arial;font-size: 12px;">Copyright Eastwill Security</p>
</body>
</html>

<?php
ob_end_flush()
?>