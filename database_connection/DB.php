<?php
require_once 'config.php';
class DB
{
    private static $pdo = null;

    // Connect to the database
    public static function connect()
    {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$pdo;
    }
}