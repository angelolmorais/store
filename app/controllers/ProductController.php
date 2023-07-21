<?php 

namespace App\Controllers;
use App\Models\Product; 
use App\Models\ProductType; 

class ProductController {
    public function create() {
        $pageTitle = "Create Product";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $value = $_POST['value'];
            $typeId = $_POST['type_id'];
            $product = new Product($name, $value, $typeId, $taxPercentage);
            $product->save();
            
            header('Location: /product/read');
            exit();
        }
        
        $productTypes = ProductType::fetchAll();
        
        include __DIR__ . '/../views/create_product.php';
    }
    
    public function read() {
        $pageTitle = "Product List";
        
        $products = Product::fetchAll();
        
        include __DIR__ . '/../views/list_products.php';
    }
    
    public function update($id)
    {
        $pageTitle = "Edit Product";
        $product = Product::findById($id); 
    
        $productTypes = ProductType::fetchAll();
        if (!$product) {
            die('Product not found');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $typeId = $_POST['type_id'];
            $value = $_POST['value'];
    
            $product->setName($name);
            $product->setTypeId($typeId);
            $product->setValue($value);
            $product->update();
    
            header('Location:/product/read');
            exit();
        }
    
        include __DIR__ . '/../views/edit_product.php';
    }
    
    public function delete($id) {
        Product::delete($id);
        
        header('Location: /product/read');
        exit();
    }
}
