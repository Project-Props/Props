Views
=====

This folder contains HTML views.

A view is a representation of the entities in the database that the user can look at and interact with.

A view is made up of two parts:

## The generic view class

The view class, located in "lib/view.php" is responsible for logic related to rendering a specific view and other behavior related to that.

The view class is made to be generic so that it can render any view template. This means that each template does not need its own view class.

## The view templates

The view templates are the actual HTML files themselves. These are the files that the view class will show to the user. They are the ones that contain links, buttons, and forms that the user can interact with.

A view template can have PHP embedded inside it and while that often will be the case, its not required.
