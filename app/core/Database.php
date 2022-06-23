<?php

namespace App\Native\Core;

use PDO;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(string $env = "test")
    {
        if (self::$connection == null) {
            require_once __DIR__ . "/../config/database.php";
            $config = getDatabaseConfig();
            self::$connection = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password'],
            );
        }

        return self::$connection;
    }
}
