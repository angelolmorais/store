<?php

class SaleController {
    
    public function create() {
        $pageTitle = "Create Sale";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            session_start();
            $product = Product::findById($productId);
            
            if (!$product) {
                die('Product not found');
            }
         
            $totalValue = $product->getValue() * $quantity;
            $taxAmount = $product->getTaxPercentage() * $totalValue;
            $totalSale = $totalValue + $taxAmount;           
            $taxValue = $totalValue * ($product->getTaxPercentage() / 100);
            $sale = new Sale($productId, $quantity, $totalValue, $totalSale,  $_SESSION['user_id'], $taxValue);
            
            $sale->save();
            
            // Redirect to success page
            header('Location: /sale/list');
            exit();
        }
        
        $products = Product::fetchAll();
        
        include __DIR__ . '/../views/create_sale.php';
    }
    
    public function list() {
        $pageTitle = "Sale List";
        
        $sales = Sale::fetchAll();
        
        $totalquantity =0;
        $totalunitprice =0;
        $totalPurchaseValue = 0;        
        $totalTaxUnitValue = 0;
        $totalTaxValue = 0;
        $totalSale = 0;
        
        foreach ($sales as $sale) {
            $totalquantity += $sale['quantity'];
            $totalunitprice +=$sale['unit_price'];
            $totalPurchaseValue += $sale['total_price'];
            $totalTaxUnitValue += $sale['item_tax'];
            $totalTaxValue += $sale['total_tax'];
            $totalSale += $sale['total_price']+$sale['total_tax'];
        }
        
        include __DIR__ . '/../views/list_sales.php';
    }
    
    public function delete($id) {
        Sale::delete($id);
        
        header('Location: ?controller=sale&action=list');
        exit();
    }
}
