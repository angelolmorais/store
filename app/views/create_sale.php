<?php
$controller = "sale";
include __DIR__ . '/includes/header.php';
?>
<div class="container mt-5">
    <h1>Create Sale</h1>
    <form action="/sale/create" method="post">
        <div class="mb-3">
            <label for="client" class="form-label">Client:</label>
            <select name="client_id" id="client" class="form-control">
                <?php foreach ($clients as $client) : ?>
                    <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="product" class="form-label">Product:</label>
            <select name="product_id" id="product" class="form-control">
                <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['id'] ?>" data-product-id="<?= $product['id'] ?>" data-price="<?= $product['value'] ?>">
                        <?= $product['name'] ?> - Price: <?= $product['value'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" name="quantity" min="0" placeholder="Quantity" class="form-control">
        </div>
        <hr>
        <div id="product-list">
        </div>
        <button type="button" id="add-product" class="btn btn-primary">Add Product</button>
        <button type="submit" class="btn btn-success">Create Sale</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addProductButton = document.getElementById("add-product");
        const productList = document.getElementById("product-list");

        addProductButton.addEventListener("click", function() {
            const selectedProduct = document.getElementById("product");
            const selectedProductOption = selectedProduct.options[selectedProduct.selectedIndex];
            const productId = selectedProduct.value;
            const productName = selectedProductOption.text;
            const productPrice = selectedProductOption.dataset.price;
            const quantityInput = document.querySelector("input[name='quantity']");
            const quantity = quantityInput.value;

            if (quantity === "") {
                alert("Please enter a quantity.");
                return;
            }

            const productEntry = document.createElement("div");
            productEntry.innerHTML = `${productName} - Price: ${productPrice} - Quantity: ${quantity}`;
            productList.appendChild(productEntry);

            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = `products[${productId}]`;
            hiddenInput.value = quantity;
            productList.appendChild(hiddenInput);

            quantityInput.value = ""; // Reset quantity input
        });
    });
</script>


<?php include 'includes/footer.php'; ?>
