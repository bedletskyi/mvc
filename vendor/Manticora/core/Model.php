<?php

namespace vendor\Manticora\core;


use PDO;

abstract class Model
{
    public static $db;

    /*
     * Initializing an object to work with a database
     */
    public function __construct()
    {
        self::$db = DB::getConnection();
    }

    /*
     * Executing prepared a database query
     */
    public function query($sql, $data = [])
    {
        $stmt = self::$db->prepare($sql);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $stmt->bindParam(':' . $key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    /*
     * Get all columns from a table
     * Returns an array of objects
     */
    public function row($sql, $data = [])
    {
        $result = $this->query($sql, $data);
        return $result->fetchAll(PDO::FETCH_CLASS);
    }
}