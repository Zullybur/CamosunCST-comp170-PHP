<?php
    // Lab Number: 6
    // Program Name: Function Caller
    // Author Name: Matthew Casiro
    // Author Email: mattcasiro@gmail.com
    // Submission Date: Feb 17th 2016
    // Est. Time to Complete: 7 hours
    // Act. Time to Complete: 5.5 hours
    // Program Description: Call appropriate function based on
    //    input from calling page
    // How to Run Program: navigate to:
    //    http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass6/
    // Files Required to Run: index.html drawMe.php imglabinc.php

    // Require the file containing the image drawing functions
    (require 'imglabinc.php') or exit("Required file not found - code 1000-R\n");

    // Get object choice from calling page and call appropriate function
    if(!empty($_SERVER['QUERY_STRING'])) {
        if ($_SERVER['QUERY_STRING'] == "Square1") {
            drawSquare(400, 153, 0, 204, 128, 128, 128, 50, 50, 300);
        } else if($_SERVER['QUERY_STRING'] == "Square2") {
            drawSquare(400, 170, 57, 57, 34, 102, 102, 175, 150, 200);
        } else if($_SERVER['QUERY_STRING'] == "Triangle1") {
            drawTriangle(400, 170, 49, 57, 170, 139, 57, 50, 50, 100, 100);
        } else if($_SERVER['QUERY_STRING'] == "Triangle2") {
            drawTriangle(400, 170, 166, 57, 139, 46, 95, 100, 300, 250, 50);
        } else if($_SERVER['QUERY_STRING'] == "Circle1") {
            drawEllipse(400, 153, 0, 204, 48, 62, 115, 100, 100, 100);
        } else if($_SERVER['QUERY_STRING'] == "Circle2") {
            drawEllipse(400, 87, 149, 50, 170, 129, 57, 300, 300, 150);
        }
    }
?>