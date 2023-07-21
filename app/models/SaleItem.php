<?php
namespace App\Models;
use App\Config\Database;

class SaleItem
{
    private $sale_id;
    private $product_id;
    private $quantity;
    private $total_value;

    public function __construct($sale_id, $product_id, $quantity, $total_value)
    {
        $this->sale_id = $sale_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->total_value = $total_value;
    }

    public function getSaleId()
    {
        return $this->sale_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTotalValue()
    {
        return $this->total_value;
    }

    public static function createSaleItem($sale_id, $product_id, $quantity)
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $product = Product::findById($product_id);
        if (!$product) {
            return false;
        }
        $total_value = $product->getPrice() * $quantity;

        $stmt = $connection->prepare('INSERT INTO sale_items (sale_id, product_id, quantity, total_value) VALUES (?, ?, ?, ?)');
        $stmt->execute([$sale_id, $product_id, $quantity, $total_value]);

        return true;
    }
}
?>
