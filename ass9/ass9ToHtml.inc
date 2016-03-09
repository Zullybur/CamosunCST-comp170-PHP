<?php
// Lab Number: 9
// Program Name: HTML Converter
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: March 8 2016
// Est. Time to Complete: 2 hours
// Act. Time to Complete: 2 hours
// Program Description: Return provided array in an HTML table
//      to submit and display query results
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass9/
// Files Required to Run: ass9Model.inc, ass9Controller.php, index.html, form.css

/*  
    Code adapted from:
    Comp-170 lecture notes (Deid Reimer)
*/

// Convert input array to html table format and return
function toHtmlTable($queryResults) {
    if(!isset($queryResults[0])){
        exit();
    }
    $final = '<table border="1"><tr>';
    // Set column titles
    foreach($queryResults[0] as $k => $v){
        $final = $final.'<th>'.$k.'</th>';
    }
    $final = $final.'</tr>';
    // Concatenate data one row at a time
    foreach($queryResults as $row) {
        $final = $final.'<tr>';
        foreach($row as $k => $v) {
            $final = $final.'<td>'.$v.'</td>';
        }
        $final = $final.'</tr>';
    }
    $final = $final.'</table>';
    return $final;
}
?>