<?php
require_once '../app/config/config.php';
require_once '../app/config/Database.php';
require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/ProductTypeController.php';
require_once '../app/controllers/SaleController.php';
require_once '../app/controllers/UserController.php';
require_once '../app/models/Product.php';
require_once '../app/models/ProductType.php';
require_once '../app/models/Sale.php';
require_once '../app/models/User.php';

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);

$controller = $parts[1] ?? 'product';
$action = $parts[2] ?? 'list';

switch ($controller) {
    case 'product':
        $productController = new ProductController();
        switch ($action) {
            case 'list':
                $productController->list();
                break;
            case 'create':
                $productController->create();
                break;
            case 'edit':
                $id = $parts[3] ?? null;  
                $productController->edit($id);
                break;
            case 'delete':
                $id = $parts[3] ?? null;  
                $productController->delete($id);
                break;
            default:
                header('Location: /product/list');
                exit();
        }
        break;
        

    case 'producttype':
        $productTypeController = new ProductTypeController();
        switch ($action) {
            case 'list':
                $productTypeController->list();
                break;
            case 'create':
                $productTypeController->create();
                break;
            case 'edit':
                $id = $parts[3] ?? null;
                $productTypeController->edit($id);
                break;
            case 'delete':
                $id = $parts[3] ?? null; 
                $productTypeController->delete($id);
                break;
            default:
                header('Location: /producttype/list');
                exit();
        }
        break;
    case 'sale':
        $saleController = new SaleController();
        switch ($action) {
            case 'list':
                $saleController->list();
                break;
            case 'create':
                $saleController->create();
                break;
            default:
                header('Location: /sale/list');
                exit();
        }
        break;
    case 'user':
        $userController = new UserController();
        switch ($action) {
            case 'list':
                $userController->list();
                break;
            case 'create':
                $userController->create();
                break;
            case 'edit':
                $id = $parts[3] ?? null;
                $userController->edit($id);
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
    case 'login':
        $userController = new UserController();
        $userController->login();
        break;
    default:
        $userController = new UserController();
        $userController->login();
        break;
}