<html>
    <head>
        <title>ass4.php - Matthew Casiro</title>
        <!--
            Lab Number: 4
            Program Name: Apache Log File Parser
            Author Name: Matthew Casiro
            Author Email: mattcasiro@gmail.com
            Submission Date: 03 Feb 2016
            Est. Time to Complete: 2.5 hrs
            Act. Time to Complete: 7.5 hrs
            Program Description: Parse log file to display IP-Byte key value pairs
            How to Run Program: navigate to:
               http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass4/ass4.html
            Files Required to Run: ass4.html, ass4.php
        -->
    </head>
    <body>
<?php
// Acquire and clean user choice from POST
$source = htmlspecialchars(strip_tags(trim($_POST['userSelection'])));
$archive = glob("/var/log/httpd/access_log*");
$sourceRegex = '/access_log.*/';
if (!is_numeric($source) || $source < 0 || $source > 3) {
    $source = 0;
    echo "<p style=\"font-size=2em\">USER INPUT ERROR - SELECTING CURRENT LOG FILE</p>";
}
$source = (int)$source;
preg_match_all($sourceRegex, $archive[$source], $sourceMatches);
?>
        <table>
            <tr>
                <td colspan=2 style="height: 2em; vertical-align: top"><b>Apache Log File, Bytes per IP Aggregation:<br></b></td>
            </tr>
            <tr style="height: 2em; vertical-align: top">
                <td><b>Log File:</b></td>
                <td><?php echo $sourceMatches[0][0]; ?></td>
            </tr>
            <tr>
                <td><b>IP Address:</b></td>
                <td><b>Total Bytes:</b></td>
            </tr>
<?php
// Open specified log file with read permissions for parsing
$file = fopen($archive[$source], 'r');

// Parse IP - Byte combinations to array with IP key and Byte value pairs,
$ipRegex = '/^(\d{1,3}\.){3}\d{1,3}\b/';
$resultCodeRegex = '/(?<=\" )\d{3}(?= \d{1,}\b| - )/';
$byteRegex = '/(?<=\" \d{3} )\d*\b/';
$resultArray = array();
if($file) {
    while(!feof($file)) {
        $input = htmlspecialchars(strip_tags(trim(fgets($file))), ENT_NOQUOTES);
        if($input == null) {
            break;
        }
        preg_match_all($ipRegex, $input, $ipMatches);
        preg_match_all($resultCodeRegex, $input, $resultMatches);
        preg_match_all($byteRegex, $input, $byteMatches);

        // Only retain successful transmission (2xx status code)
        if (!isset($resultMatches[0][0])) {
            $byteMatches[0][0] = 0;
;        } else if ($resultMatches[0][0] < 200 || $resultMatches[0][0] > 299) {
            $byteMatches[0][0] = 0;
        }

        // If bytes transmitted is null, set to zero
        if(!isset($byteMatches[0][0])) {
            $byteMatches[0][0] = 0;
        }

        // Aggregate bytes for repeated IP addresses, ignore IPv6
        if(isset($ipMatches[0][0])) {
            if(!array_key_exists($ipMatches[0][0], $resultArray)) {
                $resultArray[$ipMatches[0][0]] = $byteMatches[0][0];
            } else {
                $resultArray[$ipMatches[0][0]] += $byteMatches[0][0];
            }
        }
    }

    $i = 0; $j = 0;

    // Output totals for each IP address to screen, where bytes > 0 (no sort required)
    foreach($resultArray as $k => $v) {
        $i++;
        if ($v > 0) {
            $j++;
            echo "<tr>\n\t<td>$k</td>\n";
            echo "\t<td>$v</td>\n</tr>\n";
        }
    }
}else{
echo "FATAL ERROR - WHAT HAVE YOU DONE?! (no file found)";
}
?>
            <tr style="height: 2em; vertical-align: middle">
                <td><b>IPs Parsed:</br></td>
                <td><?php echo $i; ?></td>
            </tr>
            <tr style="height: 2em; vertical-align: middle">
                <td><b>IPs With Data:</b></td>
                <td><?php echo $j; ?></td>
            </tr>
        </table>
    </body>
</html>