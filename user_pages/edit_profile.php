<?php include '../controllers/edit_profile_controller.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/edit_profile.css">
</head>
<body>

<div class="container">
    <h1>Edit Profile</h1>

    <?php if (isset($_GET['message']) && $_GET['message'] == 'update_success') : ?>
        <p class="message" style="color: green;">Profile updated successfully!</p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

    <?php if ($profile_picture) : ?>
            <label>Current Profile Picture:</label>
            <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile Picture" class="profile-img">
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

    <label for="profile_picture">Profile Picture:</label>
    <input type="file" name="profile_picture"><br>

    <button type="submit">Save Changes</button>
    <button type="button" onclick="window.location.href='dashboard.php'">Cancel</button>
</form>

</body>
</html>
