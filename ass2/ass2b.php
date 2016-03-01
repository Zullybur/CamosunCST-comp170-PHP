<?php

// Lab Number: 2b
// Program Name: Basic Calculator Output
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Jan 19 2016 (resubmit)
// Est. Time to Complete: 1 hr
// Act. Time to Complete: 1 hr
// Program Description: Runs calculations from HTML form
// How to Run Program: navigate to http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass2/ass2b.html
// Files Required to Run: ass2b.html, ass2b.php


// Retrieve values and operator from $_POST
$firstValue = $_POST["firstValue"];
$secondValue = $_POST["secondValue"];
$operator = $_POST["operation"];

// Build array to calculate all possible outcomes
$resultArray = array(
   '+' => "$firstValue + $secondValue",
   '-' => "$firstValue - $secondValue",
   '*' => "$firstValue * $secondValue",
   '/' => "$firstValue / $secondValue",
   '**' => "pow($firstValue, $secondValue)");

$operation = $resultArray[$operator];

// Perform operation per user inputs
eval("\$result = $operation;");

// Output result
echo "Calculating: $firstValue $operator $secondValue ...<br>\n";
echo "\n<p>Result: $result</p>";

// Provide link back to form
echo "<a href=\"./ass2b.html\">Start Over?</a>";

?>