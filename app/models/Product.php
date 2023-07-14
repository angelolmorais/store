<?php 
class Product
{
    private $id;
    private $name;
    private $value;
    private $typeId;
    private $taxPercentage;
    
    public function __construct($name, $value, $typeId, $taxPercentage)
    {
        $this->name = $name;
        $this->value = $value;
        $this->typeId = $typeId;
        $this->taxPercentage = $taxPercentage;
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
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getTypeId()
    {
        return $this->typeId;
    }
    
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
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
        
        $stmt = $connection->prepare('INSERT INTO products (name, value, type_id) VALUES (?, ?, ?)');
        $stmt->execute([
            $this->name,
            $this->value,
            $this->typeId
            #$this->taxPercentage
        ]);
    }
    
    public static function fetchAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT
                                        	products.*,
                                        	product_types.name AS type_name,
                                        	product_types.tax_percentage
                                        FROM
                                        	products
                                        LEFT JOIN product_types ON products.type_id = product_types.ID');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public static function findById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT
                                        	products.*,
                                        	product_types.name AS type_name,
                                        	product_types.tax_percentage
                                        FROM
                                        	products
                                        JOIN product_types ON products.type_id = product_types.ID
                                        WHERE products.id = ?');
        $stmt->execute([$id]);
        
        $productData = $stmt->fetch();
        
        if (!$productData) {
            return null;
        }
        
        $product = new Product($productData['name'], $productData['value'], $productData['type_id'], $productData['tax_percentage']);
        $product->setId($productData['id']);
        
        return $product;
    }
    
    public function update()
    {
        
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
       
         $stmt = $connection->prepare('UPDATE products SET name = ?, value = ?, type_id = ? WHERE id = ?');
        
        $stmt->execute([
            $this->name,
            $this->value,
            $this->typeId,
            $this->id
        ]);
    }
    
    public static function delete($id)
    {
       
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
    }
}
