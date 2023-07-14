<?php 
class ProductController {
    public function create() {
        $pageTitle = "Create Product";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $value = $_POST['value'];
            $typeId = $_POST['type_id'];
            #$taxPercentage = $_POST['type_id'];
            $product = new Product($name, $value, $typeId, $taxPercentage);
            $product->save();
            
            // Redirect to success page
            header('Location: /product/list');
            exit();
        }
        
        $productTypes = ProductType::fetchAll();
        
        include __DIR__ . '/../views/create_product.php';
    }
    
    public function list() {
        $pageTitle = "Product List";
        
        $products = Product::fetchAll();
        
        include __DIR__ . '/../views/list_products.php';
    }
    
    public function edit($id) {
        $pageTitle = "Edit Product";
        
        $product = Product::findById($id);
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
            
            header('Location:/product/list');
            exit();
        }
        
        include __DIR__ . '/../views/edit_product.php';
    }
    
    public function delete($id) {
        Product::delete($id);
        
        header('Location: /product/list');
        exit();
    }
}
