<?php

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\Sale;

class SaleTest extends TestCase
{
    public function testCalculateTotal()
    {
        $product1 = new Product(1, 'Product A', 10.99, 5);
        $product2 = new Product(2, 'Product B', 5.99, 3);

        $sale = new Sale([$product1, $product2]);

        $total = $sale->calculateTotal();

        $this->assertEquals(62.92, $total);
    }

    public function testAddItem()
    {
        $product = new Product(1, 'Product A', 10.99, 5);

        $sale = new Sale([$product]);

        $items = $sale->getItems();

        $this->assertCount(1, $items);
        $this->assertEquals($product, $items[0]);
    }
}
