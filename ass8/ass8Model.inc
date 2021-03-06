<?php
// Lab Number: 8
// Program Name: MySQL Query Model
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Feb 29 2016
// Est. Time to Complete: 7 hours
// Act. Time to Complete: 6.5 hours
// Program Description: Connect to server and database
//      and submit/return query provided by controller
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/
// Files Required to Run: ass8Model.inc, ass8Controller.php, ass8ToXml.inc
//      ass8View.xsl, index.html, form.css

function getQuery($queryString) {
    // Include file with database specific information or exit
    (require_once '../../../dbInfo.inc') or exit("Unable to load server/database credentials.<br>\n");
    // Connect to server and verify connection
    ($LinkID = mysqli_connect($host, $login, $pwd)) or exit("Unable to connect to db server.<br>\n".mysqli_error($LinkID));
    // Connect to database and verify connection
    (mysqli_select_db($LinkID, $dbID)) or exit("Unable to connect to database.<br>\n".mysqli_error($LinkID));
    // Query database and return result
    $result = mysqli_query($LinkID, $queryString);
    $i = 0;
    while($x = mysqli_fetch_assoc($result)) {
        $resultArray[$i] = $x;
        $i++;
    }
    return $resultArray;
}
?>