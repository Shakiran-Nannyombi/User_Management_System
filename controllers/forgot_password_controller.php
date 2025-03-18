<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require '../includes/user_management.php'; 
require '../includes/mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a reset token and expiry time
        $token = bin2hex(random_bytes(10)); // Generate a secure token
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour")); // Set expiry for 1 hour

        // Store the token in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Send password reset email with the token (without link)
        if (sendPasswordResetEmail($email, $token)) {
            $_SESSION['message'] = "Check your email for the token.";
            // Redirect to the reset page after success
            header("Location: reset_password.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to send email. Try again later.";
        }
    } else {
        $_SESSION['error'] = "No user found with this email.";
    }
    header("Location: forgot_password.php");
    exit();
}
?>
