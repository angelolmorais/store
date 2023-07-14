<?php 
class ProductTypeController {
    public function create() {
        $pageTitle = "Create Product Type";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $taxPercentage = $_POST['tax_percentage'];
            
            $productType = new ProductType($name, $taxPercentage);
            $productType->save();
            
            header('Location: /producttype/list');
            exit();
        }
        
        include __DIR__ . '/../views/create_product_type.php';
    }
    
    public function list() {
        $pageTitle = "List Product Types";
        
        $productTypes = ProductType::fetchAll();
        
        include __DIR__ . '/../views/list_product_types.php';
    }
    
    public function edit($id) {
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
            
            header('Location: /producttype/list');
            exit();
        }
        
        include __DIR__ . '/../views/edit_product_type.php';
    }
    
    public function delete($id) {
        ProductType::delete($id);
        
        header('Location: /producttype/list');
        exit();
    }
}
