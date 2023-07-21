<?php 
namespace App\Models;
use App\Config\Database;

class ProductType
{
    private $id;
    private $name;
    private $taxPercentage;
    
    public function __construct($name, $taxPercentage)
    {
        $this->name = $name;
        $this->taxPercentage = $taxPercentage;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }
    
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }
    
    public function save()
{
    $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
    $db->connect();
    $connection = $db->getConnection();

    $stmt = $connection->prepare('INSERT INTO product_types (name, tax_percentage) VALUES (?, ?)');
    $success = $stmt->execute([$this->name, $this->taxPercentage]);

    if (!$success) {
        $errorInfo = $stmt->errorInfo();
        throw new \RuntimeException("Failed to save ProductType to the database: {$errorInfo[2]}");
    }

    $this->id = $connection->lastInsertId();
    if (!$this->id) {
        throw new \RuntimeException("Failed to get a valid ID after saving ProductType to the database.");
    }
}

    
    public static function fetchAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->query('SELECT * FROM product_types');
        return $stmt->fetchAll();
    }
    
    public static function findById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM product_types WHERE id = ?');
        $stmt->execute([
            $id
        ]);
        $productTypeData = $stmt->fetch();
        
        if (!$productTypeData) {
            return null;
        }
        
        $productType = new ProductType($productTypeData['name'], $productTypeData['tax_percentage']);
        $productType->setId($productTypeData['id']);
        
        return $productType;
    }
    
    public function update()
    {
        
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('UPDATE product_types SET name = ?, tax_percentage = ? WHERE id = ?');
        $stmt->execute([
            $this->name,
            $this->taxPercentage,
            $this->id
        ]);
    }
    
    public static function delete($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('DELETE FROM product_types WHERE id = ?');
        $stmt->execute([
            $id
        ]);
    }
}
