<?php

namespace vendor\Manticora\core;


class View
{
    /*
     * Connection layout and template
     */
    public static function render($view, $data = null, $layout = 'layout\layout')
    {
		if(is_array($data)) {
			extract($data);
		}
		$layout_path = BASE_DIR . '\app\Views\\' . $layout . '.php';
		$template_path = BASE_DIR . '\app\Views\\' . $view . '.php';

		if (file_exists($layout_path)) {
            require $layout_path;
        } else {
            throw new \Exception("$layout_path not found");
        }

    }
}