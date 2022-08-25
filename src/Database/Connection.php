<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Connection
{
    private static $pdo = null;

    /**
     * Connect to the database and returns an instance of PDO class
     * or false if the connection fails
     */
    public static function connect(): PDO
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                sprintf("%s:host=%s;dbname=%s;charset=UTF8", $_ENV['DB_DRIVER'], $_ENV['DB_HOST'], $_ENV['DB_NAME']),
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$pdo;
    }
}
