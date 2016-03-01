<?php
// Lab Number: 8
// Program Name: MVC Controller Module
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Feb 29 2016
// Est. Time to Complete: 7 hours
// Act. Time to Complete: 6.5 hours
// Program Description: Communicate between View and Model
//      to submit and display query results
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/
// Files Required to Run: ass8Model.inc, ass8Controller.php, ass8ToXml.inc
//      ass8View.xsl, index.html, form.css

// Include Model and XML creation files or exit
((require_once 'ass8Model.inc') && (require_once 'ass8ToXml.inc')) || exit("Unable to load Model or View.<br>\n");
// Validate input or exit if POST is null
if(!$_POST) {
    exit();
}
// Sanitize input against any malicious code
$select = null; $from = null; $where = null; $whereCondition = null;
$filter = '/=|<|>|!|;|\bselect\b|\bfrom\b|\bwhere\b|\blike\b|\binsert\b|'.
        '\bdelete\b|\bcreate\b|\bdrop\b|\btable\b|\bload\b|\breplace\b|'.
        '\bupdate\bdo\b|\bhandler\b|\balter\b|\bset\b/i';
$select = htmlspecialchars(strip_tags(trim($_POST['uSelect'])), ENT_NOQUOTES);
$from = htmlspecialchars(strip_tags(trim($_POST['uFrom'])));
$where = htmlspecialchars(strip_tags(trim($_POST['uWhere'])));
$whereCode = htmlspecialchars(strip_tags(trim($_POST['operator'])));
$whereCondition = htmlspecialchars(strip_tags(trim($_POST['uWhereCondition'])), ENT_NOQUOTES);
if(!$select || !$from) {
    exit("Missing input in SELECT or FROM.<br>\n");
}
if(!is_numeric($whereCode) || $whereCode < 0 || $whereCode > 6) {
    exit("Invalid input in WHERE condition.<br>\n");
}
// Exit if forbidden terms detected
if (preg_match($filter, $select) ||
    preg_match($filter, $from) ||
    preg_match($filter, $where) ||
    preg_match($filter, $whereCondition) ||
    preg_match($filter, $whereCode)) {
    exit();
}
// Prepare query string for submission to model
$op = array('=', '!=', '>', '>=', '<', '<=', 'LIKE');
$queryString = "SELECT $select\nFROM $from";
if($where && $whereCondition) {
    $queryString = "$queryString\nWHERE $where ".$op[$whereCode]." $whereCondition\n";
}
// Request output from model
$result = getQuery($queryString);
// Convert output to XML and close query
$xmlResult = toXml($result);
// Send to View
header('Content-Type: text/xml');
echo $xmlResult;
?>