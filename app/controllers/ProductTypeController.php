<?php 

namespace App\Controllers;
use App\Models\ProductType; 

class ProductTypeController {
    public function create() {
        $pageTitle = "Create Product Type";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $taxPercentage = $_POST['tax_percentage'];
            
            $productType = new ProductType($name, $taxPercentage);
            $productType->save();
            
            header('Location: /producttype/read');
            exit();
        }
        
        include __DIR__ . '/../views/create_product_type.php';
    }
    
    public function read() {
        $pageTitle = "List Product Types";
        
        $productTypes = ProductType::fetchAll();
        
        include __DIR__ . '/../views/list_product_types.php';
    }
    
    public function update($id) {
        $pageTitle = "Edit Product Type";
        
        $productType = ProductType::findById($id);
        
        if (!$productType) {
            die('Product Type not found');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $taxPercentage = $_POST['tax_percentage'];
            
            $productType->setName($name);
            $productType->setTaxPercentage($taxPercentage);
            $productType->update();
            
            header('Location: /producttype/read');
            exit();
        }
        
        include __DIR__ . '/../views/edit_product_type.php';
    }
    
    public function delete($id) {
        ProductType::delete($id);
        
        header('Location: /producttype/read');
        exit();
    }
}
