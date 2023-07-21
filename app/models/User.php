<?php 
namespace App\Models;
use App\Config\Database;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    
    public function __construct($id, $name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getEmail()
    {
        return $this->email;
    }    
       
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
    
    public function save()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare('INSERT INTO users ( name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([ $this->name, $this->email, $hash]);
        $this->id = $connection->lastInsertId();
    }
    
    public static function findAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM users');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public static function findByEmail($email)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return null;
        }
        
        return new User($user['id'],$user['name'], $user['email'], $user['password']);
    }
    
    public static function findById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return null;
        }
        
        return new User($user['id'],$user['name'], $user['email'], $user['password']);
    }
    
    public function update()
    {
       
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');
        $stmt->execute([$this->name, $this->email, $this->id]);
    }
    
    public static function delete($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }
}
