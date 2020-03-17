# Acme Widget Co Sales System

This is a proof of concept for the new Acme widget sales system. It includes support for a basket, 
delivery charge rules, and offers. It is designed to be easily expandable to allow additional rules
and offers to be added.

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
