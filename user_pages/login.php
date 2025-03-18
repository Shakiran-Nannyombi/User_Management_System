<?php include '../controllers/login_controller.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

    <!-- Form Section -->
    <div class="form-section">
        <h2>Login</h2>
        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="form-group" style="display: inline;">
                <label for="remember">Remember Me</label>
                <input type="checkbox" name="remember" id="remember">
            </div>

            <button type="submit" class="submit-btn">Login</button>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </form>
    </div>

    <!-- Image Section -->
    <div class="image-section">
        <img src="../assets/images/login.png" alt="Login Illustration">
    </div>

 </body>
</html>
