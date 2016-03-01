<?php
// Lab Number: 8
// Program Name: XML Converter
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: TODO
// Est. Time to Complete: 7 hours
// Act. Time to Complete: TODO
// Program Description: Return provided array in XML format
// How to Run Program: navigate to:
//      deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/

// Convert input array to XML
function toXml($queryObject) {
    $dom = new DomDocument("1.0", "ISO-8859-15");
    // Create root node
    $root = $dom->createElement('root');
    $$dom->appendChild($root);
    // Create query node for a single query result
    $query = $dom->createElement('query');
    $root->appendChild($query);
    // Create entry nodes as child of query containing 
    // key value pairs for one row per entry
    while($rowArray=mysqli_fetch_assoc($queryObject)) {
        $entry = $dom->createElement('entry');
        $query->appendChild($entry);
        foreach($array as $key => $val) {
            $rowElem = $dom->createElement($key, $val);
            $entry->appendChild($rowElem)
        }
    }
    // Format output, create and return XML file
    $dom->formatOutput = true;
    $final = $dom->saveXML();
    return $final;
}
?>
<?php/*
// Convert the input array to XML
function toXML($inArray) {
$document = new DomDocument("1.0", "ISO-8859-15");

// create the root node
$root = $document->createElement('root');
$root = $document->appendChild($root);

// create the title node
$elemt = $document->createElement('title');
$elemt = $root->appendChild($elemt);

$elem0 = $document->createTextNode($inArray['name']);
$elem0 = $elemt->appendChild($elem0);

// create the input data node
$elem1 = $document->createElement('Input');
$elem1 = $root->appendChild($elem1);

// create the input title node
$elemt = $document->createElement('title');
$elemt = $elem1->appendChild($elemt);

$elem0 = $document->createTextNode($inArray['inTitle']);
$elem0 = $elemt->appendChild($elem0);

foreach ($inArray['inValue'] as $name => $value) {
// add a child node for each input entry
$entry = $document->createElement('entry');
$entry = $elem1->appendChild($entry);

$child = $document->createElement('name');
$child = $entry->appendChild($child);

$v0 = $document->createTextNode($name);
$v0 = $child->appendChild($v0);

$child = $document->createElement('value');
$child = $entry->appendChild($child);

$v1 = $document->createTextNode($value);
$v1 = $child->appendChild($v1);
}
// create the output data node
$elem2 = $document->createElement('Output');
$elem2 = $root->appendChild($elem2);

// create the output title node
$elemt = $document->createElement('title');
$elemt = $elem2->appendChild($elemt);

$elem0 = $document->createTextNode($inArray['outTitle']);
$elem0 = $elemt->appendChild($elem0);

// add a child node for each output entry
foreach ($inArray['outValue'] as $name => $value) {
$entry = $document->createElement('entry');
$entry = $elem2->appendChild($entry);

$child = $document->createElement('name');
$child = $entry->appendChild($child);

$v0 = $document->createTextNode($name);
$v0 = $child->appendChild($v0);

$child = $document->createElement('value');
$child = $entry->appendChild($child);

$v1 = $document->createTextNode($value);
$v1 = $child->appendChild($v1);
}

// return the completed xml document formatted nicely.
$document->formatOutput = true;
$doc = $document->saveXML();

// Split the XML into an array and add in the style sheet information then put it back together into a string.
// $docArray = split("\n", $doc);

// $doc = join("\n", $docArray);
return $doc;
}*/
?>