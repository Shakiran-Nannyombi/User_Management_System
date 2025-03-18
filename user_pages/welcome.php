<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>

    <!-- Main Container -->
    <div class="container">

        <!-- Left Section (Text) -->
        <div class="intro">
            <h1>INNO TECH <br>User Management System</h1>

            <?php if (isset($_GET['message']) && $_GET['message'] == 'registration_successful') : ?>
                <p class="message" style="color: green;">Registration successful! Please log in to continue.</p>
            <?php endif; ?>

            <p class="lead">Welcome to our innovative User Management System. Whether you're registering as a new user or logging in to access your profile, we've got you covered. Join us now and experience seamless interaction!</p>

            <a href="register.php" class="btn">Register</a>
            <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
        </div>

        <!-- Right Section (Image) -->
        <div class="image-section">
            <img src="../assets/images/hello.png" alt="Welcome Illustration">
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 TechCorp. All rights reserved.</p>
    </div>

</body>
</html>
