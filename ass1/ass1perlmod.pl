#! /usr/bin/perl

# Lab Number: 1
# Program Name: Assignment 1 Perl Modified
# Author Name: Matthew Casiro
# Author Email: mattcasiro@gmail.com
# Submission Date: Jan 5th 2016
# Est. Time to Complete: 2hrs
# Act. Time to Complete: 3hrs
# Program Description: Displays time, query string (s/b user name), and a random number in browser
# How to Run Program: navigate to deepblue.cs.camosun.bc.ca/~cst583/comp170/ass1/ass1perlmod.cgi
# Files Required to Run: ass1perlmod.cgi on deepblue

$foo = localtime(time())
print "Content-type:text/html\n\n";

print "<html><head><title>Random</title></head><body>";

# Print run time and date:
print "Program ran at local time: ", $foo, "<br>\n";

# Print user name from URL:
print "The requesting user is: ", $ENV{'QUERY_STRING'}, "<br>\n";

# Print random number:
print "This is a random number: ", rand (10), "\n";


print "</body></html>";