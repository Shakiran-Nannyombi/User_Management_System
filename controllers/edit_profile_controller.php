<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include '../includes/user_management.php';

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT username, email, profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username, $email, $profile_picture);
$stmt->fetch();
$stmt->close();

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_profile_picture = $_FILES['profile_picture'];

    if (empty($new_username) || empty($new_email)) {
        $error = "All fields are required.";
    } else {
        // Check if profile picture was uploaded
        if ($new_profile_picture['size'] > 0) {
            if ($new_profile_picture['size'] > 5 * 1024 * 1024) {
                $error = "Profile picture size must be less than 5MB.";
            } else {
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($new_profile_picture["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check file type
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                    if (move_uploaded_file($new_profile_picture["tmp_name"], $target_file)) {
                        // Update the profile picture
                        $profile_picture = $target_file;
                    } else {
                        $error = "Error uploading profile picture.";
                    }
                } else {
                    $error = "Only JPG, JPEG, and PNG files are allowed.";
                }
            }
        }

        // Update user details in the database
        if (!$error) {
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, profile_picture = ? WHERE id = ?");
            $stmt->bind_param("sssi", $new_username, $new_email, $profile_picture, $user_id);
            
            if ($stmt->execute()) {
                $_SESSION['username'] = $new_username;  // Update session data
                $_SESSION['profile_picture'] = $profile_picture;  // Update session data
                $success = "Profile updated successfully.";
            } else {
                $error = "Error updating profile. Please try again.";
            }
            $stmt->close();
        }
    }
}

?>