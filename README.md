# OpenTexts web application

## https://opentexts.world/

The web application powering the [OpenTexts.World](https://opentexts.world/) 
site.

## Installation instructions ##
### Prerequisites: ###
 * [PHP](https://www.php.net/downloads.php) (a modern version such as 7.4)
 * A web server that works with PHP (e.g. [Apache](https://httpd.apache.org/download.cgi))
 * The [PHP Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) dependency manager
    * OpenTexts.World uses the [CodeIgniter](https://codeigniter.com/) MVC framework and the [Solarium](https://solarium.readthedocs.io/en/stable/) [Solr](https://lucene.apache.org/solr/) library but these are installed automatically via Composer

### Step one: Download code and install dependencies ###
* Clone the github repository:
    * `git clone https://github.com/opentexts/opentexts.git`
* Install the PHP composer dependencies:
    * `composer install`

### Configure the webserver environment ###
* Copy the file env to .env in the root directory.
    * While developing, it is useful to edit .env to include `CI_ENVIRONMENT = development` in order to see error messages
* Configure the Apache `DocumentRoot` to point to the public folder of the cloned githuib repository, not the top-level folder
* Configure Apache to allow mod_rewrite

### Request access to the solr index ###
Email Stuart with your IP address (or range) to be added to the solr firewall

## Edit the application ##
The main code to edit to change the user interface are all located in `https://github.com/opentexts/opentexts/tree/main/app/Views`