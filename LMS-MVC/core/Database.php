<?php

namespace App\Core;

use \PDO;

class DB
{
    private static $pdo;

    private static function connect()
    {
        $string = DB_CONNECTION . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
        self::$pdo = new PDO($string, DB_USER , DB_PASS);
    }

   public static function query($query, $data = [])
   {
        self::connect();

        $stmt = self::$pdo->prepare($query);
        $stmt->execute($data);

        self::$pdo = null;

        return $stmt;
   }
}
