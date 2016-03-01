<?php
// Lab Number: 2a
// Program Name: Hello World Time Display
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Jan 19 2016 (resubmit)
// Est. Time to Complete: 2 hours
// Act. Time to Complete: 1 hour
// Program Description: Prints Hello World and img bar scaled to hour of day
// How to Run Program: navitage to http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass2/ass2a.php?name=Deid%20Reimer
// Files Required to Run: ass2a.php

// Display Hello World to screen
echo "<p><b>Hello World</b></p>\n";

// Display name from address bar Query String
$name = $_GET['name'];
echo "<p>User Name: $name</p>\n";

// Get and display the current time in SI standard (yyyy-mm-dd hh:mm)
$date = date("Y-m-d H:i");
echo "<p>Current Date and Time: $date</p>\n";

// Display horizontal black bars across screen above and below
// blue bar indicating % of day completed based on time
echo "<p><img src=\"black.png\" width=100% height=3px /></p>\n";

$pctTime = date("G") / 24 * 100;
echo "<p><img src=\"blue.png\" width=$pctTime% height=15px/></p>\n";

echo "<p><img src=\"black.png\" width=100% height=3px /></p>\n";

// Display the type of browser being used to display page
$userBrowser = $_SERVER['HTTP_USER_AGENT'];
echo "<p>Accessed with: $userBrowser.</p>\n";

?>