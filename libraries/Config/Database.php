<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    // Connection settings
    private static $dbName = 'ecommerce';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    // The connection object to be used and returned until disconnect() is called
    private static $connection = null;

    // Default constructor. Must not be called, so the script dies when done so
    public function __construct()
    {
        self::connect();
    }

    // returns the database connection object
    public static function connect()
    {
        // One connection through whole application
        if (null == self::$connection) {
            try {
                self::$connection = mysqli_connect(self::$dbHost, self::$dbUsername, self::$dbUserPassword, self::$dbName);
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }
        // Finally, return the connection
        return self::$connection;
    }

    // Disconnect
    public function __destruct()
    {
        self::$connection->close();
    }
}

?>