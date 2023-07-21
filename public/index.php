<?php
require_once __DIR__ . '/../vendor/autoload.php';

require_once '../app/config/config.php';
require_once '../app/config/Database.php';
require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/ProductTypeController.php';
require_once '../app/controllers/SaleController.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/ClientController.php'; 
require_once '../app/models/Product.php';
require_once '../app/models/ProductType.php';
require_once '../app/models/Sale.php';
require_once '../app/models/User.php';
require_once '../app/models/Client.php';

use App\Controllers\ProductController;
use App\Controllers\ProductTypeController;
use App\Controllers\SaleController;
use App\Controllers\UserController;
use App\Controllers\ClientController;

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);

$controller = $parts[1] ?? 'product';
$action = $parts[2] ?? 'read';

switch ($controller) {
    case 'login':
        $userController = new UserController();
        $userController->login();
        break;
    default:
        $userController = new UserController();
        $userController->login();
        break;

        case 'user':
            $userController = new UserController();
            switch ($action) {
                case 'create':
                    $userController->create();
                    break;
                case 'read':
                    $userController->read();
                    break;           
                case 'update':
                    $id = $parts[3] ?? null;
                    $userController->update($id);
                    break;
                case 'delete':
                    $id = $parts[3] ?? null;
                    $userController->delete($id);
                    break;                
                case 'logout':
                    $userController = new UserController();
                    $userController->logout();
                    break;
                default:
                    $userController->login();
                    break;
            }
            break;

    case 'product':
        $productController = new ProductController();
        switch ($action) {
            case 'create':
                $productController->create();
                break;
            case 'read':
                $productController->read();
                break;           
            case 'update':
                $id = $parts[3] ?? null;  
                $productController->update($id);
                break;
            case 'delete':
                $id = $parts[3] ?? null;  
                $productController->delete($id);
                break;
            default:
                header('Location: /product/read');
                exit();
        }
        break;
        

    case 'producttype':
        $productTypeController = new ProductTypeController();
        switch ($action) {
            case 'create':
                $productTypeController->create();
                break;
            case 'read':
                $productTypeController->read();
                break;           
            case 'update':
                $id = $parts[3] ?? null;
                $productTypeController->update($id);
                break;
            case 'delete':
                $id = $parts[3] ?? null; 
                $productTypeController->delete($id);
                break;
            default:
                header('Location: /producttype/read');
                exit();
        }
        break;

    case 'sale':
        $saleController = new SaleController();
        switch ($action) {           
            case 'create':
                $saleController->create();
                break;
            case 'read':
                $saleController->read();
                break;
            default:
                header('Location: /sale/read');
                exit();
        }
        break;

    case 'client': 
        $clientController = new ClientController();
        switch ($action) {
            case 'create':
                $clientController->create();
                break;    
            case 'read':
                    $clientController->read();
                    break;            
            case 'update':
                $id = $parts[3] ?? null;
                $clientController->update($id);
                break;
            case 'delete':
                $id = $parts[3] ?? null;
                $clientController->delete($id);
                break;
            default:
                $clientController->read();
                break;
        }
        break;  
}