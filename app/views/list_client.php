<?php
$controller = "client";
include __DIR__ . '/includes/header.php';
?>
  <div class="container mt-5">
        <h1>Client List</h1>
        <a href="/client/create" class="btn btn-primary">Create Client</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['phone']; ?></td>
                        <td><a href="/client/update/<?php echo $client['id']; ?>" class="btn btn-primary">Edit</a></td>
                        <td>
                            <a href="/client/delete/<?php echo $client['id']; ?>"
                               class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to delete this client?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    </div>
<?php include 'includes/footer.php'; ?>
