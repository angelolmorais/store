<?php
$controller = "user";
include __DIR__ . '/includes/header.php';
?>
 <h1>User List</h1>
<a href="/user/create" class="btn btn-primary">Add User</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="/user/edit/<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <!--<a href="/user/delete/<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>-->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'includes/footer.php'; ?>

