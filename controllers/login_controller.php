<?php
session_start();
include '../includes/user_management.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false; // Check if Remember Me is checked

    // Validate email and password
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Check if the user exists
        $stmt = $conn->prepare("SELECT id, username, password, profile_picture FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $username, $hashed_password, $profile_picture);
        $stmt->fetch();
        $stmt->close();

        if ($hashed_password !== null && hash_equals($hashed_password, crypt($password, $hashed_password))) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['profile_picture'] = $profile_picture;

            // Remember Me functionality
            if ($remember) {
                $token = bin2hex(random_bytes(32)); // Generate a secure token
                setcookie("remember_me", $token, time() + (86400 * 30), "/"); // Cookie expires in 30 days

                // Store the token in the database
                $stmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->bind_param("si", $token, $user_id);
                $stmt->execute();
                $stmt->close();
            }

            // Redirect to dashboard
            header("Location: ../user_pages/dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
