<?php
$controller = "product";
include __DIR__ . '/includes/header.php';
?>
<h1>Edit Product</h1>
<form method="POST" action="/product/edit/<?php echo $product->getId(); ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $product->getName(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="tipo_id" class="form-label">Product Type:</label>
        
        <input type="text" name="type_id" id="type_id" class="form-control" value="<?php echo $product->getTypeId(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="valor" class="form-label">Product Value:</label>
        <input type="text" name="value" id="value" class="form-control" value="<?php echo $product->getValue(); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'includes/footer.php'; ?>
