<?php
    // Lab Number: 7
    // Program Name: IMG Creation Classes
    // Author Name: Matthew Casiro
    // Author Email: mattcasiro@gmail.com
    // Submission Date: Feb 23rd 2016
    // Est. Time to Complete: 12 hours
    // Act. Time to Complete: 15 hours
    // Program Description: Classes to control a canvas with one shape that can be
    //    manipulated
    // How to Run Program: navigate to:
    //    http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass7/
    // Files Required to Run: index.html drawMe.php imglabinc.php

    // Create a canvas object with a rectangle shape that can be manipulated and
    // drawn multiple times before being displayed
    class Square {
        private $xyLoc = array('x' => 0, 'y' => 0);
        private $shapeSize = array('width' => 0, 'height' => 0);
        private $fgcolor;
        private $bgcolor;
        private $canvas = array('width' => 0, 'height' => 0);
        private $img;

        // Englarge square width and height by given amounts (array)
        function bigger($newSize) {
            // Allow change if square does not become bigger than canvas
            if (($this->shapeSize['width'] + $newSize[0]) < $this->canvas['width'] && 
                ($this->shapeSize['height'] + $newSize[1]) < $this->canvas['height']) {
                $this->shapeSize['width'] += $newSize[0];
                $this->shapeSize['height'] += $newSize[1];
            }
        }
        // Shrink square width and height by a given amount (array)
        function smaller($newSize) {
            // Allow change if square will not reduce width or height below zero
            if ($this->shapeSize['width'] - $newSize[0] >= 0 && $this->shapeSize['height'] - $newSize[1] >= 0) {
                $this->shapeSize['width'] -= $newSize[0];
                $this->shapeSize['height'] -= $newSize[1];
            }
        }
        // Move square left by a given amount, if center of square will remain on canvas
        function moveLeft($decreaseX) {
            $center = $this->xyLoc['x'] + ($this->shapeSize['width'] / 2);
            if($center - $decreaseX < $this->canvas['width']) {
                $this->xyLoc['x'] -= $decreaseX;
            }
        }
        // Move square right by a given amount, if center of square will remain on canvas
        function moveRight($increaseX) {
            $center = $this->xyLoc['x'] + ($this->shapeSize['width'] / 2);

            $this->xyLoc['x'] += $increaseX;
        }
        // Move square up by a given amount, if center of square will remain on canvas
        function moveUp ($decreaseY) {
            $center = $this->xyLoc['y'] - ($this->shapeSize['height'] / 2);
            $this->xyLoc['y'] -= $decreaseY;
        }
        // Move square down by a given amount, if center of square will remain on canvas
        function moveDown($increaseY) {
            $center = $this->xyLoc['y'] - ($this->shapeSize['height'] / 2);
            $this->xyLoc['y'] += $increaseY;
        }
        // Draw shape to canvas
        function draw() {
            imagerectangle($this->img, $this->xyLoc['x'], $this->xyLoc['y'], $this->xyLoc['x'] + $this->shapeSize['width'],
                $this->xyLoc['y'] - $this->shapeSize['height'], $this->fgcolor);
        }
        // Output canvas to buffer
        function display() {
            header("Content-Type: image/png");
            imagepng($this->img);
            imagedestroy($this->img);
        }
        function __construct($newCanvas, $bgrgb, $newShape, $newPos, $fgrgb) {
            $this->canvas['width'] = $newCanvas[0]; $this->canvas['height'] = $newCanvas[1];
            $this->img = imagecreatetruecolor($this->canvas['width'], $this->canvas['height']) 
                    or exit('Cannot Initialize new GD image stream');
            $this->bgcolor = imagecolorallocate($this->img, $bgrgb[0], $bgrgb[1], $bgrgb[2]);
            imagefill($this->img, 0, 0, $this->bgcolor);

            $this->shapeSize['width'] = $newShape[0]; $this->shapeSize['height'] = $newShape[1];
            $newPos[1] = $this->canvas['height'] - $newPos[1];
            $this->xyLoc['x'] = $newPos[0]; $this->xyLoc['y'] = $newPos[1];
            $this->fgcolor = imagecolorallocate($this->img, $fgrgb[0], $fgrgb[1], $fgrgb[2]);
        }
    }

    // Create a canvas object with a triangle shape that can be manipulated and
    // drawn multiple times before being displayed
    class Triangle {
        private $xyLocs = array(0,0,0,0,0,0);
        private $center = array('x' => 0, 'y' => 0);
        private $shapeSize = 0;
        private $fgcolor;
        private $bgcolor;
        private $canvas = array('width' => 0, 'height' => 0);
        private $img;

        // Increase size of triangle by moving points away from each other by a given amount
        function bigger($newSize) {
            if ($this->xyLocs[1] < $this->xyLocs[3]) {
                $this->xyLocs[1] -= $newSize;
                $this->xyLocs[3] += $newSize;
                $this->xyLocs[5] += $newSize;
            } else {
                $this->xyLocs[1] += $newSize;
                $this->xyLocs[3] -= $newSize;
                $this->xyLocs[5] -= $newSize;
            }
            $this->xyLocs[2] -= $newSize;
            $this->xyLocs[4] += $newSize;
            
        }
        // Decrease size of triangle by moving points towards each other by a given amount
        function smaller($newSize) {
            // Disallow operation if it will cause triangle to 'flip' vertically
            if (($this->xyLocs[2] + $newSize) > ($this->xyLocs[4] - $newSize)) {
                return;
            }
            // Determine orientation of triangle prior to Y adjustments
            if ($this->xyLocs[1] < $this->xyLocs[3]) {
                // Disallow operation if it will cause triangle to 'flip' vertically
                if (($this->xyLocs[3] - $newSize) < ($this->xyLocs[1] + $newSize)) {
                    return;
                }
                $this->xyLocs[1] += $newSize;
                $this->xyLocs[3] -= $newSize;
                $this->xyLocs[5] -= $newSize;
            } else {
                // Disallow operation if it will cause triangle to 'flip' vertically
                if (($this->xyLocs[1] - $newSize) < ($this->xyLocs[3] + $newSize)) {
                    return;
                }
                $this->xyLocs[1] -= $newSize;
                $this->xyLocs[3] += $newSize;
                $this->xyLocs[5] += $newSize;
            }
            // Adjust X coordinates
            $this->xyLocs[2] += $newSize;
            $this->xyLocs[4] -= $newSize;
        }
        // Adjust all points on the triangle to the left by a given amount
        function moveLeft($decreaseX) {
            $leftMost = 0; $rightMost = 0; $xCenter = 0;
            // Determine center X position of triangle based on furthest left and right points
            for ($i = 0; $i < 6; $i += 2) {
                if($this->xyLocs[$i] < $leftMost) {
                    $leftMost = $this->xyLocs[$i];
                }
                if($this->xyLocs[$i] > $rightMost) {
                    $rightMost = $this->xyLocs[$i];
                }
            }
            $newCenter = $leftMost + (($rightMost - $leftMost) / 2);
            // Allow move if center of shape will remain on screen
            if (($newCenter - $decreaseX) >= 0) {
                for ($i = 0; $i < 6; $i += 2) {
                    $this->xyLocs[$i] -= $decreaseX;
                }
            }
        }
        // Adjust all points on the triangle to the right by a given amount
        function moveRight($increaseX) {
            $leftMost = 0; $rightMost = 0; $xCenter = 0;
            // Determine center X position of triangle based on furthest left and right points
            for ($i = 0; $i < 6; $i += 2) {
                if($this->xyLocs[$i] < $leftMost) {
                    $leftMost = $this->xyLocs[$i];
                }
                if($this->xyLocs[$i] > $rightMost) {
                    $rightMost = $this->xyLocs[$i];
                }
            }
            $xCenter = $leftMost + (($rightMost - $leftMost) / 2);
            // Allow move if center of shape will remain on screen
            if (($xCenter + $increaseX) <= $this->canvas['width']) {
                for ($i = 0; $i < 6; $i += 2) {
                    $this->xyLocs[$i] += $increaseX;
                }
            }
        }
        // Adjust all points on the triangle upwards by a given amount
        function moveUp ($decreaseY) {
            $topMost = 0; $botMost = 0; $yCenter = 0;
            // Determine center y position of triangle based on highest and lowest points
            for ($i = 1; $i < 6; $i += 2) {
                if($this->xyLocs[$i] < $topMost) {
                    $topMost = $this->xyLocs[$i];
                }
                if($this->xyLocs[$i] > $botMost) {
                    $botMost = $this->xyLocs[$i];
                }
            }
            $yCenter = $topMost + (($botMost - $topMost) / 2);
            // Allow move if center of shape will remain on screen
            if (($yCenter - $decreaseY) >= 0) {
                for ($i = 1; $i < 6; $i += 2) {
                    $this->xyLocs[$i] -= $decreaseY;
                }
            }
        }
        // Adjust all points on the triangle downwards by a given amount
        function moveDown($increaseY) {
            $topMost = 0; $botMost = 0; $yCenter = 0;
            // Determine center y position of triangle based on highest and lowest points
            for ($i = 1; $i < 6; $i += 2) {
                if($this->xyLocs[$i] < $topMost) {
                    $topMost = $this->xyLocs[$i];
                }
                if($this->xyLocs[$i] > $botMost) {
                    $botMost = $this->xyLocs[$i];
                }
            }
            $yCenter = $topMost + (($botMost - $topMost) / 2);
            // Allow move if center of shape will remain on screen
            if (($yCenter + $increaseY) <= $this->canvas['height']) {
                for ($i = 1; $i < 6; $i += 2) {
                    $this->xyLocs[$i] += $increaseY;
                }
            }
        }
        // Flip an equilateral triangle on the horizontal axis
        function horizontalFlip() {
            $yOffset = (int)(0.5 * $this->shapeSize / cos(deg2rad(30)));
            $height = (int)($this->shapeSize * sin(deg2rad(60)));
            $this->xyLocs[0] = $this->center['x'];
            $this->xyLocs[1] = (int)($this->center['y'] + $yOffset);
            $this->xyLocs[2] = $this->center['x'] - 0.5 * $this->shapeSize;
            $this->xyLocs[3] = (int)($this->center['y'] - ($height - $yOffset));
            $this->xyLocs[4] = $this->center['x'] + 0.5 * $this->shapeSize;
            $this->xyLocs[5] = (int)($this->center['y'] - ($height - $yOffset));
        }
        // Draw shape to canvas
        function draw() {
            imagepolygon($this->img, $this->xyLocs, 3, $this->fgcolor);
        }
        // Output canvas to buffer
        function display() {
            header("Content-Type: image/png");
            imagepng($this->img);
            imagedestroy($this->img);
        }
        // Draw a specifically equilateral triangle provided the center point of the triangle
        // and the length of the sides
        function createEquilateral($sideLength, $newCenter, $fgrgb) {
            $this->shapeSize = $sideLength;
            $this->center['x'] = $newCenter[0]; $this->center['y'] = $newCenter[1];
            $this->fgcolor = imagecolorallocate($this->img, $fgrgb[0], $fgrgb[1], $fgrgb[2]);
            // Assign vertices based on trig calculations from center point
            $this->xyLocs[0] = $this->center['x'];
            $this->xyLocs[1] = (int)($this->center['y'] - (0.5 * $sideLength / cos(deg2rad(30))));
            $this->xyLocs[2] = $this->center['x'] - 0.5 * $sideLength;
            $this->xyLocs[3] = (int)($this->center['y'] + (0.5 * $sideLength * tan(deg2rad(30))));
            $this->xyLocs[4] = $this->center['x'] + 0.5 * $sideLength;
            $this->xyLocs[5] = (int)($this->center['y'] + (0.5 * $sideLength * tan(deg2rad(30))));

        }
        // Create canvas and fill with provided colour
        function __construct($newCanvas, $bgrgb) {
            $this->canvas['width'] = $newCanvas[0]; $this->canvas['height'] = $newCanvas[1];
            $this->img = imagecreatetruecolor($this->canvas['width'], $this->canvas['height']) 
                    or exit('Cannot Initialize new GD image stream');
            $this->bgcolor = imagecolorallocate($this->img, $bgrgb[0], $bgrgb[1], $bgrgb[2]);
            imagefill($this->img, 0, 0, $this->bgcolor);
        }
    }

    // Create a canvas object with an ellipse shape that can be manipulated and
    // drawn multiple times before being displayed
    class Ellipse {
        private $xyLoc = array('x' => 0, 'y' => 0);
        private $shapeSize = array('width' => 0, 'height' => 0);
        private $fgcolor;
        private $bgcolor;
        private $canvas = array('width' => 0, 'height' => 0);
        private $img;
        // Increase size of circle
        function bigger($newSize) {
            $this->shapeSize['width'] += $newSize[0];
            $this->shapeSize['height'] += $newSize[1];
        }
        // Decrease size of circle
        function smaller($newSize) {
            $this->shapeSize['width'] -= $newSize[0];
            $this->shapeSize['height'] -= $newSize[1];
        }
        // Increase size of circle
        function moveLeft($decreaseX) {
            // Allow left move for positive values where the center of the circle will not leave the canvas
            if ($decreaseX > 0 && ($this->xyLoc['x'] - $decreaseX) > 0) {
                $this->xyLoc['x'] -= $decreaseX;
            }
        }
        // Move object to the right by the given amount
        function moveRight($increaseX) {
            // Allow right move for positive values where the center of the circle will not leave the canvas
            if ($increaseX > 0 && ($this->xyLoc['x'] + $increaseX) < $this->canvas['width']) {
                $this->xyLoc['x'] += $increaseX;
            }
        }
        // Move object upwards by the given amount
        function moveUp ($decreaseY) {
            // Allow up move for positive values where the center of the circle will not leave the canvas
            if ($decreaseY > 0 && ($this->xyLoc['y'] - $decreaseY) > 0) {
                $this->xyLoc['y'] -= $decreaseY;
            }
        }
        // Move object downwards by the given amount
        function moveDown($increaseY) {
            // Allow down move for positive values where the center of the circle will not leave the canvas
            if ($increaseY > 0 && ($this->xyLoc['y'] + $increaseY) < $this->canvas['width']) {
                $this->xyLoc['y'] += $increaseY;
            }
        }
        // Draw shape to canvas
        function draw() {
            imageellipse($this->img, $this->xyLoc['x'], $this->xyLoc['y'], $this->shapeSize['width'],
                $this->shapeSize['height'], $this->fgcolor);
        }
        // Output canvas to buffer
        function display() {
            header("Content-Type: image/png");
            imagepng($this->img);
            imagedestroy($this->img);
        }
        // Create canvas and fill with provided colour, and assign ellipse parameters
        function __construct($newCanvas, $bgrgb, $newShape, $newPos, $fgrgb) {
            $this->canvas['width'] = $newCanvas[0]; $this->canvas['height'] = $newCanvas[1];
            $this->img = imagecreatetruecolor($this->canvas['width'], $this->canvas['height']) 
                    or exit('Cannot Initialize new GD image stream');
            $this->bgcolor = imagecolorallocate($this->img, $bgrgb[0], $bgrgb[1], $bgrgb[2]);
            imagefill($this->img, 0, 0, $this->bgcolor);

            $this->shapeSize['width'] = $newShape[0]; $this->shapeSize['height'] = $newShape[1];
            $newPos[1] = $this->canvas['height'] - $newPos[1];
            $this->xyLoc['x'] = $newPos[0]; $this->xyLoc['y'] = $newPos[1];
            $this->fgcolor = imagecolorallocate($this->img, $fgrgb[0], $fgrgb[1], $fgrgb[2]);
        }
    }
?>