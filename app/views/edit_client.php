<?php 
$controller = "client"; 
include __DIR__ . '/includes/header.php'; 
?>
<div class="container">
    <form action="/client/update/<?php echo $client->getId(); ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $client->getName(); ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo $client->getEmail(); ?>">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $client->getPhone(); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
