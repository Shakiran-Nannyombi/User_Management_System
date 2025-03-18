<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure session variables are set to prevent errors
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "User";
$profile_picture = isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture']) 
    ? $_SESSION['profile_picture'] 
    : "default_profile.png"; // Provide a default image
?>