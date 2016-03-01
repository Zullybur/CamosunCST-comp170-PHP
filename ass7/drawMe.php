<?php
    // Lab Number: 7
    // Program Name: Object Creator and Manipulator
    // Author Name: Matthew Casiro
    // Author Email: mattcasiro@gmail.com
    // Submission Date: Feb 23rd 2016
    // Est. Time to Complete: 12 hours
    // Act. Time to Complete: 15 hours
    // Program Description: Create and manipulate appropriate object
    //    based on input from calling page
    // How to Run Program: navigate to:
    //    http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass7/
    // Files Required to Run: index.html drawMe.php imglabinc.php

    // Require the file containing the image drawing functions
    (require 'imglabinc.php') or exit("Required file not found - code 1000-R\n");

    // Get object choice from calling page and call appropriate functions
    if(!empty($_SERVER['QUERY_STRING'])) {
        if ($_SERVER['QUERY_STRING'] == "Square") {
            // Set initial shape and canvas properties and draw once in top right
            $canvas = array(600, 600);
            $bgrgb = array(10, 101, 110);
            $size = array(150, 150);
            $xyPos = array(400, 400);
            $fgrgb = array(191, 10, 0);
            $square = new Square($canvas, $bgrgb, $size, $xyPos, $fgrgb);
            $square->draw();
            // Increase size, move to center, and draw
            $square->bigger(array(200, 200));
            $square->moveLeft(275);
            $square->moveDown(275);
            $square->draw();
            // Reduce size again, move to bottom left, and draw
            $square->smaller(array(200, 200));
            $square->moveDown(75);
            $square->moveLeft(75);
            $square->draw();
            // Move to bottom right and draw
            $square->moveRight(350);
            $square->draw();
            // Move to top left and draw
            $square->moveUp(350);
            $square->moveLeft(350);
            $square->draw();
            $square->display();

        } else if($_SERVER['QUERY_STRING'] == "Triangle") {
            // Set initial values for triangle and canvas
            $canvas = array(600, 600);
            $bgrgb = array(22, 0, 130);
            $length = 400;
            $fgrgb = array(255, 252, 0);
            $triangle = new Triangle($canvas, $bgrgb);
            $triangle->createEquilateral(450, array(300, 300), $fgrgb);
            // Progressively shrink and redraw shape to thicken
            for ($i = 0; $i < 10; $i++) {
                $triangle->draw();
                $triangle->smaller(1);
            }
            // Flip triangle on a horizontal axis, and repeat thickening process
            for ($i = 0; $i < 10; $i++) {
                $triangle->bigger(1);
            }
            $triangle->horizontalFlip();
            for ($i = 0; $i < 10; $i++) {
                $triangle->draw();
                $triangle->smaller(1);
            }
            // Un-comment below to test function syntax
            // $triangle->moveLeft(250);
            // $triangle->moveUp(250);
            // $triangle->draw();
            // $triangle->moveRight(500);
            // $triangle->moveDown(500);
            // $triangle->draw();
            $triangle->display();

        } else if($_SERVER['QUERY_STRING'] == "Circle") {
            // Set initial shape and canvas parameters and draw
            $canvas = array(600, 600);
            $bgrgb = array(3, 122, 168);
            $size = array(400, 400);
            $xyPos = array(300, 300);
            $fgrgb = array(215, 0, 122);
            $ellipse = new Ellipse($canvas, $bgrgb, $size, $xyPos, $fgrgb);
            $ellipse->draw();
            // Shrink in half and move up, then draw and thicken
            $ellipse->smaller(array(200,200));
            $ellipse->moveUp(100);
            $ellipse->draw();
            $ellipse->smaller(array(1,1));
            $ellipse->draw();
            $ellipse->bigger(array(1,1));
            // Reposition on left side, then draw and thicken
            $ellipse->moveLeft(100);
            $ellipse->moveDown(100);
            $ellipse->draw();
            $ellipse->smaller(array(1,1));
            $ellipse->draw();
            $ellipse->bigger(array(1,1));
            // Reposition on bottom, then draw and thicken
            $ellipse->moveRight(100);
            $ellipse->moveDown(100);
            $ellipse->draw();
            $ellipse->smaller(array(1,1));
            $ellipse->draw();
            $ellipse->bigger(array(1,1));
            // Reposition on right side, then draw and thicken
            $ellipse->moveRight(100);
            $ellipse->moveUp(100);
            $ellipse->draw();
            $ellipse->smaller(array(1,1));
            $ellipse->draw();
            $ellipse->bigger(array(1,1));

            $ellipse->display();
        } else {
            echo 'Invalid selection. <a href="index.html"><b>Please try again</b></a>.';
        }
    }
?>