<?php
    include '../controllers/reset_password_controller.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/reset_password.css">
</head>
<body>

<!-- Reset Password Form -->
<div class="container">
    <div class="form-container">
        <h2>Reset Your Password</h2>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="token" placeholder="Enter your reset token" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter new password" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>

        <!-- Show Messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color:green;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
