<?php
namespace App\Models;
use App\Config\Database;

class Client
{
    private $id;
    private $name;
    private $email;
    private $phone;

    public function __construct($id, $name, $email, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }
        
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function save()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)');
        $stmt->execute([$this->name, $this->email, $this->phone]);
        $this->id = $connection->lastInsertId();
    }

    public function update()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('UPDATE clients SET name = ?, email = ?, phone = ? WHERE id = ?');
        $stmt->execute([$this->name, $this->email, $this->phone, $this->id]);
    }

    public static function fetchAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM clients');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public static function findById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM clients WHERE id = ?');
        $stmt->execute([$id]);
        $client = $stmt->fetch();
        
        if (!$client) {
            return null;
        }
        
        return new Client($client['id'], $client['name'], $client['email'], $client['phone']);
    }

    public static function delete($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('DELETE FROM clients WHERE id = ?');
        $stmt->execute([$id]);
    }
    public static function findAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('SELECT * FROM clients');
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
