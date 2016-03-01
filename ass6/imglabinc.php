<?php
// Lab Number: 6
// Program Name: IMG Creation Functions
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Feb 17th 2016
// Est. Time to Complete: 7 hours
// Act. Time to Complete: 5.5 hours
// Program Description: Functions to draw a square, circle, and triangle
//    and save them as an image.
// How to Run Program: navigate to:
//    http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass6/
// Files Required to Run: index.html drawMe.php imglabinc.php

// Draw a square using provided canvas size, co-ordinates of
// lower-left corner, and length of one side. Also accepts background
// and foreground colours as RBG parameters.
function drawSquare ($canvas, $fr, $fg, $fb, $br, $bg, $bb, $x, $y, $size) {
    header("Content-Type: image/png");
    $y = $canvas - $y;
    // Create empty image, define background and foreground colours,
    // and fill background
    $im = imagecreatetruecolor($canvas, $canvas) or exit('Cannot Initialize new GD image stream');
    $fgcolor = imagecolorallocate($im, $fr, $fg, $fb);
    $bgcolor = imagecolorallocate($im, $br, $bg, $bb);
    imagefill($im, 0, 0, $bgcolor); 

    // Draw a square, write the image, and free up the memory used
    imagerectangle($im, $x, $y, $size + $x, $y - $size, $fgcolor);
    imagefill($im, $x + 1, $y - 1, $fgcolor);
    imagepng($im);
    imagedestroy($im);
}

// Purpose: Draw a triangle using provided canvas size, co-ordinates of
// lower-left corner, base, and height. Also accepts background and
// foreground colours as RBG parameters
function drawTriangle ($canvas, $fr, $fg, $fb, $br, $bg, $bb, $x, $y, $base, $height) {
    header("Content-Type: image/png");
    $y = $canvas - $y;
    // Create empty image, define background and foreground colours,
    // and fill background
    $im = imagecreatetruecolor($canvas, $canvas) or exit('Cannot Initialize new GD image stream');
    $fgcolor = imagecolorallocate($im, $fr, $fg, $fb);
    $bgcolor = imagecolorallocate($im, $br, $bg, $bb);
    imagefill($im, 0, 0, $bgcolor); 
    
    // Create an array of points using calculations off base and height
    // for a right angle triangle
    $pointArray = array($x, $y, $x + $base, $y, $x, $y - $height);

    // Draw a triangle, write the image, and free up the memory used
    imagepolygon($im, $pointArray, 3, $fgcolor);
    imagefill($im, $x + 1, $y - 1, $fgcolor);
    imagepng($im);
    imagedestroy($im);
}

// Purpose: Draw a circle using provided canvas size, co-ordinates of
// the center, and diameter. Also accepts background and foreground
// colours as RBG parameters.
function drawEllipse ($canvas, $fr, $fg, $fb, $br, $bg, $bb, $x, $y, $diameter) {
    header("Content-Type: image/png");
    $y = $canvas - $y;
    // Create empty image, define background and foreground colours,
    // and fill background
    $im = imagecreatetruecolor($canvas, $canvas) or exit('Cannot Initialize new GD image stream');
    $fgcolor = imagecolorallocate($im, $fr, $fg, $fb);
    $bgcolor = imagecolorallocate($im, $br, $bg, $bb);
    imagefill($im, 0, 0, $bgcolor);

    // Draw a circle, write the image, and free up the memory used
    imageellipse($im, $x, $y, $diameter, $diameter, $fgcolor);
    imagefill($im, $x, $y, $fgcolor);
    imagepng($im);
    imagedestroy($im);
}
?>