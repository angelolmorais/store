<?php
$controller = "producttype";
include __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
<h1>Product Types List</h1>
<a href="/producttype/create" class="btn btn-primary">Create Product Type</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Tax Percentage</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productTypes as $productType): ?>
            <tr>
                <td><?php echo $productType['id']; ?></td>
                <td><?php echo $productType['name']; ?></td>
                <td><?php echo $productType['tax_percentage']; ?></td>
                <td>
                    <a href="/producttype/update/<?php echo $productType['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="/producttype/delete/<?php echo $productType['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php include 'includes/footer.php'; ?>
