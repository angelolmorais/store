<?php
use PHPUnit\Framework\TestCase;
use App\Models\ProductType;
use App\Config\Database;

require_once 'config/test_config.php';

class ProductTypeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Initialize a database transaction before each test
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        $connection->beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        // Rollback changes and reset the database after each test
        $db = new Database(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $db->connect();
        $connection = $db->getConnection();
        $connection->rollBack();
    }

    public function testSave()
    {
        $productType = new ProductType("Clothing", 10);
        $productType->save();

        $productId = $productType->getId();
        $this->assertIsNumeric(
            $productId,
            'Failed to get a valid ID after saving ProductType to the database.'
        );

        $savedProductType = ProductType::findById($productId);

        $this->assertEquals(
            $productType->getName(),
            $savedProductType->getName(),
            'Saved ProductType name does not match the retrieved one.'
        );
        $this->assertEquals(
            $productType->getTaxPercentage(),
            $savedProductType->getTaxPercentage(),
            'Saved ProductType tax percentage does not match the retrieved one.'
        );
    }

    public function testUpdate()
    {
        $productType = new ProductType("Electronics", 15);
        $productType->save();

        $productType->setName("Gadgets");
        $productType->setTaxPercentage(12.5);
        $productType->update();

        $updatedProductType = ProductType::findById($productType->getId());

        $this->assertEquals("Gadgets", $updatedProductType->getName());
        $this->assertEquals(12.5, $updatedProductType->getTaxPercentage());
    }

    public function testDelete()
    {
        $productType = new ProductType("Toys", 8);
        $productType->save();

        $productTypeId = $productType->getId();

        ProductType::delete($productTypeId);

        $deletedProductType = ProductType::findById($productTypeId);

        $this->assertNull($deletedProductType);
    }

    public function testFetchAll()
    {
        $productType1 = new ProductType("Books", 5);
        $productType2 = new ProductType("Home Appliances", 12);
        $productType1->save();
        $productType2->save();

        $productTypes = ProductType::fetchAll();

        $this->assertCount(2, $productTypes);

        $this->assertEquals($productType1->getName(), $productTypes[0]['name']);
        $this->assertEquals($productType2->getName(), $productTypes[1]['name']);

        $this->assertEquals($productType1->getTaxPercentage(), $productTypes[0]['tax_percentage']);
        $this->assertEquals($productType2->getTaxPercentage(), $productTypes[1]['tax_percentage']);
    }
}
