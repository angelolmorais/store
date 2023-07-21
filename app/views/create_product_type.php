<?php 
$controller = "producttype";
include __DIR__ . '/includes/header.php'; 
?>
<div class="container mt-5">
<h1>Create Product Type</h1>
<form method="POST" action="/producttype/create">
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tax_percentage" class="form-label">Tax Percentage:</label>
        <input type="text" name="tax_percentage" id="tax_percentage" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
<?php include 'includes/footer.php'; ?>
