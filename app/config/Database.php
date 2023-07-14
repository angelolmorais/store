<?php
class Database {
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
