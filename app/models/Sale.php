<?php

class Sale
{
    private $id;
    private $productId;
    private $quantity;
    private $totalValue;
    private $taxValue;
    private $saleDate;
    private $userId;
   
    
    public function __construct( $productId, $quantity, $totalValue, $taxValue, $saleDate, $userId)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalValue = $totalValue;
        $this->taxValue = $taxValue;
        $this->saleDate = $saleDate;
        $this->userId = $userId;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getProductId()
    {
        return $this->productId;
    }
    
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function getTotalValue()
    {
        return $this->totalValue;
    }
    
    public function getTaxValue()
    {
        return $this->taxValue;
    }
    
    public function getSaleDate()
    {
        return $this->saleDate;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function save()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('INSERT INTO sales (product_id,  quantity, total_value, user_id) VALUES (?, ?, ?, ?)');
        $stmt->execute([$this->productId, $this->quantity, $this->totalValue, $_SESSION['user_id']]);
        $this->id = $connection->lastInsertId();
    }
    
    public static function getAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM sales');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public static function getById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT * FROM sales WHERE id = ?');
        $stmt->execute([$id]);
        $sale = $stmt->fetch();
        
        if (!$sale) {
            return null;
        }
        
        return new Sale($sale['product_id'], $sale['quantity'], $sale['total_value'], $sale['tax_value'], $sale['sale_date']);
    }
    public static function fetchAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('SELECT
                                        	sales.id,
                                        	products.name AS name,
                                        	sales.quantity,
                                        	ROUND(products.value,2) AS unit_price,
                                        	products.value * sales.quantity as total_price,
                                        	ROUND(product_types.tax_percentage,2) AS item_tax,
                                        	ROUND( product_types.tax_percentage * sales.quantity, 2 ) AS total_tax,	
                                        	ROUND(products.value * sales.quantity * (1 + product_types.tax_percentage / 100), 2) AS total_amount,
                                        	sales.sale_date 
                                        FROM
                                        	sales
                                        	JOIN products ON sales.product_id = products.
                                        	ID JOIN product_types ON products.type_id = product_types.ID 
                                        ORDER BY
                                        	sales.sale_date DESC;');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    public function update()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('UPDATE sales SET product_id = ?, quantity = ?, total_value = ?, tax_value = ?, sale_date = ? WHERE id = ?');
        $stmt->execute([$this->productId, $this->quantity, $this->totalValue, $this->taxValue, $this->saleDate, $this->id]);
    }
    
    public static function delete($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        
        $stmt = $connection->prepare('DELETE FROM sales WHERE id = ?');
        $stmt->execute([$id]);
    }
}
