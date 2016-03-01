<?php
// Lab Number: 8
// Program Name: MVC Controller Module
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: TODO
// Est. Time to Complete: 7 hours
// Act. Time to Complete: TODO
// Program Description: Communicate between View and Model
//      to submit and display query results
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/

// Include Model and XML creation files or exit
((require_once 'ass8Model.inc') && (require_once 'ass8ToXml.inc')) || exit("Unable to load Model or View.<br>\n");
// Validate input or exit if POST is null
if(!$_POST) {
    exit();
}
if(!$select || !$from) {
    exit("Missing input in SELECT or FROM.<br>\n");
}
if(!is_numeric($whereCode) || $whereCode < 0 || $whereCode > 6) {
    exit("Invalid input in WHERE condition.<br>\n");
}
// Sanitize input against any malicious code
$filter = '/=|<|>|!|;|\bselect\b|\bfrom\b|\bwhere\b|\blike\b|\binsert\b|'.
        '\bdelete\b|\bcreate\b|\bdrop\b|\btable\b|\bload\b|\breplace\b|'.
        '\bupdate\bdo\b|\bhandler\b|\balter\b|\bset\b/i';
$select = htmlspecialchars(strip_tags(trim($_POST['uSelect'])), ENT_NOQUOTES);
$from = htmlspecialchars(strip_tags(trim($_POST['uFrom'])));
$where = htmlspecialchars(strip_tags(trim($_POST['uWhere'])));
$whereCode = htmlspecialchars(strip_tags(trim($_POST['operator'])));
$whereCondition = htmlspecialchars(strip_tags(trim($_POST['uWhereCondition'])), ENT_NOQUOTES);
// Exit if forbidden terms detected
if (preg_match($filter, $select) ||
    preg_match($filter, $from) ||
    preg_match($filter, $where) ||
    preg_match($filter, $whereCondition) ||
    preg_match($filter, $whereCode)) {
    exit();
}
// Prepare query string for submission to model
$select = null; $from = null; $where = null; $whereCondition = null;
$op = array('=', '!=', '>', '>=', '<', '<=', 'LIKE');
$query = "SELECT $select\nFROM $from";
if($where && $whereCondition) {
    $queryString = "$query\nWHERE $where ".$op[$whereCode]." $whereCondition\n";
}
// Request output from model
$result = getQuery($queryString);
// Convert output to XML and close query
$xmlResult = toXml($result);
closeQuery();
// Send to View
header('Content-Type: text/xml');
echo $xmlResult;
?>