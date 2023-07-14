<?php
$controller = "product";
include __DIR__ . '/includes/header.php';
?>
<h1>Product List</h1>
<a href="/product/create" class="btn btn-primary">Create Product</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['type_name']; ?></td>
                <td><?php echo $product['value']; ?></td>
                <td>
                <a href="/product/edit/<?php echo $product['id']; ?>" class="btn btn-primary">Edit</a>
				<a href="/product/delete/<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                
                
                
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>
