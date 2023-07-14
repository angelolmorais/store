<?php
$controller = "dashboard";
include __DIR__ . '/includes/header.php';?>
   <h1>Dashboard</h1>
    <p>Welcome to the dashboard, <?php echo $user->getName(); ?>!</p>
    <p>Here, you can manage various aspects of your account and access different features.</p>
    <h2>Account Details</h2>
    <p>Name: <?php echo $user->getName(); ?></p>
    <p>Email: <?php echo $user->getEmail(); ?></p>
    <h2>Actions</h2>
    <ul>
        <li><a href="/user/edit/<?php echo $user->getId(); ?>">Edit Account</a></li>
        <li><a href="/user/<?php echo $user->getId(); ?>">Change Password</a></li>
        <li><a href="/user/delete/<?php echo $user->getId(); ?>">Delete Account</a></li>
        <li><a href="/controller/logout">Logout</a></li>
    </ul>
<?php include 'includes/footer.php'; ?>
