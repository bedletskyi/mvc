# Welcome to the Manticora PHP MVC framework

This is a simple MVC framework for building web applications in PHP

## Starting an application using this framework

1. First, download the framework, either directly or by cloning the repo.
1. Rename the file [example-config.ini](example-config.ini) to **config.ini** and enter your database configuration data.
1. Create [routes](app/Route.php), add controllers, views and models.

See below for more details.

## Configuration

Configuration settings are stored in the **config.ini** file. Default settings include database connection data and a setting to show or hide error detail. You can access the settings in your code like this: `Config::get()` for access all parameters or `Config::get(['one', 'two'])` for access a few parameters. You can add your own configuration settings in here.

## Routing

The [Router](vendor/Manticora/core/Router.php) translates URLs into controllers and actions. Routes are added in the [Route.php](app/Route.php). A sample home route is included that routes to the `welcome` action in the [HomeController.php](app/Controllers/HomeController.php).

Routes are added with the `add` method. You can add fixed URL routes, and specify the controller and action, like this:

```php
$router->add('', 'HomeController@welcome'); // the default request method 'GET'
$router->add('/index', 'HomeController@welcome', 'POST');
```

Or you can add route **variable**, like this:

```php
$router->add('/index/{id}', 'HomeController@welcome');
```


## Controllers

Controllers are classes that extend the [Controller](vendor/Manticora/core/Controller.php) class.

Controllers are stored in the `app/Controllers` folder. A sample [HomeController](app/Controllers/HomeController.php) included. Controller classes need to be in the `App/Controllers` namespace.

You can access route parameters (for example the **id** parameter shown in the route examples above) in actions via the `$this->route_params` property.

## Views

Views are used to display information. View files go in the `app/Views` folder.

```php
view('home', [
    'name'    => 'John Doe'
]);
```
Or change the default [layout.php](app/Views/layout/layout.php)

```php
view('home', [], 'some_layout');
```

## Models

Models are used to get and store data in your application. They know nothing about how this data is to be presented in the views. Models extend the [Model](vendor/Manticora/core/Model.php) class and use [PDO](http://php.net/manual/en/book.pdo.php) to access the database. They're stored in the `App/Models` folder. A sample user model class is included in [App/Models/Example.php](app/Models/Example.php). You can get data from database like this:

```php
$this->row('SELECT * FROM users');
```

## Errors

If the `debug` configuration setting is set to `true`, full error detail will be shown in the browser if an error or exception occurs. If it's set to `false`, a generic message will be shown using the [app/Views/404.php](app/Views/404.php) or [app/Views/500.php](app/Views/500.php) views, depending on the error.
