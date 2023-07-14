<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: /user/login');
    exit();
}
$controller = $_GET['controller'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/sale/list">My System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php echo ($controller === 'producttype') ? 'active' : ''; ?>">
                        <a class="nav-link" href="/producttype/list">Product Types</a>
                    </li>
                    <li class="nav-item <?php echo ($controller == 'product') ? 'active' : ''; ?>">
                        <a class="nav-link" href="/product/list">Products</a>
                    </li>
                    
                    <li class="nav-item <?php echo ($controller === 'sale') ? 'active' : ''; ?>">
                        <a class="nav-link" href="/sale/list">Sales</a>
                    </li>
                    <li class="nav-item <?php echo ($controller === 'user') ? 'active' : ''; ?>">
                        <a class="nav-link" href="/user/list">User</a>
                    </li>
                                  
                </ul>
                </div>
                 	<span class="navbar-text-right">
                     <a class="navbar-brand" href=""><?php echo $_SESSION['user_name']; ?></a>
                     <a class="navbar-brand" href="/user/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                  </span>
            
        </div>
    </nav>
    
    <div class="container mt-4">
