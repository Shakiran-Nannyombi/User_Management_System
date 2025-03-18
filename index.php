<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start(); // Start the session
include '../includes/user_management.php'; // Include the user management file

// Check if the user is logged in using id
if (isset($_SESSION['user_id'])) {
    header("Location: user_pages/dashboard.php"); // Redirect logged-in users to dashboard
    exit();
} else {
    header("Location: user_pages/welcome.php"); // Redirect guests to login page
    exit();
}

// Check if there's a remember me cookie
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    // Fetch user by token from the database
    $stmt = $conn->prepare("SELECT id, username, profile_picture FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $profile_picture);
    $stmt->fetch();

    if ($user_id) {
        // Log the user in
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['profile_picture'] = $profile_picture;

        // Redirect to dashboard
        header("Location: user_pages/welcome.php");
        exit();
    }
}

?>

</body>
</html>