<?php
$controller = "product";
include __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
<h1>Create Product</h1>
<form method="POST" action="/product/create">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="type_id" class="form-label">Product Type:</label>
        <select name="type_id" id="type_id" class="form-control" required>
            <?php foreach ($productTypes as $type): ?>
                <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="value" class="form-label">Product Value:</label>
        <input type="number" name="value" id="value" class="form-control" step="0.01" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
<?php include 'includes/footer.php'; ?>
