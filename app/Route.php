<?php

use vendor\Manticora\core\Router;

$router = new Router();

$router->add('/', 'HomeController@welcome');

$router->run();