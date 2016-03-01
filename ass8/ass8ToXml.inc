<?php
// Lab Number: 8
// Program Name: XML Converter
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Feb 29 2016
// Est. Time to Complete: 7 hours
// Act. Time to Complete: 6.5 hours
// Program Description: Return provided array in XML format
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/
// Files Required to Run: ass8Model.inc, ass8Controller.php, ass8ToXml.inc
//      ass8View.xsl, index.html, form.css

/*  
    Code adapted from:
    Comp-170 lecture notes (Deid Reimer)
*/

// Convert input array to XML
function toXml($queryObject) {
    $dom = new DomDocument("1.0", "ISO-8859-15");
    // Create root node
    $root = $dom->createElement('root');
    $dom->appendChild($root);
    // Create query node for a single query result
    $query = $dom->createElement('query');
    $root->appendChild($query);
    // Create entry nodes as child of query containing 
    // key value pairs for one row per entry
    while($rowArray=mysqli_fetch_assoc($queryObject)) {
        $entry = $dom->createElement('entry');
        $query->appendChild($entry);
        foreach($rowArray as $key => $val) {
            $rowElem = $dom->createElement($key, $val);
            $entry->appendChild($rowElem);
        }
    }
    // Format output, create and return XML file
    $dom->formatOutput = true;
    $domXml = $dom->saveXML();

    $domArray = split("\n", $domXml);
    array_splice($domArray, 1, 0, '<?xml-stylesheet type="text/xsl" href="ass8View.xsl"?>');
    $final = join("\n", $domArray);
    return $final;
}
?>