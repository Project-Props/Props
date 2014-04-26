Props
=====

Installing dependencies
-----------------------

3rd party dependencies are managed with [Composer](https://getcomposer.org).

Once you have installed Composer dependencies can be installed with `composer install`.

If you've added some new dependencies install them with `composer update`.

Running the tests
-----------------

Tests are written using [PHPUnit](http://phpunit.de). See their website for documentation on how to write them.

Test doubles and mocks are made using [Mockery](https://github.com/padraic/mockery).

Both PHPUnit and Mockery will be installed when you run `composer install`.

To run all the tests run `vendor/bin/phpunit --colors tests/*`.

Building the documentation
--------------------------

Documentation is built using [phpDocumentor](http://phpdoc.org).

To build the documentation run `vendor/bin/phpdoc.php`.
