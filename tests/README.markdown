Tests
=====

This folder contains the tests for the application.

There are two kinds of tests:

## Unit tests

A unit test is a test that focuses on testing only a single unit. Normally this would be one class.

The tests tend to be very low level and they are concerned about things like side effects of calling methods and return values of methods.

## Feature tests

A feature test is a test that focuses on testing a feature of the application. This could be that creating a prop through the form in the view works, or viewing the front page showing all the latest props. Its kind of like an automated way to test that something works for real with a real browser, real requests, and real HTML.

A feature tests tends to be very high level and they are concerned with actions that the user would take just as clicking links, filling out form fields, pressing buttons, and then asserting that the right thing gets displayed on the screen.
