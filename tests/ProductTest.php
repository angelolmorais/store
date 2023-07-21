<?php
use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Config\Database;

require_once 'config/test_config.php'; 

class ProductTest extends TestCase
{
    public function testGetValue()
    {
        $product = new Product("Test Product", 50.00, 1, 10);
        $expectedValue = 50.00;

        $this->assertEquals($expectedValue, $product->getValue());
    }

    public function testFindAll()
    {
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();

        $connection->exec('DELETE FROM products');

        $productsData = [
            ['name' => 'Product A', 'value' => 10.00, 'type_id' => 1],
            ['name' => 'Product B', 'value' => 20.00, 'type_id' => 3],
        ];

        foreach ($productsData as $data) {
            $stmt = $connection->prepare('INSERT INTO products (name, value, type_id) VALUES (?, ?, ?)');
            $stmt->execute([$data['name'], $data['value'], $data['type_id']]);
        }

        $products = Product::findAll();

        $this->assertCount(count($productsData), $products);

        $this->assertEquals($productsData[0]['name'], $products[0]['name']);
        $this->assertEquals($productsData[1]['name'], $products[1]['name']);

        $this->assertEquals($productsData[0]['value'], $products[0]['value']);
        $this->assertEquals($productsData[1]['value'], $products[1]['value']);

        $this->assertIsNumeric($products[0]['id']);
        $this->assertIsNumeric($products[1]['id']);
    
    }
}
