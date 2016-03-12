<!--
Lab Number: 10
Program Name: Index
Author Name: Matthew Casiro
Author Email: mattcasiro@gmail.com
Submission Date: March 8 2016
Est. Time to Complete: 5 hours
Act. Time to Complete: TODO hours
Program Description: Form for theme selection and display
How to Run Program: navigate to:
    deepblue.cs.camosun.bc.cs/~cst583/comp170/ass10/
Files Required to Run: TODO
-->
<html>
<head>
    <title>Ass10&mdash;Casiro</title>
</head>
<body>
    <h1 style="text-align: center">Welcome to the Future!</h1>
    <form method="post" action="?">
        <label>Please select theme: </label>
        <select id="themes">
            <option name="default">Default</option>
            <option name="jungle">Jungle Camouflage</option>
            <option name="powerpuff">Powerpuff Girls</option>
            <option name="argentina">Argentina</option>
        </select>
        <input type="submit" value="Save Changes" />
    </form>
</body>
</html>