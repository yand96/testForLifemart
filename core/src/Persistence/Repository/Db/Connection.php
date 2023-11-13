<?php

namespace Persistence\Repository\Db;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection as DbalConnection;

class Connection
{
    private static ?DbalConnection $connection = null;

    public function getConnection(): DbalConnection
    {
        if (is_null(self::$connection)) {
            $connectionParams = [
                'dbname' => $_SERVER['DB_NAME'],
                'user' => $_SERVER['DB_USER'],
                'password' => $_SERVER['DB_PASSWORD'],
                'port' => $_SERVER['DB_PORT'],
                'host' => $_SERVER['DB_HOST'] ?? 'localhost',
                'driver' => 'pdo_mysql',
            ];

            self::$connection =  DriverManager::getConnection($connectionParams);
        }

        return self::$connection;
    }
}