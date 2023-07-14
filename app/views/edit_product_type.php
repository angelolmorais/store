<?php
$controller = "producttype";
include __DIR__ . '/includes/header.php';
?>
 <h1>Edit Product Type</h1>
    <form method="POST" action="/producttype/edit/<?php echo $productType->getId(); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name"  class="form-control" value="<?php echo $productType->getName(); ?>" required>
        </div>
        <div class="mb-3">
            <label for="Tax" class="form-label">Tax:</label>
            <input type="text" name="tax_percentage" id="tax_percentage"  class="form-control" value="<?php echo $productType->getTaxPercentage(); ?>" required>
        </div>
       	 <input type="submit" class="btn btn-primary" value="Update">
    </form>
<?php include 'includes/footer.php'; ?>
