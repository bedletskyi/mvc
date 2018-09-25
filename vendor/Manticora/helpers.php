<?php

function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}

function view($view, $data = null, $layout = 'layout\layout') {
    vendor\Manticora\core\View::render($view, $data, $layout);
}