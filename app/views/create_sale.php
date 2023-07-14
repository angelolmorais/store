<?php
##$controller = "product";
include __DIR__ . '/includes/header.php';
?>
<h1>Create Sale</h1>
<form method="POST" action="/sale/create">
    <div class="mb-3">
        <label for="product_id" class="form-label">Product:</label>
        <select name="product_id" id="product_id" class="form-control" required>
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php include 'includes/footer.php'; ?>
