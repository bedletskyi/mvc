<?php

namespace vendor\Manticora\core;


class Config
{
    /*
     * Configuration data array
     */
    private static $_config = null;


    private function __construct () {}

    protected function __clone () {}

    protected function __wakeup () {}

    /*
     * Getting data from a configuration file
     */
    private static function init()
    {
        $file = BASE_DIR . '\config.ini';
        if (file_exists($file)) {
            self::$_config = parse_ini_file( $file);
        } else {
            throw new \Exception("File $file not found.");
        }
    }

    /*
     * Get configuration data
     * Return array
     */
    public static function get($params = null)
    {
        if (self::$_config == null) {
            self::init();
        }

        if ($params != null || is_array($params)) {
            $result = array();
            foreach ($params as $param) {
                $result[$param] = self::$_config[$param];
            }
            return $result;
        }
        return self::$_config;
    }
}