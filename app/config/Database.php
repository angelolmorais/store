<?php

namespace App\Config;

use PDO;
use PDOException;
class Database {
    private static $instance;
    private $host;
    private $port;
    private $dbName;
    private $user;
    private $password;
    private $connection;
    
    public function __construct($host, $port, $dbName, $user, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        }
        return self::$instance;
    }
    
    public function connect() {
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die('Error connecting to the database: ' . $e->getMessage());
        }
    }
    
    public function getConnection() {
        return $this->connection;
    }
}
