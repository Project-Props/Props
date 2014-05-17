Controllers
===========

This folder contains controllers.

A controller is responsible for linking the view and model together. Independently the views and model know nothing about each other. So the controllers are there to kinda bridge the cap.

A controller method normally does one of two things. It either gathers data from the database and presents it to the user (1), or it gets input from the user and saves stuff to the database (2).

The flow of the first type (1) might look like this:

1. Be called when the user visits a certain URL.
2. Look the in the database and construct model objects.
3. Possibly process the model objects in some way.
4. Construct a view.
5. Tell the view about those model objects it made.
6. Render the view.

Here is an example:

```php
class HomeController {
  public function index() {
    // Query the model layer and find the 10 latest props
    $latest_props = array_reverse(array_slice(Prop::all(), -10, 10));

    // Do the same with productions
    $latest_productions = array_reverse(array_slice(Production::all(), -10, 10));

    // Construct a view and tell it about the props and productions it found
    $view = new View("home/index.php", ["props" => $latest_props,
                                        "productions" => $latest_productions]);

    // Render the view
    $view->render();
  }
}
```

The flow of the other type might look like this (2):

1. Be called when the user submits a form. This sends some data to the controller which it can get to with `$this->params(<param name>)`
2. Construct new model objects from the input.
3. Save those objects.
4. Either render the view showing the newly created object or show and error of some kind. This depends on whether the saving was successful or not.

```php
<?php

class PropsController extends Controller {
  public function create() {
    // Create a new prop based on the "prop" parameter array (an associative array that comes from the submitted form).
    $prop = new Prop($this->param("prop"));

    try {
      // Save the prop
      // This might raise a "InvalidQuery" exception
      $prop->save();

      // Notify the user that the save worked
      Flash::set_notice("Prop tilføjet!");

      // Redirect to some URL
      $this->redirect_to("/");
    } catch (InvalidQuery $e) {
      // We only get here if the save call failed

      // Notify the user that there was an error
      Flash::set_alert("Prop ikke tilføjet!");

      // Redirect back to the form
      $this->redirect_to("/props/new");
    }
  }
}
```
