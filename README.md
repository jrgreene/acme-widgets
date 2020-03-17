# Acme Widget Co Sales System

This is a proof of concept for the new Acme widget sales system. It includes support for a basket 
with delivery charge rules and offers. It is designed to be easily expandable to allow rules
and offers to be added as needed.

## Setup with Lando

This project utilizes Lando to allow new developers to set up their development environments and quickly get started.
To use Lando download and install it from https://lando.dev.

Once installed, set up your project with the following command:

``lando start``

Next, you can easily access the CLI as follows:

``lando ssh``

Finally, inside the CLI install composer:

``composer install``

## Unit Testing

To set up unit tests, first copy the phpunit.xml.dist file and rename it as phpunit.xml.

Next, run unit tests with the following command:

``composer test``

## Adding products, rules, and offers

By default, this project contains only the implementation for the Basket class. It has been tested, however, with
various mocked products, rules, and offers to ensure that it is functioning as expected.

To add actual products, rules, and offers for production use, simply implement their respective interfaces and
inject them into the Basket class.
