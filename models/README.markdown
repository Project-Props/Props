Models
======

This folder contains all the domain specific model classes. They all inherit from the `Model` class.

A model class is a class that represents an entity in the application domain. This could a prop, a production, a status and so on. Model objects also have methods for persisting themselves in a database.

Here is a example of using a model class:

```php
// Find a prop in the database and build a model object from it
$prop = Prop::find(1);

// Echo its name attribute. This will return whats in the name column of this row in the database.
echo $prop->name;

// Change some attributes of the object
$prop->description = "An old chair";
$prop->status_id = 2;

// Save changes to the database
$prop->save();
```

A subclass of model must do the following things:

- Have public instance variables that maps to the columns in the database. So if there is an "id" column in the database then the object should have a public instance variable called "id".
- Set the `TABLE_NAME` constant to be the name of table it maps to.
