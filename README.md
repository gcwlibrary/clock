About CLOCK
=====

The CLOCK project was a joint, JISC funded project from the University of Lincoln and Cambridge University. You can find more about the project here: http://clock.blogs.lincoln.ac.uk/

The software
====

This repository represents a collection of modules, developed in PHP, designed to demonstrate how open data principles could be applied to collaborative cataloguing.

The modules are presented in a CodeIgniter framework but are written as separate PHP applications which do not require CodeIgniter to run. It was the intention to incorporate the module frameworks into CodeIgniter, however this was not possible within the CLOCK timeframe.

The modules are as follows...

searchmydata - this module takes the concept of distributed search and applies it to SPARQL endpoints. This concept was abandoned early in the project due to the heavy nature of querying multiple distributed endpoints.

comparemydata - this module forms the core of the CLOCK concepts, taking a number of endpoints, translating the data provided into a standardised format by using a comma delimited "translation file" and comparing the results to identify any differences in the provided data. The proposed expansion for this concept is the localised index of all available endpoints, allowing for easy, quick searching and comparing.

buildmydata - this module demonstrates how a record can be built or rebuilt from the compared data. The proposal would be that this record could then be exported as a Marc Record or imported directly into the organisations database.

Using the code
====

Please feel free to fork the code in this repository and use it for your own projects. Particular interest would be the universal translator and the comparison module which are intended to work with any machine readable dataset, not just bibliographic data.

To run the example modules you may have to edit the function.php files and set some variables specific to your environment.