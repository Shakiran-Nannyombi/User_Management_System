<?php include '../controllers/delete_account.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../assets/css/delete.css"> <!-- Link your CSS file -->
</head>
<body>

<div class="container">
    <img src="../assets/images/account.png" alt="Delete Account" /> <!-- Add your image here -->
    
    <h2>Are you sure you want to delete your account?</h2>

    <form method="POST">
        <button type="submit">Yes, Delete My Account</button>
    </form>

    <a href="dashboard.php">Cancel</a>

    <?php if (isset($error)): ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
