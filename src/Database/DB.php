<?php

namespace AncientEgyptianMuseum\Database;

use PDO;
use PDOException;

class DB
{
    private static $pdo;
    private $instance;

    /**
     * Get singleton database connection
     */
    public static function connect()
    {
        if (!self::$pdo) {
            $config = require __DIR__ . '/../../config/database.php';
            try {
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
                self::$pdo = new PDO($dsn, $config['username'], $config['password']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw new PDOException("Could not connect to database");
            }
        }
        return self::$pdo;
    }

    /**
     * Constructor for dependency injection pattern (optional)
     */
    public function __construct($driver = null)
    {
        if ($driver !== null) {
            $this->instance = $driver->connect();
        } else {
            $this->instance = self::connect();
        }
    }

    /**
     * Get PDO connection instance
     */
    public function getConnection(): PDO
    {
        return $this->instance ?? self::connect();
    }

    /**
     * Initialize connection
     */
    public function init()
    {
        return $this->getConnection();
    }
}