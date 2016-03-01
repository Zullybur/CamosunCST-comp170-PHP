<html>
   <head>
      <title>ass3c.php - Matthew Casiro</title>
      <!-- 
      Lab Number: 3c
      Program Name: Specific Word Finder
      Author Name: Matthew Casiro
      Author Email: mattcasiro@gmail.com
      Submission Date: Jan 25th 2016
      Est. Time to Complete: 45 mins
      Act. Time to Complete: 37 mins
      Program Description: Searches source string for "fear, waddy, gear,
         fiasco or fobbing" and returns array of results
      How to Run Program: navigate to:
         http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass3/ass3.html
      Files Required to Run: ass3.html, ass3b.php
      -->
   </head>
   <body>
<?php
   // Clean and acquire source string from POST
   $source = htmlspecialchars(strip_tags(trim($_POST['sourceString'])), ENT_NOQUOTES);

   // Find: "fear, waddy, gear, fiasco or fobbing", and
   // replace with: "1969-10-29"
   $wordRegex = '/\b(fear|waddy|gear|fiasco|fobbing)\b/';
   $replacement = '1969-10-29';
   
   echo "<p><b>Lab 3 Part C Output:</b></p>\n";
   echo "<pre style=\"white-space: pre-wrap\">\n";
   echo preg_replace($wordRegex, $replacement, $source);
   echo "\n</pre><br>\n";

   // Explain relevance of date: 1969-10-29
   echo "<p><b>October 29th 1969:</b></p>\n";
   echo "The first communications are sent through the ARPANET.<br>\n";
   echo "ARPA (Advance Research Projects Agency) was created in 1958.".
      " they set up two computers, one in UCLA and another in the Standford".
      " Research Institute. After the first transmission was successful,".
      " several other universities across the US had computers installed.\n<br>\n";
   echo "Source: <a href=\"http://www.thepeoplehistory.com/1969.html\">".
      "http://www.thepeoplehistory.com/1969.html</a>"
?>
   </body>
</html>