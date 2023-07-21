<?php
namespace App\Models;
use App\Config\Database;

class Sale
{
    private $id;
    private $client_id;
    private $productsData = [];
    private $saleDate; 

    public function __construct($client_id, $id = null, $productsData = [], $saleDate = null)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->productsData = $productsData;
        $this->saleDate = $saleDate; 
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function getProductsData()
    {
        return $this->productsData;
    }
    public function getSaleDate()
    {
        return $this->saleDate;
    }
    public static function findAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('SELECT * FROM sales');
        $stmt->execute();

        $sales = [];
        while ($row = $stmt->fetch()) {
            $sale = self::findById($row['id']);
            $sales[] = $sale;
        }

        return $sales;
    }

    public static function findById($id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('SELECT * FROM sales WHERE id = ?');
        $stmt->execute([$id]);
        $saleData = $stmt->fetch();

        if (!$saleData) {
            return null;
        }

        $sale = new Sale($saleData['client_id'], $saleData['id'], [], $saleData['sale_date']); 
        $sale->fetchProductsData($connection);

        return $sale;
    }
    
    public function addProduct(Product $product, $quantity)
    {
        $this->productsData[] = [
            'product' => $product,
            'quantity' => $quantity
        ];
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->productsData as $productData) {
            $product = $productData['product'];
            $quantity = $productData['quantity'];
            $totalPrice += $product->getPrice() * $quantity;
        }
        return $totalPrice;
    }

    private function fetchProductsData()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('SELECT * FROM sale_items WHERE sale_id = ?');
        $stmt->execute([$this->id]);
        $items = $stmt->fetchAll();

        foreach ($items as $item) {
            $product = Product::findById($item['product_id']);

            if ($product) {
                $this->addProduct($product, $item['quantity']);
            }
        }
    }

    public static function findByClientId($client_id)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
    
        $stmt = $connection->prepare('SELECT * FROM sales WHERE client_id = ?');
        $stmt->execute([$client_id]);
        $sales = $stmt->fetchAll();
    
        $result = [];
        foreach ($sales as $sale) {
            $sale_id = $sale['id'];
            $productsData = [];
    
           $stmt = $connection->prepare('SELECT * FROM sale_items WHERE sale_id = ?');
            $stmt->execute([$sale_id]);
            $items = $stmt->fetchAll();
            
            foreach ($items as $item) {
                $product = Product::findById($item['product_id']);
    
                if ($product) {
                    $productsData[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'total_value' => $item['total_value'],
                        
                    ];
                }
            }
    
            $saleObj = new Sale($client_id, $sale_id, $productsData);
    
            // Calcular totais para o cliente
            $totalQuantity = 0;
            $totalUnitPrice = 0;
            $totalPurchaseValue = 0;
            $totalTaxUnitValue = 0;
            $totalTaxValue = 0;
            $totalSale = 0;
    
            foreach ($productsData as $item) {
                $totalQuantity += $item['quantity'];
                $totalUnitPrice += $item['product']->getPrice();
                $totalPurchaseValue += $item['product']->getPrice() * $item['quantity'];
                $totalTaxUnitValue += $item['product']->getTaxPercentage();
                $totalTaxValue += $item['product']->getTaxPercentage() * $item['quantity'];
                $totalSale += $item['total_value'];
                
            }
    
            $saleObj->totalQuantity = $totalQuantity;
            $saleObj->totalUnitPrice = $totalUnitPrice;
            $saleObj->totalPurchaseValue = $totalPurchaseValue;
            $saleObj->totalTaxUnitValue = $totalTaxUnitValue;
            $saleObj->totalTaxValue = $totalTaxValue;
            $saleObj->totalSale = $totalSale;
    
            $result[] = $saleObj;
        }
    
        return $result;
    }
    
    public function save()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $stmt = $connection->prepare('INSERT INTO sales (client_id, total_value, sale_date) VALUES (?, ?, ?)');
        $stmt->execute([$this->client_id, $this->getTotalPrice(), date('Y-m-d H:i:s')]);
        $this->id = $connection->lastInsertId();

        $this->saveSaleItems($connection);
    }

    private function saveSaleItems()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        foreach ($this->productsData as $productData) {
            $product_id = $productData['product']->getId();
            $quantity = $productData['quantity'];
            $total_value = $productData['product']->getPrice() * $quantity;

            $stmt = $connection->prepare('INSERT INTO sale_items (sale_id, product_id, quantity, total_value) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->id, $product_id, $quantity, $total_value]);
        }
    }


}
?>
