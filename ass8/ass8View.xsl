<!--
Lab Number: 8
Program Name: View Module
Author Name: Matthew Casiro
Author Email: mattcasiro@gmail.com
Submission Date: Feb 29 2016
Est. Time to Complete: 7 hours
Act. Time to Complete: 6.5 hours
Program Description: Format output for display
How to Run Program: navigate to:
    deepblue.cs.camosun.bc.cs/~cst583/comp170/ass8/
Files Required to Run: ass8Model.inc, ass8Controller.php, ass8ToXml.inc
    ass8View.xsl, index.html, form.css
-->

<!-- 
    Code adapted from:
    Comp-170 lecture notes (Deid Reimer)
 -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
<html>
    <head>
        <title>170 assignment 8</title>
        <link href="form.css" rel="stylesheet" />
    </head>
    <body>
        <form action="ass8Controller.php" method="post">
            <div class="row">
                <div class="left_col">
                    <label>SELECT</label>
                </div>
                <div class="right_col">
                    <input type="text" name="uSelect" required="required" />
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <label>FROM</label>
                </div>
                <div class="right_col">
                    <input type="text" name="uFrom" required="required" />
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <label>WHERE</label>
                </div>
                <div class="right_col2">
                    <input class="split" type="text" name="uWhere" />
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
                    <input class="split" type="text" name="uWhereCondition" />
                </div>
            </div>
            <div class="row">
                <div class="right_col_submit">
                    <input type="submit" class="button" />
                </div>
            </div>
        </form>
            <div class="row">
            <h3>Query Results...</h3>
            <table border="1">
                <tr>
                    <xsl:for-each select="root/query/entry[1]/*">
                        <th><xsl:value-of select="name()"/></th>
                    </xsl:for-each>
                </tr>
                <xsl:for-each select="root/query/entry">
                    <tr>
                        <xsl:for-each select="*">
                            <td><xsl:value-of select="."/></td>
                        </xsl:for-each>
                    </tr>
                </xsl:for-each>
            </table>
        </div>
    </body>
</html>
</xsl:template>
</xsl:stylesheet>