<html>
    <head>
        <title>170 assignment 5-1</title>
        <!--
        Lab Number: 5
        Program Name: SET SQL Script Execution
        Author Name: Matthew Casiro
        Author Email: mattcasiro@gmail.com
        Submission Date: Feb 10 2016
        Est. Time to Complete: 8 hours
        Act. Time to Complete: 10 hours
        Program Description: Run three pre-set SQL queries
        How to Run Program: navigate to:
           http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass5/
        Files Required to Run: ass5-1.php
        -->
    </head>
    <body>
<?php
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Q: Do the queries work in Oracle SQL or SQL/92 or both?   *
     *   A: Oracle SQL queries using outer join notation e.g.(+) *
     *      do not appear to be supported by MySQL. Different    *
     *      syntax is required for MySQL. This ORACLE query      *
     *      has been removed from the code below.                *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    // Get SQL login information from file
    $db_loc = '../../../';
    if (file_exists($db_loc . 'sqlinfo')) {
        require $db_loc . 'sqlinfo';
    } else {
        exit("Required file not found - code 1000-R\n");
    }

    // Connect to the MySQL server.
    $LinkID = mysqli_connect($host, $login, $pwd);
    
    // Die if no connect
    if (!$LinkID) {
        exit("Could not connect to SQL – code 1010-R<br>\n"
             . mysqli_error($LinkID));
    }

    // Send query one through three to the DB
    mysqli_select_db($LinkID, $dbID) or exit('Database selection failed '.
        '(code 1020-R):'."<br>\n".mysqli_error($LinkID));
    $result["Q1"] = mysqli_query($LinkID, $Q1_SQL);
    $result["Q2"] = mysqli_query($LinkID, $Q1_ORACLE);
    $result["Q3"] = mysqli_query($LinkID, $Q2_SQL);
    $result["Q4"] = null;
    $result["Q5"] = mysqli_query($LinkID, $Q3_SQL);
    $result["Q6"] = mysqli_query($LinkID, $Q3_ORACLE);
    $i = 1;

    // Display the results.
    do {
        switch ($i){
            case 1:
                echo "<b>Raw Results&mdash;SQL 92 Query #1:</b><br>\n";
                break;
            case 2:
                echo "<b>Raw Results&mdash;Oracle Query #1:</b><br>\n";
                break;
            case 3:
                echo "<b>Raw Results&mdash;SQL 92 Query #2:</b><br>\n";
                break;
            case 4:
                echo "<b>Oracle Query #2 has been REMOVED. Invalid syntax.</b><br><br>\n";
                $i++;
                continue 2;
            case 5:
                echo "<b>Raw Results&mdash;Query #3:</b><br>\n";
                break;
            case 6:
                echo "<b>Raw Results&mdash;Query #3:</b><br>\n";
                break;
            default:
                echo "FATAL ERROR&mdash;TABLE PRINT SEQUENCE";
        }
        if ($result["Q$i"]) {
            while ($x=mysqli_fetch_row($result["Q$i"])) {
                $j = 1;
                foreach($x as $v) {
                    echo ($j<count($x)) ? "$v, " : "$v";
                    $j++;
                }
                echo "<br>\n";
            }
        }
        $i++;
        echo "<br>\n";
    } while ($i <= count($result));
?>
<p>
<?php
    $i = 1;
    do {
        switch ($i) {
            case 1:
                echo "<b>Table Results&mdash;SQL 92 Query #1:</b><br>\n";
                break;
            case 2:
                echo "<b>Table Results&mdash;Oracle Query #1:</b><br>\n";
                break;
            case 3:
                echo "<b>Table Results&mdash;SQL 92 Query #2:</b><br>\n";
                break;
            case 4:
                echo "<b>Oracle Query #2 has been REMOVED. Invalid syntax.</b><br><br>\n";
                $i++;
                continue 2;
            case 5:
                echo "<b>Table Results&mdash;Query #3:</b><br>\n";
                break;
            case 6:
                echo "<b>Table Results&mdash;Query #3:</b><br>\n";
                break;
            default:
                echo "FATAL ERROR&mdash;TABLE PRINT SEQUENCE";
        }
        
        // Reset the result pointer and display again in a table with titles
        mysqli_data_seek($result["Q$i"], 0);

        // Fetch a row with the column labels
        $x=mysqli_fetch_assoc($result["Q$i"]);

        // Print the column labels
        echo "Print table:<table border=1><tr>";
        foreach (array_keys($x) as $k) {
            print "<td><b>$k</b></td>";
        }
        echo "</tr>";

        // Print the rows
        do {
            echo "<tr>\n";
            foreach($x as $v) {
                echo "\t<td>$v</td>\n";
            }
            echo "</tr>\n";
        } while ($x=mysqli_fetch_row($result["Q$i"]));
        echo "</table><br>\n";
        $i++;
    } while ($i <= count($result));
?>
    </body>
</html>