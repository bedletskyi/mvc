<?php

namespace vendor\Manticora\core;

use PDO;
use PDOException;


class DB
{
    /*
     * Object PDO
     */
    private static $db = null;


    private function __construct() {}

    /*
     * Make database connection
     */
    private static function init()
    {
        $conf = Config::get();
        try {
            $db = new PDO(
                'mysql:host=' . $conf['db_host'] . ';dbname=' . $conf['db_name'],
                $conf['db_user'],
                $conf['db_password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
            );
            self::$db = $db;
        } catch (PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /*
     * Get PDO instance
     */
    public static function getConnection()
    {
        if (self::$db == null) {
            self::init();
        }

        return self::$db;
    }

    protected function __clone() {}
    protected function __wakeup() {}
}