#! /usr/bin/python

# Lab Number: 1
# Program Name: Assignment 1 Python Modified
# Author Name: Matthew Casiro
# Author Email: mattcasiro@gmail.com
# Submission Date: Jan 5th 2016
# Est. Time to Complete: 2hrs
# Act. Time to Complete: 3hrs
# Program Description: Displays time, query string (s/b user name), and a random number in browser
# How to Run Program: navigate to deepblue.cs.camosun.bc.ca/~cst583/comp170/ass1/ass1pythonmod.cgi
# Files Required to Run: ass1pythonmod.cgi on deepblue

import os, random, time

now = time.localtime()

print "Content-type:text/html\n\n"

# Print run time and date:
print "Program ran at local time: %02d-%02d-%02d %02d:%02d<br>\n" % (now[0],now[1],now[2],now[3],now[4])

# Print user name from URL:
print "The requesting user is: ", os.environ['QUERY_STRING'], "<br>\n"

# Print random number:
print "A random number is:", random.randint(1,100), "\n"

