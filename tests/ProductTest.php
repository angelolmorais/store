<?php

use PHPUnit\Framework\TestCase;

require_once 'app/models/Product.php'; 

class ProductTest extends TestCase
{
    public function testGetValue()
    {
        $product = new Product(1, 'Product A', 10.99, 5);
        $value = $product->getValue();
        
        $this->assertEquals(54.95, $value);
    }

    public function testSetName()
    {
        $product = new Product(1, 'Product A', 10.99, 5);
        $product->setName('New Name');

        $this->assertEquals('New Name', $product->getName());
    }
}
