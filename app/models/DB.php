<?php

class DB
{
    private static $_db = null;

    public static function getInstance()
    {
        if (self::$_db === null)
            self::$_db = new PDO("mysql:host=localhost;port=3306;dbname=links_alias_db;charset=utf8mb4", 'root', '');

        return self::$_db;
    }

    private function __construct() {}
    private function __clone() {}
    public function __wakeup()
    {
        throw new Exception('La deserializzazione non è permessa per evitare la creazione di una nuova istanza.');
    }
}
