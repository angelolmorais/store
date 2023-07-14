<?php
$controller = "sale";
include __DIR__ . '/includes/header.php';
?>
<h1>Sales List</h1>
<a href="/sale/create" class="btn btn-primary">Add Sale</a>&nbsp;<a href="#" class="btn btn-warning">Close sale</a>
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
        <?php foreach ($sales as $sale): ?>
            <tr>
                <td><?php echo $sale['id']; ?></td>
                <td><?php echo $sale['name']; ?></td>
                <td><?php echo $sale['quantity']; ?></td>
                <td><?php echo $sale['unit_price']; ?></td>
                <td><?php echo $sale['total_price']; ?></td>
                <td><?php echo $sale['item_tax']; ?></td>
                <td><?php echo $sale['total_tax']; ?></td>
                <td><?php echo number_format($sale['total_price'] + $sale['total_tax'],2);#$sale['total_amount']; ?></td>
                <td><?php echo date_format(new DateTime($sale['sale_date']), 'Y/m/d H:i:s'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2">Total</th>
            <th><?php echo $totalquantity; ?></th>
            <th><?php echo number_format($totalunitprice,2); ?></th>
            <th><?php echo number_format($totalPurchaseValue,2); ?></th>
            <th><?php echo number_format($totalTaxUnitValue,2); ?></th>
            <th><?php echo number_format($totalTaxValue,2); ?></th>
            <th><?php echo number_format($totalSale,2); ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>

<?php include 'includes/footer.php'; ?>
