<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensures session variables are set to prevent errors
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "User";
$profile_picture = isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']) 
    ? $_SESSION['profile_picture'] 
    : "default_profile.png"; // Provides a default image
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

<div class="container">
    <h1>Profile Details</h1>

    <div class="profile-details">

    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

        <?php if ($profile_picture) : ?>
            <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile Picture" class="profile-img">
        <?php else : ?>
            <p><strong>Profile Picture:</strong> No profile picture uploaded.</p>
        <?php endif; ?>
        
    </div> <br><br>

    <div class="profile-links">
    <button onclick="window.location.href='edit_profile.php'" class="btn">Edit Profile</button> 
    <button onclick="window.location.href='login.php'" class="btn">Logout</button> <br><br>
    <a href="delete_account.php" style="color: red;">Delete Account</a>
    </div>

    <?php if (isset($_GET['message']) && $_GET['message'] == 'update_success') : ?>
        <p class="message-success">Profile updated successfully!</p>
    <?php endif; ?>
</div>

</body>
</html>
