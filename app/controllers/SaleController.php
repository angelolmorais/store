<?php

namespace App\Controllers;
use App\Models\Sale; 
use App\Models\Client; 
use App\Models\Product; 

class SaleController
{
    public function create()
    {
        $pageTitle = "Create Sale";
        $clients = Client::fetchAll();
        $products = Product::fetchAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientId = $_POST['client_id'];
            $sale = new Sale($clientId);

            $productsIds = array_keys($_POST['products']); 
            $quantities = $_POST['products']; 

            for ($i = 0; $i < count($productsIds); $i++) {
                $product = Product::findById($productsIds[$i]);
                $quantity = intval($quantities[$productsIds[$i]]);

                if ($product && $quantity > 0) {
                    $sale->addProduct($product, $quantity);
                }
            }

            $sale->save();

            header('Location: /sale/read');
            exit();
        }

        include __DIR__ . '/../views/create_sale.php';
    }

    public function read()
    {
        $pageTitle = "List Sales";
        $clients = Client::fetchAll();
        $salesByClient = array();

        foreach ($clients as $client) {
            $client_id = $client['id'];
            
            $sales = Sale::findByClientId($client_id);

            if (!empty($sales)) {
                $salesByClient[] = array(
                    'client' => $client,
                    'sales' => $sales,
                );
            }
        }

        include __DIR__ . '/../views/list_sales.php';
    }
}
?>
