<?php
session_start();
include '../includes/user_management.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'], $_POST['password'])) {
    $token = trim($_POST['token']);
    $new_password = trim($_POST['password']);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Verify the token and check if it is valid and not expired
    $stmt = $conn->prepare("SELECT id, token_expiry FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $token_expiry);
        $stmt->fetch();

        // Check if the token has expired
        if (strtotime($token_expiry) > time()) {
            // Token is valid, update the password
            $update_stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, token_expiry=NULL WHERE id=?");
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            $update_stmt->execute();

            $_SESSION['message'] = "Your password has been reset successfully!";
            header("Location: ../user_pages/login.php"); // Redirect to login after successful reset
            exit();
        } else {
            $_SESSION['error'] = "This reset token has expired.";
        }
    } else {
        $_SESSION['error'] = "Invalid reset token.";
    }
}
?>