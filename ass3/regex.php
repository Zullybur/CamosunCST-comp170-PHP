<?php
// Lab Number: 3a
// Program Name: Regex Tester
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Jan 25th 2016
// Est. Time to Complete: 5 minutes
// Act. Time to Complete: 5 minutes
// Program Description: Takes search term and source string from CLI and
//    outputs array of found values
// How to Run Program: In CLI: "php regex.php '\b\w{3}\b' 'fore score and
//    seven years ago our forefathers'"
// Files Required to Run: regex.php

$regex = $argv[1];
$string = $argv[2];
preg_match_all('`'.$regex.'`', $string, $matches);
print_r($matches);
?>