<!-- Including the controller logic -->
<?php include '../controllers/forgot_password_controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/forgotPassword.css">
</head>
<body>

<!-- Main Container -->
<div class="container">
    
    <!-- Left Section (Form) -->
    <div class="form-section">
        <h2>Forgot Password</h2>
        <p>Enter your email to receive a password reset link.</p>
        
        <form method="POST" class="form-container">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" required class="form-input">
            </div>
            <button type="submit" class="submit-btn">Send Reset Token</button>
        </form>

        <!-- Show Messages -->
        <?php if(isset($_SESSION['message'])): ?>
            <p class="success-message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </div>

    <!-- Right Section (Image) -->
    <div class="image-section">
        <img src="../assets/images/forgotpassword.png" alt="Forgot Password Illustration">
    </div>

</div>

</body>
</html>
