<?php

namespace vendor\Manticora;


use vendor\Manticora\core\Config;

class Manticora
{
    /*
     * Connecting basic modules of the framework
     */
    public static function run()
    {
        session_start();

        // Include helpers functions
        require __DIR__ . '/helpers.php';

         // Error and Exception handling
        error_reporting(E_ALL);
        set_error_handler("vendor\Manticora\core\Error::errorHandler");
        set_exception_handler( "vendor\Manticora\core\Error::exceptionHandler");


        // Include route
        require  BASE_DIR . '/app/Route.php';
    }
}