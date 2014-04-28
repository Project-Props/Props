Props
=====

Installing dependencies
-----------------------

3rd party dependencies are managed with [Composer](https://getcomposer.org).

Once you have installed Composer, dependencies can be installed with `composer install`.

If you've added some new dependencies install them with `composer update`.

Running the tests
-----------------

Make sure to run `composer install` to install the required testing frameworks.

### Unit tests

Unit tests are written using [PHPUnit](http://phpunit.de). See their website for documentation on how to write them.

Test doubles and mocks are made using [Mockery](https://github.com/padraic/mockery).

To run all the unit tests run `vendor/bin/phpunit --colors tests/*`.

### Feature tests

Feature tests are written using [Behat](http://behat.org) with [Mink](http://mink.behat.org).

Write feature tests in `tests/features`. Run them with `vendor/bin/behat`.

**Remember** to copy `behat.yml.sample` to `behat.yml` and then configure `base_url`.

Building the documentation
--------------------------

Documentation is built using [phpDocumentor](http://phpdoc.org).

To build the documentation run `vendor/bin/phpdoc.php`.
