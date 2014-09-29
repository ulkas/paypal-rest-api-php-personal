paypal-rest-api-php-personal
============================

my personal enhancement to the official paypal php rest api sdk.

added support for recurring payments via billing plans / billing agreements + all its dependent subclasses.

refer to test.php for examples


the files contain the official paypal php sdk for their REST API + my own created classes and modifiers for additional api calls which are not yet included within the sdk.

Installation
============================
- copy the sdk files to your project
- or replace the test api credentials in the bootstrap.php file with your owns
- 

how to create a recurring payment:
============================
refer to test.php file for example
- create a billing plan - specifiy the ocurrence details together with prices
- create a user billing agreement - with the id of the above billing plan this will return a user confirmation url. user than visits this url, confirms the agreement (recurring payment) and than you must execute the agreement (the same way as with normal payment execution)
