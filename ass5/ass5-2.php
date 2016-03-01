<html>
    <head>
        <title>170 assignment 5-2</title>
        <!--
        Lab Number: 5
        Program Name: USER SQL Script Execution
        Author Name: Matthew Casiro
        Author Email: mattcasiro@gmail.com
        Submission Date: Feb 10 2016
        Est. Time to Complete: 8 hours
        Act. Time to Complete: 10 hours
        Program Description: Provide form for user to submit basic
            SELECT, FROM, and WHERE inputs and run as an SQL query.
        How to Run Program: navigate to:
           http://deepblue.cs.camosun.bc.ca/~cst583/comp170/ass5/
        Files Required to Run: ass5-2.php
        -->
        <style>
            div.row {
                display: block;
                clear: both;
                width: 100%;
            }
            div.left_col {
                clear: left;
                float: left;
                width: 20%;
                text-align: right;
            }
            div.right_col {
                float: left;
                clear: right;
                margin-top: 4px;
                margin-bottom: 3px;
                margin-left: 2%;
                width: 60%;
                text-align: left;
            }
            div.right_col_submit {
                float: left;
                clear: right;
                margin-top: 4px;
                margin-bottom: 3px;
                margin-left: 22%;
                width: 48%;
                text-align: center;
            }
            div.right_col2 {
                float: left;
                margin-top: 4px;
                margin-bottom: 3px;
                margin-left: 2%;
                text-align: left;
                width: 20%;
            }
            div.right_col3 {
                float: left;
                margin-top: 6px;
                margin-bottom: 3px;
                width: 8%;
                text-align: center;
            }
            div.right_col4 {
                margin-top: 4px;
                margin-bottom: 3px;
                float: left;
                clear: right;
                width: 20%;
                text-align: center;
            }
            label {
                font-size: 1.5em;
                font-weight: 900;
            }
            input {
                display: inline-block;
                width: 80%;
                margin: 0 auto;
                vertical-align: middle;
                height: 2em;
                -moz-box-sizing:border-box;
            }
            input.split {
                width: 100%;
                vertical-align: middle;
                height: 2em;
                -moz-box-sizing:border-box;
            }
            input.button {
                clear: both;
                width: 25%;
                font-weight: 800;
                background-color: #00b300;
                -moz-box-sizing:border-box;
            }
        </style>
    </head>
    <body>
        <!-- Generate form for user input of SELECT, FROM, and WHERE
        information where form will call active webpage to display results -->
        <p><b>Please enter a query:</b></p>
        <form action="?" method="post">
            <div class="row">
                <div class="left_col">
                    <label>SELECT</label>
                </div>
                <div class="right_col">
                    <input type="text" name="uSelect" required>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <label>FROM</label>
                </div>
                <div class="right_col">
                    <input type="text" name="uFrom" required>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <label>WHERE</label>
                </div>
                <div class="right_col2">
                    <input class="split" type="text" name="uWhere">
                </div>
                <div class="right_col3">
                    <select name="operator">
                        <option value="0">=</option>
                        <option value="1">!=</option>
                        <option value="2">&gt;</option>
                        <option value="3">&gt;=</option>
                        <option value="4">&lt;</option>
                        <option value="5">&lt;=</option>
                        <option value="6">LIKE</option>
                    </select>
                </div>
                <div class="right_col4">
                    <input class="split" type="text" name="uWhereCondition">
                </div>
            </div>
            <div class="row">
                <div class="right_col_submit">
                    <input type="submit" class="button">
                </div>
            </div>
        </form>
        <div class="row">
            <br><br>
<?php
    error_reporting(0);
    $select = null; $from = null; $where = null; $whereCondition = null;
    $filter = '/=|<|>|!|;|\bselect\b|\bfrom\b|\bwhere\b|\blike\b|\binsert\b|'.
        '\bdelete\b|\bcreate\b|\bdrop\b|\btable\b|\bload\b|\breplace\b|'.
        '\bupdate\bdo\b|\bhandler/i';
    $op = array('=', '!=', '>', '>=', '<', '<=', 'LIKE');

    if(!$_POST){
        exit();
    }else{
        // Clean user input
        $select = htmlspecialchars(strip_tags(trim($_POST['uSelect'])), ENT_NOQUOTES);
        $from = htmlspecialchars(strip_tags(trim($_POST['uFrom'])));
        $where = htmlspecialchars(strip_tags(trim($_POST['uWhere'])));
        $whereCode = htmlspecialchars(strip_tags(trim($_POST['operator'])));
        $whereCondition = htmlspecialchars(strip_tags(trim($_POST['uWhereCondition'])), ENT_NOQUOTES);
        // Exit if malicious queries detected
        if(preg_match($filter, $select) || preg_match($filter, $from) ||
           preg_match($filter, $where) || preg_match($filter, $whereCondition) ||
           preg_match($filter, $whereCode)) {
            exit();
        }
    }
    
    // Exit if required information is missing or tampered with
    if(!$select) {
        exit("Missing input in SELECT. (code 2010-R)");
    }
    if(!$from) {
        exit("Missing input in FROM. (code 2011-R)");
    }
    if(!is_numeric($whereCode) || $whereCode < 0 || $whereCode > 6) {
        exit("Invalid input in WHERE condition. (code 2012-R)");
    }

    // Get SQL login information from file
    $db_loc = '../../../';
    if (file_exists($db_loc . 'sqlinfo')) {
        require $db_loc . 'sqlinfo';
    } else {
        exit("Required file not found - code 1000-R\n");
    }

    // Connect to SQL database and confirm connection, or exit gracefully, then
    // select the correct db and confirm selection, or exit gracefully
    $LinkID = mysqli_connect($host, $login, $pwd);
    if (!$LinkID) {
        exit("Could not connect to SQL – code 1010-R<br>\n"
             . mysqli_error($LinkID));
    }
    mysqli_select_db($LinkID, $dbID) or exit('Database selection failed '.
        '(code 1020-R):'."<br>\n".mysqli_error($LinkID));

    // Build query and send to database to display results
    $query = "SELECT $select\nFROM $from";
    if($where != null && $whereCondition != null) {
        $query = "$query\nWHERE $where ".$op[$whereCode]." $whereCondition\n";
    }
    $result = mysqli_query($LinkID, $query);

    // Fetch a row with the column labels and print
    $x=mysqli_fetch_assoc($result);
    echo "<pre><code>\n"; print_r($x); echo "</pre></code><br>\n";
    echo "Result:";
    echo "<table border=1><tr>";
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
    } while ($x=mysqli_fetch_row($result));
?>
        </table><br>
        </div>
    </body>
</html>