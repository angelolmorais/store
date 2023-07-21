<?php
$controller = "client";
include __DIR__ . '/includes/header.php';
?>
 <div class="container mt-5">
        <h1>Create Client</h1>
        <form action="/client/create" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php include 'includes/footer.php'; ?>
