<?php include '../controllers/register_controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>

<div class="form-wrapper">
    <!-- Image on the left -->
    <div class="image-container">
        <img src="../assets/images/avatar.png" alt="Image" class="form-image">
    </div>

    <!-- Registration Form on the right -->
    <div class="form-container">
        <h2 style="text-align: center;">Register</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</div>

</body>
</html>

