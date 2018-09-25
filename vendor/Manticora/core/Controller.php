<?php

namespace vendor\Manticora\core;


abstract class Controller
{
    /**
     * Parameters from the matched route
     */
    protected $route_params = array();

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }
}