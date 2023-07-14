<?php
$controller = "user";
include __DIR__ . '/includes/header.php';
?>
<h1>Edit User</h1>
<form method="POST" action="/user/edit/<?php echo $user->getId(); ?>">
     <div class="mb-3">
     	<label for="name" class="form-label">Name:</label>
    	<input type="text" name="name" id="name" class="form-control" value="<?php echo $user->getName(); ?>">
     </div>
	<div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $user->getEmail(); ?>">
    </div>
     <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php include 'includes/footer.php'; ?>
