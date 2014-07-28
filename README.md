Symfony2 Demo for new comers.
Implement a very simple calculator using some of the key framework features like :
* Dependency Injection
* DI Tags
* Twig
* Unitaty tests
* Data structure serialization
* Communication with Mysql using Doctrine2
* Communication with Riak using RiakBundle
* ...

## Step 0

* Create a component called *calculator*
* Create VirtualHost on port 8887 on local MAMP
* Open this component into PHPStorm 7

## Step 1

* Create a CalculatorBundle with 2 pages :
   * homepage (/) : a form to enter tow operand and an operator (+, -, *, /)
   * result (/compute) : a text displaying the operation (ie : 2 + 3 = 5)
* One functional test that check if /compute?operand-a=2&operand-b=3&operator=add contains 5
* Run tests from PHPStorm
* Create repository on GitHub to host your component
* Configure CI on CloudBees and make first run to succeed

# Step 2

* Create a DataModel and test it
* Refactor controller to remove some logic from it
* PHPUnit : test using multiple cases and test exceptions
* Use services on your test classes

# Step 3

* Move some logic from a service to model classes
* Use a CompilerPass to automatically register Operators
* PHPUnit : use mocks, test abstract classes

# Step 4

* Split CalculatorBundle into CalculatorUIBundle and CalculatorAPIBundle
* CalculatorAPIBundle offers 2 pages :
   * /{operandA}/{operandB}/{operator}.json
   * /{operandA}/{operandB}/{operator}.xml
* Use HTTP requests with curl to communicate between bundles
* Use refactoring tools in PHPStorm to ease refactoring tasks

# Step 5

* Use automatic serialization tool
* Discover special route parameters like _format
* Test serialization

# Step 6

* Extract CalculatorModelBundle to share models and webservice clients
* Use Guzzle to perform HTTP communications
* Inject Plugins into Guzzle to ease testing

# Step 7

* Extract CalculatorModelBundle as a separate bundle which can be used in multiple applications
* Play with composer stability feature

# Step 8

* Add design on our application
* Use Cssembed to embed images into stylesheets
* Use YUICompressor to compress javascript and stylesheets
* Use assetic to merge multiples files into one single file and version it
* Use Twig's "macros" to share code between home and result pages
* Use Twig's "extends" to share the same layout between the two pages
* Use path function to generate URLs

# Step 9

* Configure all routes to be localized
* Use "requirement" keyword in routing
* Use simple and complex translations

# Step 10

* Use forms and validators

# Step 11

* Add HTTP cache on API calls
* Add business cache inside API

# Step 12

* Store operations into Doctrine

# Step 13

* Store operations into Riak
* Use Riak as a cache layer