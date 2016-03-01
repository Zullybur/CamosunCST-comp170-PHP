#include <stdio.h>
#include <stdlib.h> 
#include <time.h>

// Lab Number: 1
// Program Name: Assignment 1 C Modified
// Author Name: Matthew Casiro
// Author Email: mattcasiro@gmail.com
// Submission Date: Jan 5th 2016
// Est. Time to Complete: 2hrs
// Act. Time to Complete: 3hrs
// Program Description: Displays time, query string (s/b user name), and a random number in browser
// How to Run Program: navigate to deepblue.cs.camosun.bc.ca/~cst583/comp170/ass1/ass1cmod.cgi
// Files Required to Run: ass1cmod.cgi on deepblue

int main () {
   time_t result;
   result = time(NULL);

   // Seed the random number generator. 
   srand(time(NULL));

   // Send the header 
   printf("Content-type:text/html\n\n");

   // HTML 
   printf("<html><title>C Example</title></head><body>");

   //Print program run time
   printf("Program ran at local time: %s<br>\n", asctime(localtime(&result)));
   
   // Display the environment variable QUERY_STRING"
   printf("The requesting user is: %20s<br>\n", getenv("QUERY_STRING"));

   // Generate a random number
   printf("A random number is:%10d\n ", rand());

   // Close the HTML 
   printf("</body></html>");

}