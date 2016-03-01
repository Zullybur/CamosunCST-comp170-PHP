<?php
// Lab Number: 3b
// Program Name: IP and Byte Finder
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Jan 25th 2016
// Est. Time to Complete: 1.5 hours
// Act. Time to Complete: 1.1 hours
// Program Description: Returns the IP address and bytes transferred from
//    an Apache server log
// How to Run Program: navigate to:
//    http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass3/ass3.html
// Files Required to Run: ass3.html, ass3b.php

echo "<html>\n";
echo "  <head>\n";
echo "    <title>ass3b.php - Matthew Casiro</title>\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <b>LAB 3 PART B:</b>\n";
echo "    <br><br>\n";

// Acquire and clean source string from POST
$source = $_POST['sourceString'];
$source = htmlspecialchars(strip_tags(trim($source)), ENT_NOQUOTES);

// Extract and display IP address from source string
$ipRegex = '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/';
preg_match_all($ipRegex, $source, $ipMatches);

echo "    <b>IP Address: </b>".$ipMatches[0][0]."\n";
echo "    <br><br>\n";

// Extract and display result code and bytes transmitted from source string
// (if request not successful, set bytes to zero)
$resultCodeRegex = '/(?<=\" )\d{3}(?= \d{1,}\b)/';
preg_match_all($resultCodeRegex, $source, $resultMatches);

$byteRegex = '/(?<=\" \d{3} )\d{1,}\b/';
preg_match_all($byteRegex, $source, $byteMatches);

// If result code is greater than 299, request failed - set bytes to zero
if ($resultMatches[0][0] > 299) {
   $byteMatches[0][0] = 0;
}

echo "    <b>Bytes Transmitted: </b>".$byteMatches[0][0]."\n";

echo "  </body>\n";
echo "</html>";
?>