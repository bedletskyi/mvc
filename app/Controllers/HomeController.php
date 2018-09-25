<?php

namespace app\Controllers;


use vendor\Manticora\core\Controller;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('home');
    }
}