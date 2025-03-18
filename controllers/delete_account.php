<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/user_management.php';

$user_id = $_SESSION['user_id'];

// Fetch the user's profile picture from the database
$stmt = $conn->prepare("SELECT profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($profile_picture);
$stmt->fetch();
$stmt->close();

// Delete the user from the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete profile picture from server if it exists
    if (file_exists($profile_picture) && $profile_picture != 'default_profile.png') {
        unlink($profile_picture);
    }

    // Delete user data from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        // Destroy the session and log the user out
        session_destroy();
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Error deleting account. Please try again.";
    }
    $stmt->close();
}

?>

