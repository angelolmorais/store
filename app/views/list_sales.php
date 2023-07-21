<?php
$controller = "sale";
include __DIR__ . '/includes/header.php';
?>

<div class="container mt-5">
    <h1>Sales List</h1>
    <a href="/sale/create" class="btn btn-primary">Create Sale</a>
    <?php
    
    $totalQuantityAll = 0;
    $totalUnitPriceAll = 0;
    $totalPurchaseValueAll = 0;
    $totalTaxUnitValueAll = 0;
    $totalTaxValueAll = 0;
    $totalSaleAll = 0;
    ?>
    <?php foreach ($salesByClient as $clientData) : ?>
        <?php $client = $clientData['client']; ?>
        <h3>Client: <?php echo $client['name']; ?></h3>
        <table class="table">
         
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Item Price</th>
                    <th>Tax</th>
                    <th>Total Tax</th>
                    <th>Total Item (Price+Tax)</th>
                    <th>Sale Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientData['sales'] as $sale) : ?>
                    <?php foreach ($sale->getProductsData() as $item) : ?>
                        <?php $product = $item['product']; ?>
                        <?php if ($product) : ?>
                            <tr>
                                <td><?php echo $sale->getId(); ?></td>
                                <td><?php echo $product->getName(); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td><?php echo number_format($product->getPrice(), 2); ?></td>
                                <td><?php echo number_format($product->getPrice() * $item['quantity'], 2); ?></td>
                                <td><?php echo $product->getTaxPercentage(); ?></td>
                                <td><?php echo number_format($product->getTaxPercentage() * $item['quantity'], 2); ?></td>
                                <td>
                                    <?php
                                    $totalItemPrice = $product->getPrice() * $item['quantity'];
                                    $totalTax = $product->getTaxPercentage() * $item['quantity'];
                                    $totalItem = $totalItemPrice + $totalTax;
                                    echo number_format($totalItem, 2);
                                    ?>
                                </td>
                                <td><?php echo $sale->getSaleDate(); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php
                     $totalQuantityAll += $sale->totalQuantity;
                    $totalUnitPriceAll += $sale->totalUnitPrice;
                    $totalPurchaseValueAll += $sale->totalPurchaseValue;
                    $totalTaxUnitValueAll += $sale->totalTaxUnitValue;
                    $totalTaxValueAll += $sale->totalTaxValue;
                    $totalSaleAll += $sale->totalSale;
                    ?>
                <?php endforeach; ?>
            </tbody>

            
            <tfoot>
                <tr>
                    <th colspan="2">Total for <?php echo $client['name']; ?></th>
                    <th><?php echo number_format($totalQuantityAll, 2); ?></th>
                    <th><?php echo number_format($totalUnitPriceAll, 2); ?></th>
                    <th><?php echo number_format($totalPurchaseValueAll, 2); ?></th>
                    <th><?php echo number_format($totalTaxUnitValueAll, 2); ?></th>
                    <th><?php echo number_format($totalTaxValueAll, 2); ?></th>
                    <th><?php echo number_format($totalSaleAll, 2); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    <?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>
